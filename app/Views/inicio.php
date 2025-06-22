<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Se</title>
</head>
<body>
    <h1>Pagina principal</h1>
    <h2>Aquie es donde va a estar todo el contenido</h2>
    <p> el nombre del usuario <?php echo session('usuario');?> es <?php echo session('nombres')?></p>
    <form action="<?php echo base_url('/salir')?>" method="get">
        <button>Salir</button>
    </form>
</body>
</html>