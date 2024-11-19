<?php
    $err = $_GET["error"];
?>

<form method="POST" action="comprobar_login.php">
    <br>
    <label>user</label>
    <input type="text" name="user">
    <label>password</label>
    <input type="text" name="password">
    <br>
    <button type="submit">Iniciar sesion</button>
    <?php if ($err):?>
        <h1 style="color: red;">USUARIO O CONTRASEÑA MAL</h1>
    <?php endif;?>
</form>
