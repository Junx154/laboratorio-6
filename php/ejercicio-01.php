<?php

// 1. Definir el precio de un producto y la cantidad que compra el cliente
$nombreProducto = "Camisa";
$precioUnitario = 20.00;
$cantidadComprada = 3;

// 2. Calcular el precio total sin descuento
$totalSinDescuento = $precioUnitario * $cantidadComprada;


if ($totalSinDescuento > 50) {
    $descuento = 5;
    echo "¡Felicidades! Ganaste un descuento de $5 por comprar más de $50.<br>";
}

$totalPagar = $totalSinDescuento - $descuento;

echo "--- TICKET DE VENTA ---<br>";
echo "Producto: " . $nombreProducto . "<br>";
echo "Precio por unidad: $" . $precioUnitario . "<br>";
echo "Cantidad: " . $cantidadComprada . "<br>";
echo "Total a pagar: $" . $totalPagar . "<br>";

?>