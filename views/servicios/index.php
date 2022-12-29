<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administracion de Servicios</p>

<?php

include_once __DIR__ . '/../templates/barra.php';

?>

<ul class="servicios">
    <?php foreach ($servicios as $servicio) { ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>S/ <?php echo $servicio->precio; ?></span></p>
            <div class="acciones">
                <div class="botones-edicion">
                    <a href="servicios/actualizar?id=<?php echo $servicio->id; ?>" class="boton">
                        Editar </a>

                    <form action="servicios/eliminar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                        <input type="submit" value="eliminar" class="boton-eliminar">
                    </form>
                </div>

            </div>
        </li>
    <?php }  ?>
</ul>