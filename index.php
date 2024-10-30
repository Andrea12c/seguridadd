<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguridad Informática para Pequeñas Empresas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Incluir el archivo de base de datos
include 'database.php';

// Procesar formularios de agregar, actualizar o eliminar servicio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        createService($_POST['nombre'], $_POST['descripcion'], $_POST['imagen']);
    } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
        updateService($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['imagen']);
    } elseif (isset($_POST['action']) && $_POST['action'] == 'delete') {
        deleteService($_POST['id']);
    }
}

// Obtener todos los servicios para mostrar en la lista
$services = getServices();
?>

<header>
    <h1>Seguridad Informática como Servicio</h1>
    <nav>
        <a href="#inicio">Inicio</a>
        <a href="#productos">Productos</a>
        <a href="#servicios">Servicios</a>
        <a href="#soluciones">Soluciones</a>
        <a href="#beneficios">Beneficios</a>
        <a href="#contacto">Contacto</a>
    </nav>
</header>

<div class="container">
    <section id="productos">
        <h2>Gestión de Servicios de Seguridad Informática</h2>
        
        <!-- Formulario para agregar servicio -->
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <label for="nombre">Nombre del Servicio:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea><br>
            <label for="imagen">URL de la Imagen:</label>
            <input type="text" id="imagen" name="imagen"><br>
            <button type="submit">Agregar Servicio</button>
        </form>

        <!-- Listado de servicios con opciones de edición y eliminación -->
        <h3>Lista de Servicios</h3>
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service['nombre']) ?></td>
                    <td><?= htmlspecialchars($service['descripcion']) ?></td>
                    <td><img src="<?= htmlspecialchars($service['imagen']) ?>" alt="<?= htmlspecialchars($service['nombre']) ?>" style="width:100px;"></td>
                    <td>
                        <!-- Formulario para eliminar servicio -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $service['id'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                        <!-- Formulario para editar servicio -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $service['id'] ?>">
                            <input type="text" name="nombre" value="<?= htmlspecialchars($service['nombre']) ?>" required>
                            <textarea name="descripcion" required><?= htmlspecialchars($service['descripcion']) ?></textarea>
                            <input type="text" name="imagen" value="<?= htmlspecialchars($service['imagen']) ?>">
                            <button type="submit">Actualizar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section id="contacto">
        <h2>Contacto</h2>
        <form>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" required><br>
            <label for="mensaje">Mensaje:</label><br>
            <textarea id="mensaje" name="mensaje" rows="3" required></textarea><br>
            <button type="submit">Enviar</button>
        </form>
    </section>
</div>

<footer>
    <p>&copy; 2024 Seguridad Informática como Servicio. Todos los derechos reservados.</p>
</footer>

</body>
</html>
