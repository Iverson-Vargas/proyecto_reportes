<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<div class="container">

    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-center">Cargos</h3>
            <div id="resultado"></div>
            <button class="btn btn-primary"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#modalAgregarCargo">
                Agregar Cargo
            </button>
            <div class="tabla-scroll-vertical">
                <table class="table table-striped table-bordered mt-3">
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
    <div class="modal fade" id="modalAgregarCargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Cargo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarCargo">
                        <div class="mb-3">
                            <label for="nombreCargoNuevo" class="form-label">Nombre del Cargo</label>
                            <input type="text" class="form-control" id="nombreCargoNuevo">
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
    let listadoCargos = [];
    let idCargo = 0;
    window.onload = function() {
        cargarCargos()
    }

    function cargarCargos() {

        const url = '<?= base_url('listadoCargo'); ?>';
        fetch(url)
            .then(response => response.json())
            .then(data => {
                listadoCargos = data.data;
                if (data.success) {
                    const cuerpoTabla = document.getElementById('cuerpoTablaCargos');
                    cuerpoTabla.innerHTML = '';
                    data.data.forEach(cargo => {
                        cuerpoTabla.innerHTML += `
              <tr>
                <td>${cargo.id}</td>
                <td>${cargo.nombre}</td>
                <td>
                  <button class="btn btn-warning btn-sm" 
                    type="button"
                    data-bs-toggle="modal" 
                    data-bs-target="#modalEditarCargo"
                    onclick="editarCargo(${cargo.id})"
                  >
                    Editar
                  <button class="btn btn-danger btn-sm ms-2" 
                      type="button"
                      data-bs-toggle="modal" 
                      data-bs-target="#modalEliminarCargo"
                      onclick="capturarIdcargo(${cargo.id})"
                    >
                      Eliminar
                    </button>
                </td>
              </tr>
            `;
                    });

                } else {

                    alert("error al cargar los cargos");

                }
            });
    }

    function editarCargo(id) {
        ;
        // obtengo el cargo a editar
        idCargo = id;
        const cargo = listadoCargos.find(c => parseInt(c.id) === id);
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
                    alert('Cargo Eliminado correctamente');
                    cargarCargos();
                } else {
                    alert('Error al eliminar el cargo');
                }
            });
    }

    function agregarCargo() {
        const url = '<?= base_url('CrearCargo');?>';
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
                        alert('Cargo creado correctamente');
                        cargarCargos();
                    } else {
                        alert('Error al crear el cargo');
                    }
                });
        } else {
            alert('Por favor, ingresar un nombre de cargo.');
        }
    }

    function actualizarCambios() {
        const url = '<?= base_url('ActualizarCargo')?>';
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
                        let modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarCargo'));
                        modal.hide();
                        cargarCargos();
                        const mensaje = 'EL nombre del cargo fue actualizado correctamente'
                        setTimeout(function() {
                            toast(mensaje);
                        }, 500)
                    } else {
                        alert('Error al actualizar el cargo');
                    }
                });
        } else {
            alert('Por favor, ingresar un nombre de cargo.');
        }
    }
</script>
<?php echo $this->endSection(); ?>