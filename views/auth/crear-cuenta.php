<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-app">Llena el siguiente formulario</p>

<?php 

include __DIR__ . "/../templates/alertas.php";

?>

<form method="POST" 
action="crear-cuenta" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
        type="text" 
        name="nombre" 
        id="nombre"
        placeholder="Tu Nombre"
        value="<?php echo s($usuario->nombre); ?>"
        >
        
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
        type="text" 
        name="apellido" 
        id="apellido"
        placeholder="Tu Apellido"
        value="<?php echo s($usuario->apellido); ?>"
        >
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
        type="tel" 
        name="telefono" 
        id="telefono"
        placeholder="Tu Telefono"
        value="<?php echo s($usuario->telefono); ?>" 
        min="0" max="9">
    </div>

    <div class="campo">
        <label for="email">Correo</label>
        <input 
        type="email" 
        name="email" 
        id="email"
        placeholder="Tu Correo"
        value="<?php echo s($usuario->email); ?>"
        >
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input 
        type="password" 
        name="password" 
        id="password"
        placeholder="Tu Contraseña"
        >
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

</form>

<div class="acciones">
    <a href="login">Ya tengo una cuenta</a>
    <a href="olvide">Olvide mi contraseña </a>
</div>