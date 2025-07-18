<?php
$conexion = new mysqli("localhost", "root", "", "sportzone");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $_POST['nombre_cliente'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];

// Muestra los datos recibidos
echo "<pre>";
echo "Nombre: $nombre\n";
echo "Email: $email\n";
echo "Teléfono: $telefono\n";
echo "Producto: $producto\n";
echo "Cantidad: $cantidad\n";
echo "</pre>";

// Validación simple
if (empty($nombre) || empty($email) || empty($telefono) || empty($producto) || empty($cantidad)) {
    die("❌ Faltan datos. Revisa el formulario.");
}

$stmt = $conexion->prepare("INSERT INTO pedidos (nombre_cliente, email, telefono, producto, cantidad) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $nombre, $email, $telefono, $producto, $cantidad);

if ($stmt->execute()) {
    echo "<h2>✅ Pedido enviado correctamente.</h2>";
    echo "<a href='pagina.html?usuario=admin'>Volver a la tienda</a>";
} else {
    echo "❌ Error al guardar el pedido: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
