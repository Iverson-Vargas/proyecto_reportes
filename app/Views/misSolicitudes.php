<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div class="container">

    <div style="margin-bottom: 10px;" class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center">Mis Solicitudes</h3>
            <hr>
            <button class="btn btn-primary"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#modalCrearSolicitud"
                onclick="LimpiarFormulario()">
                Crear Solicitud
            </button>
            <div class="tabla-scroll-vertical">

                <table id="tablaMisSolicitudes" class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Receptor</th>
                            <th>Tipo De Falla</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <!-- <tbody id="cuerpoTablaMisSolicitudes">
          <!-- Los datos se llenarán con JavaScript -->
                    <!--</tbody> -->
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCrearSolicitud" tabindex="-1" aria-labelledby="modalCrearSolicitud" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCrearSolicitud">Crear Solicitud</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Detalles de la Solicitud</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombreMisSolicitudes" class="form-label">Nombre del Solicitante</label>
                                <input type="text" class="form-control" id="nombreMisSolicitudes" value="<?php echo $_SESSION['nombres'] . " " . $_SESSION['apellidos']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de la Solicitud</label>
                                <input type="date" class="form-control" id="fecha" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipoFalla" class="form-label">Tipo de falla</label>
                                <select type="text" class="form-select" id="tipoFalla"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="text" class="form-control" id="descripcion"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="resultado"></div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="CrearSolicitud()">Enviar</button>
                    </div>
                </div>
            </div>
        </div>


        <?php echo $this->endSection(); ?>

        <?php echo $this->section('scripts'); ?>
        <script>
            let tabla;
            window.onload = function() {
                listarFallas();
            }

            $(document).ready(function() {
                tabla = $('#tablaMisSolicitudes').DataTable({
                    ajax: '<?= base_url('listadoMisSolicitudes'); ?>?id=<?= session()->get('id'); ?>',
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'fecha'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'receptor',
                            render: function(data, type, row) {
                                if (data == null) {
                                    return '<span style="color: red;">Receptor no asignado</span>';
                                }
                                return data;
                            }
                        },
                        {
                            data: 'tipo_falla'
                        },
                        {
                            data: 'estado',
                            render: function(data, type, row) {
                                if (data == 'Abierta') {
                                    return '<span style="color: blue;">Abierta</span>';
                                } else if (data == 'En Proceso') {
                                    return '<span style="color: orange;">En Proceso</span>';
                                } else if (data == 'Completada') {
                                    return '<span style="color: green;">Completada</span>';
                                }
                                return data ? data : '';
                            }
                        }

                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
                    }
                });

            });

            function CrearSolicitud() {
                const url = '<?= base_url('creandoMisolicitud'); ?>';
                let solicitante_id = <?= session()->get('id'); ?>;
                let fecha = document.getElementById('fecha').value;
                let descripcion = document.getElementById('descripcion').value;
                let nombre = document.getElementById('nombre').value;
                let tipoFalla_id = document.getElementById('tipoFalla').value;

                if (nombre === '' || fecha === '' || tipoFalla_id === '' || descripcion === '' || isNaN(Date.parse(fecha))) {
                    const mensaje = document.getElementById('resultado');
                    mensaje.innerHTML = '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos.</div>';
                    return;
                }

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            fecha: fecha,
                            descripcion: descripcion,
                            solicitante_id: parseInt(solicitante_id),
                            tipoFalla_id: parseInt(tipoFalla_id, 10)
                        })
                    })
                    .then(response => response.json())
                    .then(respuesta => {
                        if (respuesta.success) {
                            tabla.ajax.reload();
                            let modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearSolicitud'));
                            modal.hide();
                            let mensaje = 'Su solicitud fue creada correctamente.';
                            setTimeout(function() {
                                toast(mensaje)
                            }, 500);
                        } else {
                            mensaje = 'Error al crear la solicitud.';
                            setTimeout(function() {
                                toast(mensaje)
                            }, 500);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })

            }

            function listarFallas() {

                const url = '<?= base_url('listaFallas') ?>';
                fetch(url)
                    .then(response => response.json())
                    .then(respuesta => {
                        if (respuesta.success) {
                            let select = document.getElementById('tipoFalla');
                            select.innerHTML = '';
                            respuesta.data.forEach(falla => {
                                let option = document.createElement('option');
                                option.value = falla.id;
                                option.textContent = falla.nombre;
                                select.appendChild(option);
                            });
                        } else {
                            alert('Error al cargar las fallas.')
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function LimpiarFormulario() {
                document.getElementById('tipoFalla').value = '';
                document.getElementById('descripcion').value = '';
            }
        </script>

        <script>
            const miModal = document.getElementById('modalCrearSolicitud');
            miModal.addEventListener('show.bs.modal', function(event) {
                const hoy = new Date();
                const anio = hoy.getFullYear();
                const mes = String(hoy.getMonth() + 1).padStart(2, '0');
                const dia = String(hoy.getDate()).padStart(2, '0');

                const campoFecha = miModal.querySelector('#fecha');
                campoFecha.value = `${anio}-${mes}-${dia}`;
            });
        </script>
        <?php echo $this->endSection(); ?>