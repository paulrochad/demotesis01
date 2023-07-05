<?php
function login()
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Establecer conexión con la base de datos
    $db = new mysqli("mysql", "administrador", "tecsup123", "credenciales_db");

    // Verificar si hubo un error de conexión
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }

    // Consulta para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";

    // Ejecutar la consulta
    $result = $db->query($query);

    // Verificar si se encontraron coincidencias
    if ($result->num_rows === 0) {
        echo "Nombre de usuario o contraseña incorrectos.";
    } else {
        echo "Inicio de sesión exitoso!";

        // Actualizar la columna "ultima_sesion" con la fecha y hora actual
        $update_query = "UPDATE usuarios SET ultima_sesion = NOW() WHERE username = '$username'";

        // Ejecutar la consulta de actualización
        $db->query($update_query);

        // Cerrar la conexión
        $db->close();

        // Redirigir al usuario a la página de información sobre abejas
        header("Location: informacion.php");
        exit;
    }
}

// Verificar si se ha enviado el formulario de login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    login();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Point Solution - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>

