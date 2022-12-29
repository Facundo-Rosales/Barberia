<h1 class="nombre-pagina">Registro</h1>
<p class="descripcion-app">Iniciar sesion</p>

<?php

include __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" method="POST" action="login">
    <div class="campo">
        <label for="email">Correo</label>
        <input type="email" name="email" id="email" placeholder="Tu Correo" />

    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Tu Contraseña" />

    </div>
    <div class="campo">
        <label for="checkbox">Recordar</label>
        <input class="checkbox" 
        type="checkbox" 
        name="checkbox" 
        id="checkbox" 
        value="checkbox">
    </div>



    <input type="submit" value="Iniciar Sesion" class="boton">
</form>


<div class="acciones">
    <a href="crear-cuenta">Crear una Cuenta</a>
    <a href="olvide">Olvide mi contraseña</a>
</div>