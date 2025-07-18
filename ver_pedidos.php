<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "sportzone");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los pedidos
$sql = "SELECT id, nombre_cliente, email, telefono, producto, cantidad, fecha_pedido FROM pedidos ORDER BY fecha_pedido DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Pedidos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f9ff;
      padding: 20px;
    }
    h1 {
      color: #004a99;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }
    th, td {
      border: 1px solid #999;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #007BFF;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #eef6ff;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      padding: 10px 15px;
      background-color: #007BFF;
      color: white;
      border-radius: 5px;
    }
    a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<h1>Lista de Pedidos Recibidos</h1>

<?php
if ($resultado->num_rows > 0) {
    echo "<table>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Fecha</th>
            </tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nombre_cliente']}</td>
                <td>{$fila['email']}</td>
                <td>{$fila['telefono']}</td>
                <td>{$fila['producto']}</td>
                <td>{$fila['cantidad']}</td>
                <td>{$fila['fecha_pedido']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No hay pedidos registrados.</p>";
}
?>

<a href="pagina.html?usuario=admin">Volver a la tienda</a>

</body>
</html>

<?php
$conexion->close();
?>
