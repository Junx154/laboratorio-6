// ====== INICIALIZAR INVENTARIO ======
let inventario;
let contador;

if (!localStorage.getItem("inventario")) {
    inventario = {
        1: { nombre: "Arroz", precio: 4.50, stock: 20 },
        2: { nombre: "Leche", precio: 3.80, stock: 15 },
        3: { nombre: "Pan",   precio: 0.30, stock: 50 }
    };
    contador = 4;
    guardar();
} else {
    inventario = JSON.parse(localStorage.getItem("inventario"));
    contador   = parseInt(localStorage.getItem("contador"));
}

// ====== GUARDAR EN LOCALSTORAGE ======
function guardar() {
    localStorage.setItem("inventario", JSON.stringify(inventario));
    localStorage.setItem("contador", contador);
}

// ====== MOSTRAR MENSAJE ======
function mostrarMensaje(texto) {
    const div = document.getElementById("mensaje");
    div.textContent = texto;
    div.style.display = "block";
    setTimeout(() => div.style.display = "none", 2500);
}

// ====== AGREGAR PRODUCTO ======
function agregar() {
    const nombre = document.getElementById("nombre").value.trim();
    const precio = parseFloat(document.getElementById("precio").value);
    const stock  = parseInt(document.getElementById("stock").value);

    if (nombre === "" || isNaN(precio) || isNaN(stock)) {
        alert("Completa todos los campos");
        return;
    }

    const id = contador++;
    inventario[id] = { nombre, precio, stock };
    guardar();

    // Limpiar campos
    document.getElementById("nombre").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("stock").value  = "";

    mostrarMensaje("✅ Producto agregado.");
    mostrar();
}

// ====== ELIMINAR PRODUCTO ======
function eliminar(id) {
    if (confirm("¿Eliminar?")) {
        delete inventario[id];
        guardar();
        mostrarMensaje("✅ Producto eliminado.");
        mostrar();
    }
}

// ====== LIMPIAR BÚSQUEDA ======
function limpiarBusqueda() {
    document.getElementById("buscar").value = "";
    mostrar();
}

// ====== MOSTRAR LISTA ======
function mostrar() {
    const buscar = document.getElementById("buscar").value.toLowerCase();
    const tbody = document.getElementById("tabla");
    let html = "";

    let vacio = true;
    for (const id in inventario) {
        const p = inventario[id];

        // Filtrar por búsqueda
        if (buscar !== "" && !p.nombre.toLowerCase().includes(buscar)) continue;

        vacio = false;
        html += `<tr>
            <td>${id}</td>
            <td>${p.nombre}</td>
            <td>S/ ${p.precio.toFixed(2)}</td>
            <td>${p.stock}</td>
            <td><button onclick="eliminar(${id})">🗑️</button></td>
        </tr>`;
    }

    if (vacio) {
        html = `<tr><td colspan="5">No hay productos.</td></tr>`;
    }

    tbody.innerHTML = html;
}

// ====== MOSTRAR AL CARGAR ======
mostrar();