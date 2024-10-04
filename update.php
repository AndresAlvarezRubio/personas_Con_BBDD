<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar-Borrar</title>
</head>
<body>
<?php
include_once "conexion.php";
$link = conectar();

if (!empty($_GET["opcion"]) && $_GET["opcion"]=="borrar") {
    $id = $_GET["id"];
    $borrar ="DELETE FROM datos WHERE id=$id";
    $resultado=mysqli_query($link,$borrar);

    if ($resultado) {
        echo "registro borrado correctamente";
    } else {
        echo "registro no fue borrado";
    }
}

?>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Acciones</th>
    </tr>
    <?php

        $sql="SELECT * FROM datos";
        $resultado = mysqli_query($link, $sql);
        while($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>".$fila["id"]."</td>";
            echo "<td>".$fila["nombre"]."</td>";
            echo "<td>".$fila["apellidos"]."</td>";
            echo "<td><a href='update.php?opcion=borrar&id=".$fila["id"]."'>Borrar</a></td>";
            echo "<td><a href='update.php?opcion=actualizar&id=".$fila["id"]."'>Actualizar</a></td>";
            echo "</tr>";
        }
    ?>
</table>
</body>
</html>
