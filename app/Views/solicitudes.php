<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div class="container">

    <div style="margin-bottom: 10px;" class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center">Mis Solicitudes</h3>
            <hr>
            <div class="tabla-scroll-vertical">

                <table id="tablaSolicitudes" class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Solicitante</th>
                            <th>Receptor</th>
                            <th>Tipo De Falla</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFinalizarSolicitud" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalizar Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas finalizar esta solicitud?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="finalizarSolicitud()">Finalizarla</button>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modalAsignarTecnico" tabindex="-1" aria-labelledby="modalAsignarTecnico" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAsignarTecnico">Asignar Técnico</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Detalles de la Solicitud</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombreMisSolicitudes" class="form-label">Nombre del Solicitante</label>
                                <input type="text" class="form-control" id="nombreSolicitude" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fechaSolicitud" class="form-label">Fecha de la Solicitud</label>
                                <input type="date" class="form-control" id="fechaSolicitud" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipoFallaSolicitud" class="form-label">Tipo de falla</label>
                                <input type="text" class="form-control" id="tipoFallaSolicitud" disabled></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="descripcionSolicitud" class="form-label">Descripción</label>
                                <textarea name="text" class="form-control" id="descripcionSolicitud" disabled></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3 class="text-center">Técnicos</h3>

                    <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tecnicosDisponibles" class="form-label text-secondary" >Seleccionar un técnico...</label>
                                <select type="text" class="form-select" id="tecnicosDisponibles"></select>
                            </div>
                        </div>
                    <div id="resultado"></div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="asignarTecnico()">Asignar Técnico</button>
                    </div>
                </div>
            </div>
        </div>
</div>


<?php echo $this->endSection(); ?>
<?php echo $this->section('scripts'); ?>
<script>

    let idSolicitud = 0;
    let tabla;

    window.onload = function() {
            listarTecnico();
        }
    $(document).ready(function() {
        tabla = $('#tablaSolicitudes').DataTable({
            ajax: '<?= base_url('listaSolicitudes'); ?>',
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
                    data: 'solicitante'
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
                },
                {
                    data: null, // Para la columna de acciones
                    orderable: false,
                    render: function(data, type, row) {
                        if(row.estado == 'Abierta'){

                            return `<div style="display:flex;gap:0.5rem;">
                                        <button class="btn btn-primary btn-sm" onclick="seleccionarSolicitud(${row.id})" data-bs-toggle="modal" data-bs-target="#modalAsignarTecnico">Asignar Técnico</button>
                                        <button class="btn btn-secondary btn-sm" disabled>Finalizar Solicitud</button>
                                    </div>`;
                        }else if(row.estado == 'En Proceso'){
                            return `<div style="display:flex;gap:0.5rem;">
                                        <button class="btn btn-secondary btn-sm" disabled>Asignar Técnico</button>
                                        <button class="btn btn-success btn-sm" type="button" onclick="capturarIdSolicitud(${row.id})" data-bs-toggle="modal" data-bs-target="#modalFinalizarSolicitud">Finalizar Solicitud</button>
                                    </div>`;
                        }else if(row.estado == 'Completada'){
                            return `<div style="display:flex;gap:0.5rem;">
                                        <button class="btn btn-secondary btn-sm" disabled>Asignar Técnico</button>
                                        <button class="btn btn-secondary btn-sm"  disabled>Finalizar Solicitud</button>
                                    </div>`;
                        }
                    }
                }

            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            }
        });

    });

    function seleccionarSolicitud(id) {
        idSolicitud = id;
        let datos = tabla.rows().data().toArray();
        const solicitud = datos.find(request => parseInt(request.id, 10) === id);
        if (solicitud) {
            document.getElementById('nombreSolicitude').value = solicitud.solicitante;
            document.getElementById('fechaSolicitud').value = solicitud.fecha;
            document.getElementById('tipoFallaSolicitud').value = solicitud.tipo_falla;
            document.getElementById('descripcionSolicitud').value = solicitud.descripcion;
            LimpiarFormulario();
        } else {
            alert('Solicitud no encontrado.');
        }
    }

    function listarTecnico() {
            const url = '<?= base_url('listaTecnicos'); ?>';
            fetch(url)
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        var select = document.getElementById('tecnicosDisponibles');
                        select.innerHTML = '';
                        respuesta.data.forEach(tecnico => {
                            var option = document.createElement('option');
                            option.value = tecnico.id;
                            option.textContent = `${tecnico.nombres} ${tecnico.apellidos}`;
                            select.appendChild(option);
                        });
                    } else {
                        alert('Error al cargar los tecnicos.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function LimpiarFormulario() {
            document.getElementById('tecnicosDisponibles').value = '';
        }

        function asignarTecnico() {
            const url = '<?= base_url('asignarTecnico'); ?>';
            var receptor_id = document.getElementById('tecnicosDisponibles').value;

            if (receptor_id === '') {
                const divResultado = document.getElementById('resultado');
                divResultado.innerHTML = '<div class="alert alert-danger" role="alert">¡Por favor, seleccionar un tecnico!</div>';
                return;
            }

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: idSolicitud,
                        receptor_id: parseInt(receptor_id, 10),
                    })
                })
                .then(response => response.json())
                .then(respuesta => {
                    if (respuesta.success) {
                        tabla.ajax.reload();
                        var modal = bootstrap.Modal.getInstance(document.getElementById('modalAsignarTecnico'));
                        modal.hide();
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Técnico asignado correctamente!';
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

        function capturarIdSolicitud(id) {
        idSolicitud = id;
    }

    function finalizarSolicitud() {
        const url = '<?= base_url('finalizarSolicitud'); ?>';
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify({
                    id: idSolicitud
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    tabla.ajax.reload();
                    let modal = bootstrap.Modal.getInstance(document.getElementById('modalFinalizarSolicitud'));
                    modal.hide();

                    const mensaje = 'La solicitud fue finalizada correctamente';
                    setTimeout(function() {
                        toast(mensaje);
                    }, 500);
                } else {
                    const mensaje2 = 'Error al finalizar la solicitud';
                    setTimeout(function() {
                        toast(mensaje2);
                    }, 500);
                }
            });
    }

        
</script>
<?php echo $this->endSection(); ?>