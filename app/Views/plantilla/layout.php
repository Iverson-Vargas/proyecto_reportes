<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\layout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title><?= isset($titulo) ? esc($titulo) : 'SAID SYSTEMS'; ?></title>
    <link rel="icon" type="image\png" href="assets\img\icon.png">
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

</head>

<body>

    <footer class="menu-superior">
        <div id="users" class="d-flex" role="search">

            <ul id="nombreUsuario" class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a id="nombre" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> <?php echo session('nombres') . " " . session('apellidos'); ?>
                    </a>
                    <ul id="cerrar" class="dropdown-menu">
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="" class="dropdown-item" id="btnCerrar" onclick="salir()">Cerrar sesion</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </footer>

    <div class="nombre-sistem">
        <h3>SAID SYSTEMS</h3>
    </div>


    <div id="menu-lateral" class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark"> <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">

            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?= base_url('/inicio'); ?>" class="nav-link text-white" aria-current="page"><i class="bi-house-door-fill"></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/solicitudes'); ?>" class="nav-link text-white"><i class="bi bi-envelope-fill"></i>
                        Solicitudes
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/misSolicitudes'); ?>" class="nav-link text-white"><i class="bi bi-send"></i>
                        Mis Solicitudes
                    </a>
                </li>
                <li class="mb-1">
                    <button class="nav-link text-white"
                        data-bs-toggle="collapse"
                        data-bs-target="#confi"
                        aria-expanded="false"
                        aria-controls="confi"
                        style="text-align:left;">
                        <i class="bi-gear-fill" ></i>
                        Configuración
                    </button>
                    <div class="collapse" id="confi">
                        <ul class="nav flex-column ms-5">
                            <li>
                                <a href="<?= base_url('/usuarios'); ?>" class="nav-link text-white">
                                    Usuarios
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('/cargos'); ?>" class="nav-link text-white ">
                                    Cargos
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('/departamentos') ?>" class="nav-link text-white">
                                    Departamentos
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="nav-link text-white"
                        data-bs-toggle="collapse"
                        data-bs-target="#repor"
                        aria-expanded="false"
                        aria-controls="repor"
                        style="text-align:left;">
                        <i class="bi bi-bar-chart-line-fill"></i>
                        Reportes
                    </button>
                    <div class="collapse" id="repor">
                        <ul class="nav flex-column ms-5">
                            <li>
                                <a href="#" class="nav-link text-white">
                                    Reporte 1
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white">
                                    Reporte 2
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white">
                                    Reporte 3
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <hr>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div id="mensaje" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header" style="background-color: #198754; color: white;">
                <strong class="me-auto">Mensaje</strong>
                <small style="color: white;">Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="color: black;">
                ¡Usuario actualizado correctamente!
            </div>
        </div>
    </div>


    <main class="contenido">
        <?php echo $this->renderSection('contenido'); ?>
    </main>



    <?php echo $this->renderSection('scripts'); ?>

    <script>
        function salir() {
            const salirUrl = "<?= base_url('salir') ?>";
            fetch(salirUrl)
                .then(response => {
                    if (response.success) {
                        window.location.href = '<?= base_url('/'); ?>';
                    } else {
                        console.error('Error al cerrar sesión');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <script src="assets\js\bootstrap.bundle.min.js"></script>
    <script src="assets\js\mensaje.js"></script>
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    

</body>

</html>