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
if (isset($_POST["nombre"]) && isset($_POST["apellidos"])) {
    $actualizar="UPDATE datos SET nombre='$_POST[nombre]', apellidos='$_POST[apellidos]' WHERE id=$_POST[id]";
    $resultado = mysqli_query($link,$actualizar);
    if ($resultado) {
        echo "<br> El registro se actualizó correctamente";
    } else {
        echo "<br> El registro no se cambió";
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
<?php
if (isset($_GET["id"]) && $_GET["opcion"]=="actualizar") {
    $consulta = "SELECT * FROM datos WHERE id=$_GET[id]";
    $resultado = mysqli_query($link, $consulta);
    //OJO -> Si el resultado es solo 1 registro, no se necesita un bucle para obtener el array. Si no, únicamente el Fetch asociativo = mysqli_fetch_array($array)

    $row = mysqli_fetch_array($resultado); //$row["nombre"] -> Trae el nombre de la BBDD
?>
    <form action="" method="POST">
        <input type="hidden" value="<?=$row['id']?>" name="id">
        <label for="nombre">
            <input name="nombre" type="text" placeholder="Nombre" value="<?=$row['nombre']?>">
        </label>
        <label for="apellido">
            <input name="apellidos" type="text" placeholder="Apellido" value="<?=$row['apellidos']?>">
        </label>
        <input type="submit" value="Actualizar">
    </form>
<?php
}
?>
</body>
</html>
