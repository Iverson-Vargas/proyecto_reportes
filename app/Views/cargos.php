<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center">Cargos</h3>
            <hr>
            <div id="resultado"></div>
            <button class="btn btn-primary"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#modalAgregarCargo"
                onclick="LimpiarFormulario()">
                Agregar Cargo
            </button>
            <div class="tabla-scroll-vertical">
                <table id="tablaCargo" class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaCargos" class="tabla-scroll">
                        <!-- Los datos se llenarán con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Modal eliminar cargo-->
    <div class="modal fade" id="modalEliminarCargo" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este cargo?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="eliminarCargo()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal agregar -->
    <div class="modal fade" id="modalAgregarCargo" tabindex="-1" aria-labelledby="modalAgregarCargo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarCargo">Agregar Cargo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarCargo">
                        <div class="mb-3">
                            <label for="nombreCargoNuevo" class="form-label">Nombre del Cargo</label>
                            <input type="text" class="form-control" id="nombreCargoNuevo">
                            <div id="modalAgregarError"></div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarCargo()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar -->
    <div class="modal fade" id="modalEditarCargo" tabindex="-1" aria-labelledby="modalEditarCargo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarCargo">Editar Cargo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarCargo">
                        <div class="mb-3">
                            <label for="nombreCargoEditar" class="form-label">Nombre del Cargo</label>
                            <input type="text" class="form-control" id="nombreCargoEditar">
                            <div id="modalActualizarError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarCambios()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    //let listadoCargos = [];
    let idCargo = 0;
    let tabla;
    // window.onload = function() {
    //     cargarCargos()
    // }

    $(document).ready(function() {
        tabla = $('#tablaCargo').DataTable({
            ajax: '<?= base_url('listadoCargo'); ?>',

            columns: [{
                    data: 'id'
                },
                {
                    data: 'nombre'
                },
                {
                    data: null, // Para la columna de acciones
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCargo"
                                onclick="editarCargo(${row.id})">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm ms-2"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEliminarCargo"
                                onclick="capturarIdcargo(${row.id})">
                                Eliminar
                            </button>
                        `;
                    }
                }
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            }
        });

    });

    // function cargarCargos() {

    //     const url = '<?= base_url('listadoCargo'); ?>';
    //     fetch(url)
    //         .then(response => response.json())
    //         .then(data => {
    //             listadoCargos = data.data;
    //             if (data.success) {
    //                 const cuerpoTabla = document.getElementById('cuerpoTablaCargos');
    //                 cuerpoTabla.innerHTML = '';
    //                 data.data.forEach(cargo => {
    //                     cuerpoTabla.innerHTML += `
    //           <tr>
    //             <td>${cargo.id}</td>
    //             <td>${cargo.nombre}</td>
    //             <td>
    //               <button class="btn btn-warning btn-sm" 
    //                 type="button"
    //                 data-bs-toggle="modal" 
    //                 data-bs-target="#modalEditarCargo"
    //                 onclick="editarCargo(${cargo.id})"
    //               >
    //                 Editar
    //               <button class="btn btn-danger btn-sm ms-2" 
    //                   type="button"
    //                   data-bs-toggle="modal" 
    //                   data-bs-target="#modalEliminarCargo"
    //                   onclick="capturarIdcargo(${cargo.id})"
    //                 >
    //                   Eliminar
    //                 </button>
    //             </td>
    //           </tr>
    //         `;
    //                 });

    //             } else {

    //                 alert("error al cargar los cargos");

    //             }
    //         });
    // }

    function editarCargo(id) {
        ;
        // obtengo el cargo a editar
        idCargo = id;
        let datos = tabla.rows().data().toArray();
        const cargo = datos.find(c => parseInt(c.id) === id);
        if (cargo) {
            // lleno el formulario con los datos del cargo
            const nombreCargo = document.getElementById('nombreCargoEditar');
            nombreCargo.value = cargo.nombre;
        }
    }

    function capturarIdcargo(id) {
        idcargo = id;
    }

    function eliminarCargo() {
        const url = '<?= base_url('EliminarCargo'); ?>';
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: idcargo
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    tabla.ajax.reload();
                    let modal = bootstrap.Modal.getInstance(document.getElementById('modalEliminarCargo'));
                    modal.hide();

                    const mensaje = 'EL cargo fue eliminado correctamente';
                    setTimeout(function() {
                        toast(mensaje);
                    }, 500);

                } else {
                    const mensaje2 = 'Error al eliminar el cargo';
                    setTimeout(function() {
                        toast(mensaje2);
                    }, 500);
                }
            });
    }

    function agregarCargo() {
        const url = '<?= base_url('CrearCargo'); ?>';
        const nombreCargo = document.getElementById('nombreCargoNuevo').value;
        if (nombreCargo) {
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: nombreCargo
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        //alert('Cargo creado correctamente');
                        //cargarCargos();
                        tabla.ajax.reload();
                        let modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarCargo'));
                        modal.hide();
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Cargo creado correctamente!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);

                    } else {
                        //alert('Error al crear el cargo');
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Error al crear el departamento!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);
                    }
                });
        } else {
            //alert('Por favor, ingresar un nombre de cargo.');
            let mensaje = document.getElementById('modalAgregarError');
            mensaje.innerHTML = `<span style="color:red;">¡Por favor, ingresar un nombre de cargo!</span>`;
        }
    }

    function actualizarCambios() {
        const url = '<?= base_url('ActualizarCargo') ?>';
        const nombreCargo = document.getElementById('nombreCargoEditar').value;
        if (nombreCargo) {
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: nombreCargo,
                        id: idCargo
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        tabla.ajax.reload();
                        let modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarCargo'));
                        modal.hide();
                        //cargarCargos();
                        const mensaje = 'EL nombre del cargo fue actualizado correctamente'
                        setTimeout(function() {
                            toast(mensaje);
                        }, 500)
                    } else {
                        //alert('Error al actualizar el cargo');
                        const mensaje2 = 'Error al actualizar el nombre del cargo'
                        setTimeout(function() {
                            toast(mensaje2)
                        }, 500);
                    }
                });
        } else {
            //alert('Por favor, ingresar un nombre de cargo.');
            let error = document.getElementById('modalActualizarError');
            error.innerHTML = `<span style="color:red;">¡Por favor, ingresar un nombre de departamento!</span>`;
        }

    }
    
    function LimpiarFormulario() {
        document.getElementById('nombreCargoNuevo').value = '';
    }
</script>
<?php echo $this->endSection(); ?>