<?php

$nombreProducto = "Camisa";
$precioUnitario = 20.00;
$cantidadComprada = 3;

// 2. Calcular el precio total sin descuento
$totalSinDescuento = $precioUnitario * $cantidadComprada;


if ($totalSinDescuento > 50) {
    $descuento = 5; // Descuento fijo de $5
    echo "¡Felicidades! Ganaste un descuento de $5 por comprar más de $50.\n";
}


$totalPagar = $totalSinDescuento - $descuento;

// 5. Mostrar el resultado en la consola
echo "--- TICKET DE VENTA ---" ;
echo "Producto: " . $nombreProducto . "\n";
echo "Precio por unidad: $" . $precioUnitario . "\n";
echo "Cantidad: " . $cantidadComprada . "\n";
echo "Total a pagar: $" . $totalPagar . "\n";

?>