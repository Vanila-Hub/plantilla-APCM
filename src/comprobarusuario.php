<?php
require_once 'conexion.php';

 if (isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    $sql = "select * from usuarios where usuario = ?";

    $sentencia = $pdo -> prepare($sql);
    $sentencia -> execute([$usuario]);

    $usuario = $sentencia -> fetch();

    if($usuario && password_verify($password, $usuario['password'])) {
        echo"El usuario intrucido es correcto";
    } else {
        echo"El usuario no es correcto";
    }
}