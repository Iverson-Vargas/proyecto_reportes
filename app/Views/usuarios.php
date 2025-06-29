<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center">Listado de usuarios</h3>

            <button class="btn btn-primary"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#modalCrearUsuario"
                onclick="LimpiarFormulario()">
                Crear usuario
            </button>
            <div class="tabla-scroll-vertical">
                <table class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Cargo</th>
                            <th>Departamento</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablausuarios">
                        <!-- Los datos se llenarán con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEliminarUsuario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="eliminarUsuario()">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- ModalCrearUsuario -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="modalCrearUsuario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCrearUsuario">Crear Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Datos de Personales</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" placeholder="Ingrese los nombres">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" placeholder="Ingrese los apellidos">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cargos" class="form-label">Cargo</label>
                            <select type="text" class="form-select" id="cargos">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Departamento</label>
                            <select type="text" class="form-select" id="departamento">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Rol</label>
                            <select type="text" class="form-select" id="roles">

                            </select>
                        </div>
                    </div>
                </div>

                <h3 class="text-center">Datos de acceso</h3>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Ingrese el usuario">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingrese la contraseña">
                        </div>
                    </div>
                </div>

                <div id="resultado"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->endSection(); ?>


    <?php echo $this->section('scripts'); ?>

    <script>
        let listadodeUsuarios = [];
        let esEditar = false;
        let idUsuarior = 0;
        window.onload = function() {
            listarUsuarios(1);
            listarCargos();
            listarDepartamentos();
            listarRoles();
        }

        function listarUsuarios() {
            const url = '<?= base_url('listadoUsuarios'); ?>?usuario_estado_id=1';
            fetch(url)
                .then(response => response.json())
                .then(respuesta => {
                    listadodeUsuarios = respuesta.data;
                    if (respuesta.success) {
                        var tbody = document.getElementById('cuerpoTablausuarios');
                        tbody.innerHTML = '';
                        respuesta.data.forEach(usuario => {
                            var tr = document.createElement('tr');
                            tr.innerHTML = `
                      <td>${usuario.id}</td>
                      <td>${usuario.nombres}</td>
                      <td>${usuario.apellidos}</td>
                      <td>${usuario.cargo}</td>
                      <td>${usuario.departamento}</td>
                      <td>${usuario.rol}</td>
                      <td>
                        <button class="btn btn-warning btn-sm" onclick="editarUsuario(${usuario.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" type="button" onclick="capturarIdUsuario(${usuario.id})" data-bs-toggle="modal" data-bs-target="#modalEliminarUsuario">Eliminar</button>
                      </td>
                    `;
                            tbody.appendChild(tr);
                        });

                    } else {
                        alert('Error al cargar los usuarios.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function capturarIdUsuario(id) {
            idUsuario = id;
        }

        function editarUsuario(id) {
            esEditar = true;
            idUsuario = id;
            const user = listadodeUsuarios.find(usuario => parseInt(usuario.id, 10) === id);
            if (user) {
                document.getElementById('nombres').value = user.nombres;
                document.getElementById('apellidos').value = user.apellidos;
                document.getElementById('cargos').value = user.cargo_id;
                document.getElementById('departamento').value = user.departamento_id;
                document.getElementById('roles').value = user.rol_id;
                document.getElementById('usuario').value = user.usuario;
                document.getElementById('password').value = user.clave;
                var modal = new bootstrap.Modal(document.getElementById('modalCrearUsuario'));
                modal.show();
            } else {
                alert('Usuario no encontrado.');
            }
        }

        function LimpiarFormulario() {
            esEditar = false;
            document.getElementById('nombres').value = '';
            document.getElementById('apellidos').value = '';
            document.getElementById('cargos').value = '';
            document.getElementById('departamento').value = '';
            document.getElementById('roles').value = '';
            document.getElementById('usuario').value = '';
            document.getElementById('password').value = '';
        }

        function listarDepartamentos() {
            const url = '<?= base_url('listadoDepartamentos'); ?>';
            fetch(url)
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        var select = document.getElementById('departamento');
                        select.innerHTML = '';
                        respuesta.data.forEach(departamento => {
                            var option = document.createElement('option');
                            option.value = departamento.id;
                            option.textContent = departamento.nombre;
                            select.appendChild(option);
                        });
                    } else {
                        alert('Error al cargar los departamentos.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function listarCargos() {
            const url = '<?= base_url('listadoCargo'); ?>';
            fetch(url)
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        var select = document.getElementById('cargos');
                        select.innerHTML = '';
                        respuesta.data.forEach(cargo => {
                            var option = document.createElement('option');
                            option.value = cargo.id;
                            option.textContent = cargo.nombre;
                            select.appendChild(option);
                        });
                    } else {
                        alert('Error al cargar los cargos.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function listarRoles() {
            const url = '<?= base_url('listadoRoles'); ?>';
            fetch(url)
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        var select = document.getElementById('roles');
                        select.innerHTML = '';
                        respuesta.data.forEach(rol => {
                            var option = document.createElement('option');
                            option.value = rol.id;
                            option.textContent = rol.nombre;
                            select.appendChild(option);
                        });
                    } else {
                        alert('Error al cargar los roles.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function guardarCambios() {
            if (esEditar) {
                actualizar();
            } else {
                registrarUsuario();
            }
        }

        function registrarUsuario() {
            const btnGuardar = document.querySelector('#modalCrearUsuario .btn-primary');
            btnGuardar.disabled = true;
            const url = '<?= base_url('crearUsuario'); ?>';
            var nombres = document.getElementById('nombres').value;
            var apellidos = document.getElementById('apellidos').value;
            var cargo_id = document.getElementById('cargos').value;
            var departamento_id = document.getElementById('departamento').value;
            var rol_id = document.getElementById('roles').value;
            var usuario = document.getElementById('usuario').value;
            var contrasena = document.getElementById('password').value;

            if (nombres === '' || apellidos === '' || cargo_id === '' || departamento_id === '' || rol_id === '' || usuario === '' || contrasena === '') {
                const divResultado = document.getElementById('resultado');
                divResultado.innerHTML = '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos.</div>';
                return;
            }

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombres: nombres,
                        apellidos: apellidos,
                        cargo_id: parseInt(cargo_id, 10),
                        departamento_id: parseInt(departamento_id, 10),
                        rol_id: parseInt(rol_id, 10),
                        usuario: usuario,
                        contrasena: contrasena
                    })
                })
                .then(response => response.json())
                .then(respuesta => {
                    btnGuardar.disabled = false;
                    if (respuesta.success) {
                        listarUsuarios();
                        // Cerrar el modal usando Bootstrap 5 API
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearUsuario'));
                        modal.hide();
                        // Mostrar el toast con mensaje personalizado después de cerrar la modal
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Usuario registrado correctamente!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);
                    } else {
                        alert('Error al registrar el usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    btnGuardar.disabled = false;
                });
        }

        function actualizar() {
            const url = '<?= base_url('ActualizarUsuario'); ?>';
            var nombres = document.getElementById('nombres').value;
            var apellidos = document.getElementById('apellidos').value;
            var cargo_id = document.getElementById('cargos').value;
            var departamento_id = document.getElementById('departamento').value;
            var rol_id = document.getElementById('roles').value;

            if (nombres === '' || apellidos === '' || cargo_id === '' || departamento_id === '' || rol_id === '') {
                const divResultado = document.getElementById('resultado');
                divResultado.innerHTML = '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos.</div>';
                return;
            }

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: idUsuario,
                        nombres: nombres,
                        apellidos: apellidos,
                        cargo_id: parseInt(cargo_id, 10),
                        departamento_id: parseInt(departamento_id, 10),
                        rol_id: parseInt(rol_id, 10),
                    })
                })
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        listarUsuarios();
                        // Cerrar el modal usando Bootstrap 5 API
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearUsuario'));
                        modal.hide();
                        // Mostrar el toast
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Usuario actualizado correctamente!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);
                    } else {
                        alert('Error al actualizar el usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function eliminarUsuario() {
            const url = '<?= base_url('eliminacion'); ?>';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: idUsuario
                    })
                })
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        listarUsuarios(1);
                        // Cerrar el modal usando Bootstrap 5 API
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEliminarUsuario'));
                        modal.hide();
                        // Mostrar el toast
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Usuario eliminado correctamente!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);
                    } else {
                        alert('Error al eliminar el usuario.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <?php echo $this->endSection(); ?>