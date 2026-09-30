<?php

// 1. Catálogo de productos disponibles
$catalogo = [
    1 => ["id" => 1, "nombre" => "Teclado Mecánico", "precio" => 50],
    2 => ["id" => 2, "nombre" => "Mouse Gamer", "precio" => 25],
    3 => ["id" => 3, "nombre" => "Monitor 24 pulgadas", "precio" => 180],
    4 => ["id" => 4, "nombre" => "Auriculares HQ", "precio" => 40]
];

// 2. Estado inicial del carrito
$carrito = [];

// 3. Funciones del sistema

// Mostrar el catálogo disponible
function verCatalogo($catalogo) {
    echo "<h3>--- CATÁLOGO DE PRODUCTOS ---</h3>";
    foreach ($catalogo as $prod) {
        echo "ID: {$prod['id']} | {$prod['nombre']} - \${$prod['precio']}<br>";
    }
    echo "<br>";
}

// Agregar producto por su ID
function agregarAlCarrito($idProducto, $cantidad = 1) {
    global $catalogo, $carrito;

    if (!isset($catalogo[$idProducto])) {
        echo "⚠️ Producto con ID {$idProducto} no encontrado.<br>";
        return;
    }

    $producto = $catalogo[$idProducto];

    if (isset($carrito[$idProducto])) {
        $carrito[$idProducto]['cantidad'] += $cantidad;
    } else {
        $carrito[$idProducto] = [
            'id' => $producto['id'],
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'cantidad' => $cantidad
        ];
    }

    echo "✅ Agregado: {$cantidad}x {$producto['nombre']}<br>";
}

// Eliminar o reducir cantidad de un producto
function quitarDelCarrito($idProducto, $cantidad = 1) {
    global $carrito;

    if (!isset($carrito[$idProducto])) {
        echo "⚠️ El producto no está en el carrito.<br>";
        return;
    }

    if ($carrito[$idProducto]['cantidad'] > $cantidad) {
        $carrito[$idProducto]['cantidad'] -= $cantidad;
        echo "➖ Se redujo la cantidad de {$carrito[$idProducto]['nombre']}<br>";
    } else {
        echo "🗑️ Se eliminó {$carrito[$idProducto]['nombre']} del carrito<br>";
        unset($carrito[$idProducto]);
    }
}

// Mostrar el contenido actual y el desglose de precios
function verCarrito() {
    global $carrito;

    echo "<h3>--- TU CARRITO ---</h3>";

    if (empty($carrito)) {
        echo "El carrito está vacío.<br><br>";
        return;
    }

    $subtotal = 0;

    foreach ($carrito as $item) {
        $itemSubtotal = $item['precio'] * $item['cantidad'];
        $subtotal += $itemSubtotal;
        echo "- {$item['nombre']} | Cantidad: {$item['cantidad']} | Precio U.: \${$item['precio']} | Subtotal: \${$itemSubtotal}<br>";
    }

    $impuesto = $subtotal * 0.18; // 18% IGV / IVA
    $total = $subtotal + $impuesto;

    echo "---------------------------<br>";
    echo sprintf("Subtotal: $%.2f<br>", $subtotal);
    echo sprintf("Impuesto (18%%): $%.2f<br>", $impuesto);
    echo sprintf("<strong>TOTAL A PAGAR: $%.2f</strong><br><br>", $total);
}

// Vaciar el carrito por completo
function vaciarCarrito() {
    global $carrito;
    $carrito = [];
    echo "🧹 Carrito vaciado con éxito.<br>";
}

// --- DEMOSTRACIÓN DE USO ---
verCatalogo($catalogo);

// Prueba de operaciones:
agregarAlCarrito(1, 1); // 1 Teclado
agregarAlCarrito(2, 2); // 2 Mouses
agregarAlCarrito(3, 1); // 1 Monitor

verCarrito();

quitarDelCarrito(2, 1); // Quitar 1 Mouse
verCarrito();