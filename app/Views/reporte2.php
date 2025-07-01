<?php echo $this->extend('plantilla/layout'); ?>
<?php echo $this->section('contenido'); ?>

<h1 style="position: relative; top: 20px; font-size: calc(1.3rem + .6vw);" class="text-center">Reporte de Fallas por Departamento</h1><br>
<hr>
<div class="parrafo ms-3 me-3">
    <p style=" padding: 10px; font-size: 20px; text-align: justify;">Esta sección muestra un desglose visual de todas las solicitudes del sistema, comparando la frecuencia de las fallas por cada departamento. A través de los gráficos de barras y circular, puedes ver de un vistazo cuántas fallas corresponden a áreas como Ventas, Administración, Soporte Técnico y otras.</p>
</div>
<div class="container">

    <p></p>
    <div class="contenedor-graficoBarras2">
        <canvas id="chart" height="100" width="200"></canvas>
    </div>
    <hr>
    <div class="contenedor-graficoPastel2">
        <canvas id="chart2" height="50px" width="50px"></canvas>
    </div>
</div>

<br>
<hr>
<br>

<div style="margin-bottom: 10px;" class="row mt-3 ms-2 me-2">
    <div class="col-md-12">
        <h3 class="text-center">Listado de Solicitudes por Departamento</h3>
        <hr>
        <div class="tabla-scroll-vertical">

            <table id="tablaSolicitudesPorDepartamento" class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID Solicitud</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Nombre departamento</th>
                        <th>Nombre Solicitante</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>

<?php echo $this->endSection(); ?>
<?php echo $this->section('scripts'); ?>

<script>
    window.onload = function() {
        ConsultarBD();
    }

    $(document).ready(function() {
        tabla = $('#tablaSolicitudesPorDepartamento').DataTable({
            ajax: '<?= base_url('SolicitudesPorDepartamento'); ?>',
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf']
                }
            },
            columns: [{
                    data: 'solicitud_id'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'fecha'
                },
                {
                    data: 'departamento_nombre'
                },
                {
                    data: 'nombre_solicitante'
                }
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            }
        });

    });

    function ConsultarBD() {

        const url = '<?= base_url('reporte2TipoFallasDepartamento'); ?>';
        fetch(url)
            .then(response => response.json())
            .then(respuesta => {
                if (respuesta.success) {
                    renderChart(respuesta);
                    renderChartTorta(respuesta)
                } else {
                    alert('Error al cargar los datos.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function renderChart(datos) {
        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: datos.labels,
                datasets: [{
                    label: 'Tipos de Fallas',
                    data: datos.data,
                    backgroundColor: [
                        'rgba(44, 105, 182, 0.5)', // Aumentamos la opacidad a 0.5 para más visibilidad
                        'rgba(217, 30, 24, 0.5)',
                        'rgba(27, 188, 155, 0.5)',
                        'rgba(243, 156, 18, 0.5)'
                    ],
                    borderColor: [
                        'rgb(44, 105, 182)',
                        'rgb(217, 30, 24)',
                        'rgb(27, 188, 155)',
                        'rgb(243, 156, 18)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 20 // Tamaño de la leyenda
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafico de Barra',
                        font: {
                            size: 30, // Tamaño del título
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    }

    function renderChartTorta(datos) {
        const ctx2 = document.getElementById('chart2').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: datos.labels,
                datasets: [{
                    label: 'Tipos de Fallas',
                    data: datos.data,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(116, 105, 182)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 159, 64)'
                    ],
                    hoverOffset: 4
                }]
            },

            options: {


                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 20 // Tamaño de la leyenda
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafico de Torta',
                        font: {
                            size: 30, // Tamaño del título
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    }
</script>


<?php echo $this->endSection(); ?>