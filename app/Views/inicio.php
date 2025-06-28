<?php echo $this->extend('plantilla/layout');?>
<?php echo $this->section('contenido');?>

    <h1>Pagina principal</h1>
    <h2>Aquie es donde va a estar todo el contenido</h2>
    <p> el nombre del usuario <?php echo session('usuario');?> es <?php echo session('nombres')?></p>

<?php echo $this->endSection();?>