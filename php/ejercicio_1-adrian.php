<?php
session_start();

// Inicializar inventario en sesión
if (!isset($_SESSION['inventario'])) {
    $_SESSION['inventario'] = [
        1 => ["nombre" => "Arroz", "precio" => 4.50, "stock" => 20],
        2 => ["nombre" => "Leche", "precio" => 3.80, "stock" => 15],
        3 => ["nombre" => "Pan",   "precio" => 0.30, "stock" => 50],
    ];
    $_SESSION['contador'] = 4;
}

$mensaje = "";

// Acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'agregar') {
        $id = $_SESSION['contador']++;
        $_SESSION['inventario'][$id] = [
            "nombre" => trim($_POST['nombre']),
            "precio" => (float)$_POST['precio'],
            "stock"  => (int)$_POST['stock']
        ];
        $mensaje = "✅ Producto agregado.";
    }

    if ($accion === 'eliminar') {
        $id = (int)$_POST['id'];
        if (isset($_SESSION['inventario'][$id])) {
            unset($_SESSION['inventario'][$id]);
            $mensaje = "✅ Producto eliminado.";
        } else {
            $mensaje = "❌ ID no existe.";
        }
    }
}

// Búsqueda
$buscar = trim($_GET['buscar'] ?? '');
$inventario = $_SESSION['inventario'];
if ($buscar !== '') {
    $inventario = array_filter($inventario, function($p) use ($buscar) {
        return stripos($p['nombre'], $buscar) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Inventario</title>
    <style>
        body { font-family: Arial; max-width: 700px; margin: 20px auto; }
        input, button { padding: 6px; margin: 3px; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .msg { padding: 8px; background: #e7f5e7; margin: 10px 0; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>📦 Sistema de Inventario</h1>

    <?php if ($mensaje): ?>
        <div class="msg"><?= $mensaje ?></div>
    <?php endif; ?>

    <h3>➕ Agregar producto</h3>
    <form method="POST">
        <input type="hidden" name="accion" value="agregar">
        <input type="text"   name="nombre" placeholder="Nombre" required>
        <input type="number" name="precio" placeholder="Precio" step="0.01" required>
        <input type="number" name="stock"  placeholder="Stock" min="0" required>
        <button type="submit">Agregar</button>
    </form>

    <h3>🔍 Buscar producto</h3>
    <form method="GET">
        <input type="text" name="buscar" placeholder="Nombre..." value="<?= htmlspecialchars($buscar) ?>">
        <button type="submit">Buscar</button>
        <a href="inventario.php">Limpiar</a>
    </form>

    <h3>📋 Lista de productos</h3>
    <table>
        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acción</th></tr>
        <?php if (empty($inventario)): ?>
            <tr><td colspan="5">No hay productos.</td></tr>
        <?php else: ?>
            <?php foreach ($inventario as $id => $p): ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td>S/ <?= number_format($p['precio'], 2) ?></td>
                    <td><?= $p['stock'] ?></td>
                    <td>
                        <form method="POST" style="display:inline">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>