<?php

$host = "dianakarina-server.mysql.database.azure.com";
$user = "diana_admin@dianakarina-server";
$password = "73583703Karina";

// Crear conexión
$conn = new mysqli($host, $user, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Crear base de datos si no existe
$conn->query("CREATE DATABASE IF NOT EXISTS prueba");

// Seleccionar base de datos
$conn->select_db("prueba");

// Crear tabla si no existe
$conn->query("CREATE TABLE IF NOT EXISTS personas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
)");

// Insertar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $conn->query("INSERT INTO personas (nombre) VALUES ('$nombre')");
    echo "<p style='color:green;'>✅ Nombre guardado correctamente</p>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Mi App Azure</title>
</head>
<body>

<h1>Formulario de Personas 🚀</h1>

<form method="POST">
    <input type="text" name="nombre" placeholder="Ingresa tu nombre" required>
    <button type="submit">Guardar</button>
</form>

<h2>Personas registradas:</h2>

<?php
$result = $conn->query("SELECT * FROM personas");

while ($row = $result->fetch_assoc()) {
    echo "<p>" . $row["nombre"] . "</p>";
}
?>

</body>
</html>