<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .fila{
            background-color: black;
            color: white;
            font-size: 1em;
        }
        fieldset{
            width: 20%;
        }
    </style>
</head>
<body>
<form action='introducirusuario.php' method='post'>
  <fieldset>
    <legend>Login</legend>
    <div class='fila'>
        <label for='usuario'>Usuario:</label><br />
        <input type='text' name='inputUsuario' id='usuario' maxlength="50" /><br />
    </div>
    <div class='fila'>
        <label for='password'>Contraseña:</label><br />
        <input type='password' name='inputPassword' id='password' maxlength="50" /><br />
    </div>
    <div class='fila'>
        <input type='submit' name='enviar' value='Enviar' />
    </div>
  </fieldset>
  </form>
</body>
</html>