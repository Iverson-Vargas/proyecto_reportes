<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center">Departamentos</h3>
            <hr>
            <div id="resultado"></div>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregarDepartamentos"
            onclick="LimpiarFormulario()">
                Agregar Departamentos
            </button>
            <div class="tabla-scroll-vertical">
                <table id="tablaDepartamento" class="table table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Departamento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpoTablaDepartamento">
                        <!-- Los datos se llenarán con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Modal eliminar Departamento-->
    <div class="modal fade" id="modalEliminarDepartamento" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Departamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este departamento?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="eliminarDepartamento()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar Departament -->
    <div class="modal fade" id="modalAgregarDepartamentos" tabindex="-1" aria-labelledby="modalAgregarDepartamentos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAgregarDepartamentos">Agregar Departamento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarDepartamento">
                        <div class="mb-3">
                            <label for="nombreDepartamentoNuevo" class="form-label">Nombre del Departamento</label>
                            <input type="text" class="form-control" id="nombreDepartamentoNuevo">
                            <div id="modalAgregarError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarDepartamento()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal actualizar Departament -->
    <div class="modal fade" id="modalActualizarDepartamentos" tabindex="-1" aria-labelledby="modalActualizarDepartamentos" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalActualizarDepartamentos">Actualizar Departamento</h1>
                </div>
                <div class="modal-body">
                    <form id="formAgregarDepartamento">
                        <div class="mb-3">
                            <label for="nombreDepartamentoActualizar" class="form-label">Nombre del Departamento</label>
                            <input type="text" class="form-control" id="nombreDepartamentoActualizar">
                            <div id="modalActualizarError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="actualizarDepartamento()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>

<script>
    //let listadoDepartamentos = [];
    let tabla;
    let idDepartamento = 0;
    // window.onload = function() {
    //     cargarDepartamentos();
    // }

    $(document).ready(function() {
        tabla = $('#tablaDepartamento').DataTable({
            ajax: '<?= base_url('listadoDepartamentos'); ?>',

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
        data-bs-target="#modalActualizarDepartamentos"
        onclick="editarDepartamento(${row.id})">
        Editar
    </button>
    <button class="btn btn-danger btn-sm ms-2"
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#modalEliminarDepartamento"
        onclick="capturarIdDepartamento(${row.id})">
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

    // function cargarDepartamentos() {
    //     const url = '<?= base_url('listadoDepartamentos'); ?>';
    //     fetch(url)
    //         .then(response => response.json())
    //         .then(data => {
    //             listadoDepartamentos = data.data;
    //             if (data.success) {
    //                 const cuerpoTabla = document.getElementById('cuerpoTablaDepartamento');
    //                 cuerpoTabla.innerHTML = '';
    //                 data.data.forEach(departamento => {
    //                     cuerpoTabla.innerHTML += `
    //             <tr>
    //               <td>${departamento.id}</td>
    //               <td>${departamento.nombre}</td>
    //               <td>
    //                 <button class="btn btn-warning btn-sm" 
    //                   type="button"
    //                   data-bs-toggle="modal" 
    //                   data-bs-target="#modalActualizarDepartamentos"
    //                   onclick="editarDepartamento(${departamento.id})"
    //                 >
    //                   Editar
    //                 </button>
    //                 <button class="btn btn-danger btn-sm ms-2" 
    //                   type="button"
    //                   data-bs-toggle="modal" 
    //                   data-bs-target="#modalEliminarDepartamento"
    //                   onclick="capturarIdDepartamento(${departamento.id})"
    //                 >
    //                   Eliminar
    //                 </button>
    //               </td>
    //             </tr>
    //           `;
    //                 });

    //             } else {
    //                 alert("Error al cargar los departamentos")
    //             }
    //         });
    // }

    function agregarDepartamento() {
        const nombreDepartamento = document.getElementById('nombreDepartamentoNuevo').value;
        const url = '<?= base_url('CrearDepartamento'); ?>';

        if (nombreDepartamento) {
            fetch(url, {
                    method: 'POST',
                    Headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: nombreDepartamento
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        tabla.ajax.reload();

                        let modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarDepartamentos'));
                        modal.hide();
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Departamento creado correctamente!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);
                    } else {
                        setTimeout(function() {
                            var toastEl = document.getElementById('mensaje');
                            toastEl.querySelector('.toast-body').textContent = '¡Error al crear el departamento!';
                            var toast = new bootstrap.Toast(toastEl);
                            toast.show();
                        }, 500);
                    }
                });
        } else {
            let mensaje = document.getElementById('modalAgregarError');
            mensaje.innerHTML = `<span style="color:red;">¡Por favor, ingresar un nombre de Departamento!</span>`;
        }
    }

    function editarDepartamento(id) {
        idDepartamento = id;
        let datos = tabla.rows().data().toArray();
        const departamento = datos.find(dep => parseInt(dep.id, 10) === id);
        if (departamento) {
            document.getElementById('nombreDepartamentoActualizar').value = departamento.nombre;
            // No abras el modal aquí, ya lo hace el botón
        } else {
            alert('Departamento no encontrado.');
        }
    }

    function actualizarDepartamento() {
        const nombreDepartamento = document.getElementById('nombreDepartamentoActualizar').value;
        const url = '<?= base_url('ActualizarDepartamento'); ?>';
        if (nombreDepartamento) {
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: nombreDepartamento,
                        id: idDepartamento
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        tabla.ajax.reload();
                        let modal = bootstrap.Modal.getInstance(document.getElementById('modalActualizarDepartamentos'));
                        modal.hide();
                        const mensaje = 'EL nombre del departamento fue actualizado correctamente'
                        setTimeout(function() {
                            toast(mensaje)
                        }, 500);
                    } else {
                        const mensaje2 = 'Error al actualizar el nombre del departamento'
                        setTimeout(function() {
                            toast(mensaje2)
                        }, 500);
                    }
                });
        } else {
            let error = document.getElementById('modalActualizarError');
            error.innerHTML = `<span style="color:red;">¡Por favor, ingresar un nombre de departamento!</span>`;
        }
    }

    function capturarIdDepartamento(id) {
        idDepartamento = id;
    }

    function eliminarDepartamento() {
        const url = '<?= base_url('EliminarDepartamento'); ?>';
        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify({
                    id: idDepartamento
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    tabla.ajax.reload();
                    let modal = bootstrap.Modal.getInstance(document.getElementById('modalEliminarDepartamento'));
                    modal.hide();

                    const mensaje = 'EL departamento fue eliminado correctamente';
                    setTimeout(function() {
                        toast(mensaje);
                    }, 500);
                } else {
                    const mensaje2 = 'Error al eliminar el departamento';
                    setTimeout(function() {
                        toast(mensaje2);
                    }, 500);
                }
            });
    }

    function LimpiarFormulario() {
        document.getElementById('nombreDepartamentoNuevo').value = '';
    }
</script>

<?php echo $this->endSection(); ?>