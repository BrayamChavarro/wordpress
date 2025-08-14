<?php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>CRUD de Usuarios - PHP</title>
</head>
<body>
    <?php
    // Incluir la clase User
    include_once("entitys/User.php");
    $usuario = new User();

    // --- CREAR USUARIO ---
    // Si el formulario de crear fue enviado
    if(isset($_POST['crear'])){
        // Llamar a la función para registrar usuario
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $usuario->registrarUsuario($correo, $contrasena);
    }

    // --- ELIMINAR USUARIO ---
    // Si se envió la acción de eliminar
    if(isset($_GET['eliminar'])){
        $correoEliminar = $_GET['eliminar'];
        $usuario->eliminarUsuario($correoEliminar);
    }

    // --- ACTUALIZAR USUARIO ---
    // Si el formulario de editar fue enviado
    if(isset($_POST['editar'])){
        $correoOriginal = $_POST['correo_original'];
        $nuevoCorreo = $_POST['correo'];
        $nuevaContrasena = $_POST['contrasena'];
        $usuario->actualizarUsuario($correoOriginal, $nuevoCorreo, $nuevaContrasena);
    }

    // Obtener todos los usuarios para mostrar en la tabla
    $datos = $usuario->todosUsuarios();
    ?>

    <h1>CRUD de Usuarios</h1>

    <!-- FORMULARIO PARA CREAR USUARIO -->
    <h2>Crear usuario</h2>
    <form method="POST">
        <label>Correo:</label>
        <input type="email" name="correo" required>
        <label>Contraseña:</label>
        <input type="text" name="contrasena" required>
        <button type="submit" name="crear">Crear</button>
    </form>

    <!-- TABLA DE USUARIOS -->
    <h2>Lista de usuarios</h2>
    <table border="1">
        <tr>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($datos as $d): ?>
        <tr>
            <td><?php echo htmlspecialchars($d['correo']); ?></td>
            <td><?php echo htmlspecialchars($d['contrasena']); ?></td>
            <td>
                <!-- Botón para eliminar -->
                <a href="?eliminar=<?php echo urlencode($d['correo']); ?>" onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</a>
                <!-- Botón para editar (muestra el formulario de edición) -->
                <a href="?editar=<?php echo urlencode($d['correo']); ?>&contrasena=<?php echo urlencode($d['contrasena']); ?>">Editar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- FORMULARIO PARA EDITAR USUARIO (solo si se seleccionó editar) -->
    <?php if(isset($_GET['editar'])): ?>
        <h2>Editar usuario</h2>
        <form method="POST">
            <input type="hidden" name="correo_original" value="<?php echo htmlspecialchars($_GET['editar']); ?>">
            <label>Nuevo correo:</label>
            <input type="email" name="correo" value="<?php echo htmlspecialchars($_GET['editar']); ?>" required>
            <label>Nueva contraseña:</label>
            <input type="text" name="contrasena" value="<?php echo htmlspecialchars($_GET['contrasena']); ?>" required>
            <button type="submit" name="editar">Actualizar</button>
        </form>
    <?php endif; ?>

    <!--
        Comentarios:
        - El formulario de crear usuario envía los datos por POST y llama a registrarUsuario().
        - El enlace Eliminar pasa el correo por GET y llama a eliminarUsuario().
        - El enlace Editar muestra el formulario de edición con los datos actuales y llama a actualizarUsuario().
        - Todo el código está comentado para que puedas entender cada parte.
    -->
</body>
</html>