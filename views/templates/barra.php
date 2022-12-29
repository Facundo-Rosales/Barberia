<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?></p>
    <a href="logout" class="boton">Cerrar Sesion</a>
</div>

<?php if(isset($_SESSION['admin'] ) ) { ?>

    <div class="barra-servicios">
        <a href="http://localhost:3000/public/admin" class="boton">Ver Citas</a>
        <a href="http://localhost:3000/public/servicios" class="boton">Ver Servicios</a>
        <a href="http://localhost:3000/public/servicios/crear" class="boton">Nuevo Servicio</a>
    </div>

<?php } ?>