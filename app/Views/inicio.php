<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div style="font-size: 40px;" class="bienvenida-container ms-5 me-5">
    <h1>Bienvenido a SAID Systems</h1>
    <p>
        ¡Hola, <strong><?php echo esc(session('nombres') . " " . session('apellidos')); ?></strong>! Te damos la bienvenida a SAID Systems. Este es tu centro de operaciones para todo lo relacionado con el soporte técnico. Hemos diseñado esta herramienta para que puedas reportar cualquier falla de manera rápida y sencilla.

    </p>

    
</div>

<div style="display: grid; justify-content: center;
    align-content: center;">

    <a href="http://127.0.0.1:3000/paginaInformacion/pagina.html" target="_blank" style="font-size: 20px;" class="btn btn-primary ">Conoce más sobre el sistema</a>
</div>

<?php echo $this->endSection(); ?>