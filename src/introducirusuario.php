<?php
require_once 'conexion.php';
// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    $sql = "INSERT INTO usuarios(usuario, password) VALUES (:usuario, :password)";

    $sentencia = $pdo -> prepare($sql);

    $isOk = $sentencia -> execute([
        "usuario" => $usuario,
        "password" => password_hash($password,PASSWORD_DEFAULT)
    ]);

    if($isOk){
        echo "Usuario introducido correctamente.";
    }
}