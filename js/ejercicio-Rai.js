// 1. Definir el precio de un producto y la cantidad que compra el cliente
let nombreProducto = "Camisa";
let precioUnitario = 20.00;
let cantidadComprada = 3;

// 2. Calcular el precio total sin descuento
let totalSinDescuento = precioUnitario * cantidadComprada;

if (totalSinDescuento > 50) {
    descuento = 5; 
    console.log("¡Felicidades! Ganaste un descuento de $5 por comprar más de $50.");
}

// 4. Calcular el total final a pagar
let totalPagar = totalSinDescuento - descuento;

// 5. Mostrar el resultado en la consola
console.log("--- TICKET DE VENTA ---");
console.log("Producto: " , nombreProducto);
console.log("Precio por unidad: $/" , precioUnitario);
console.log("Cantidad: " , cantidadComprada);
console.log("Total a pagar: $/" , totalPagar);