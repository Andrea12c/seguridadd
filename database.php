<?php
// database.php

// Datos de conexión a la base de datos
$host = 'localhost';
$user = 'andrea';
$password = '12345678';
$database = 'test';

// Crear la conexión
$mysqli = new mysqli($host, $user, $password, $database);

// Verificar la conexión
if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Función para agregar un nuevo servicio
function createService($nombre, $descripcion, $imagen) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO servicios (nombre, descripcion, imagen) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $descripcion, $imagen);
    $stmt->execute();
    $stmt->close();
}

// Función para obtener todos los servicios
function getServices() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombre, descripcion, imagen FROM servicios");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para actualizar un servicio
function updateService($id, $nombre, $descripcion, $imagen) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE servicios SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $descripcion, $imagen, $id);
    $stmt->execute();
    $stmt->close();
}

// Función para eliminar un servicio
function deleteService($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM servicios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>
