<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <title>Sistema de Reportes</title>
</head>

<body>

    <div class="container">

        <header>
            <h1 class="tituloPrincipal">SAID SYSTEMS</h1>
        </header>

        <main>
            <div class="formulario">
                <h2 class="card-title"><i class="bi bi-person"></i> INICIAR SESIÓN</h2>
                <hr class="ralla" />
                <form action="<?php echo base_url('/login'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">USUARIO</label>
                        <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">CONTRASEÑA</label>
                        <input type="password" class="form-control" name="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="bi bi-box-arrow-in-right"></i> INICIAR SESIÓN</button>
                </form>
            </div>
            

        </main>

    </div>


    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>