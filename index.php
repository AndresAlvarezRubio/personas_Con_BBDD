<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta de Personas</title>
</head>
<body>
<div class="show-people">
<?php
    include_once("conexion.php");
    $link = conectar();
    if (!empty($_POST["nombre"]) && !empty($_POST["apellidos"])) {

        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $insercion = "INSERT INTO datos (nombre,apellidos) VALUES ('$nombre', '$apellidos')";
        echo $insercion;

        $resultado = mysqli_query($link,$insercion);

        if ($resultado) {

            echo "El usuario se ha dado de alta correctamente";

        } else {

            echo "Algo salió mal al darse de alta";
        }
    }
    $consulta = "SELECT * FROM datos";
    $resultado = mysqli_query($link,$consulta);

    while($fila = mysqli_fetch_assoc($resultado)) {
        echo "<li>".$fila["nombre"]." ". $fila["apellidos"] . "</li>";
    }

?>
</div>
<hr>
<section class="main-wrap">
    <h1>Alta de Personas</h1>
    <form action="index.php" method="post">
        <label for="nombre">
            <input name="nombre" type="text" placeholder="Nombre">
        </label>
        <label for="apellido">
            <input name="apellidos" type="text" placeholder="Apellido">
        </label>
        <input type="submit" value="Darse de Alta">
    </form>
    <a href="update.php">Modificar o Eliminar Personas</a>
</section>
</body>
</html>
