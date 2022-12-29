<h1 class="nombre-pagina">Restablecer</h1>
<p class="descripcion-app">Restablece tu contraseña con tu Correo</p>

<?php 

include __DIR__ . "/../templates/alertas.php";

?>

<form action="olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Correo</label>
        <input type="email" 
        name="email" id="email" placeholder="Tu Correo">
    </div>
    <input type="submit" class="boton" value="Restablecer">
</form>

<div class="acciones">
    <a href="login">Ya tengo una cuenta</a>
    <a href="crear-cuenta">Crear una Cuenta</a>
</div>