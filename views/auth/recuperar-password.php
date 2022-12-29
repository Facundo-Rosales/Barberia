<h1 class="nombre-pagina">Restablecer Contraseña</h1>
<p class="descripcion-app">Ingrese su nueva contraseña a continuacion</p>

<?php 

include __DIR__ . "/../templates/alertas.php";

?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password"
        name="password" 
        id="password" 
        placeholder="Nueva Contraseña" />

    </div>

<input type="submit" value="Guardar Contraseña" class="boton">
</form>


<div class="acciones">
    <a href="http://localhost:3000/public/login">Ya tengo una cuenta</a>
    <a href="http://localhost:3000/public/crear-cuenta">Crear una Cuenta</a>
   
</div>