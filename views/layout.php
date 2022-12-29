<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BarberShop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="http://localhost:3000/public/build/css/app.css">
</head>

<body>
    <div class="contenedor-app">
        <div class="imagen" id="musica">
            <div class="logo">
                <img src="http://localhost:3000/public/build/img/logo.png" alt="img">
            </div>

        </div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>

    <?php echo $script ?? ''; ?>

</body>

</html>