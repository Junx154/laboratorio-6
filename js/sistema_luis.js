// 1. Catálogo de productos disponibles
const catalogo = [
  { id: 1, nombre: "Teclado Mecánico", precio: 50 },
  { id: 2, nombre: "Mouse Gamer", precio: 25 },
  { id: 3, nombre: "Monitor 24 pulgadas", precio: 180 },
  { id: 4, nombre: "Auriculares HQ", precio: 40 }
];

// 2. Estado inicial del carrito
let carrito = [];

// 3. Funciones del sistema

// Mostrar el catálogo disponible en consola
function verCatalogo() {
  console.log("--- CATÁLOGO DE PRODUCTOS ---");
  catalogo.forEach(prod => {
    console.log(`ID: ${prod.id} | ${prod.nombre} - $${prod.precio}`);
  });
}

// Agregar producto por su ID
function agregarAlCarrito(idProducto, cantidad = 1) {
  const producto = catalogo.find(p => p.id === idProducto);
  
  if (!producto) {
    console.warn(`⚠️️ Producto con ID ${idProducto} no encontrado.`);
    return;
  }

  const itemEnCarrito = carrito.find(item => item.id === idProducto);

  if (itemEnCarrito) {
    itemEnCarrito.cantidad += cantidad;
  } else {
    carrito.push({
      id: producto.id,
      nombre: producto.nombre,
      precio: producto.precio,
      cantidad: cantidad
    });
  }

  console.log(`✅ Agregado: ${cantidad}x ${producto.nombre}`);
}

// Eliminar o reducir cantidad de un producto
function quitarDelCarrito(idProducto, cantidad = 1) {
  const index = carrito.findIndex(item => item.id === idProducto);

  if (index === -1) {
    console.warn(`⚠️ El producto no está en el carrito.`);
    return;
  }

  if (carrito[index].cantidad > cantidad) {
    carrito[index].cantidad -= cantidad;
    console.log(`➖ Se redujo la cantidad de ${carrito[index].nombre}`);
  } else {
    console.log(`🗑️ Se eliminó ${carrito[index].nombre} del carrito`);
    carrito.splice(index, 1);
  }
}

// Mostrar el contenido actual y el desglose de precios
function verCarrito() {
  console.log("\n--- TU CARRITO ---");
  
  if (carrito.length === 0) {
    console.log("El carrito está vacío.");
    return;
  }

  // Visualización detallada en tabla
  console.table(carrito.map(item => ({
    Producto: item.nombre,
    Precio: `$${item.precio}`,
    Cantidad: item.cantidad,
    Subtotal: `$${item.precio * item.cantidad}`
  })));

  // Cálculos utilizando reduce
  const subtotal = carrito.reduce((acc, item) => acc + (item.precio * item.cantidad), 0);
  const impuesto = subtotal * 0.18; // 18% IGV / IVA
  const total = subtotal + impuesto;

  console.log(`Subtotal: $${subtotal.toFixed(2)}`);
  console.log(`Impuesto (18%): $${impuesto.toFixed(2)}`);
  console.log(`TOTAL A PAGAR: $${total.toFixed(2)}\n`);
}

// Vaciar el carrito por completo
function vaciarCarrito() {
  carrito = [];
  console.log("🧹 Carrito vaciado con éxito.");
}

// --- DEMOSTRACIÓN DE USO ---
verCatalogo();

// Prueba de operaciones:
agregarAlCarrito(1, 1); // 1 Teclado
agregarAlCarrito(2, 2); // 2 Mouses
agregarAlCarrito(3, 1); // 1 Monitor

verCarrito();

quitarDelCarrito(2, 1); // Quitar 1 Mouse
verCarrito();