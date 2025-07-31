<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Crud</title>
</head>
<body>
    <?php
    /*include_once("model/conDB.php");
    //instanciacion de tipo conDB
    $data_base = new conDB();
    var_dump($data_base->con);*/
    include_once("entitys/User.php");
    $usuario = new User();
    $datos = $usuario->todosUsuarios();
    foreach($datos as $d){?>
    <p> 
        <?php 
        print($d['correo']. "" .$d['contrasena']);
        ?>
    </p>
        <?php
    }
    ?>
</body>
</html>