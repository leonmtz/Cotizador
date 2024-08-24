<?php
// Incluir el archivo del menú
include '../../../app/Controller/Principal/menu.php';

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ver Usuarios</h1>
        <div class="breadcrumb">
            <a href="#" class="breadcrumb-item">Usuarios</a>
            <span class="breadcrumb-item active">Ver Usuarios</span>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Puedes agregar un título aquí si es necesario -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php
// Incluir el archivo del menú
include '../../../app/Controller/Principal/footer.php';

?>


<script>
    $(document).ready(function() {
        $.ajax({
            url: '/Cotizador/app/Controller/Cotizaciones/cotizacion_consulta.php',
            method: 'GET',
            success: function(response) {
                // Insertar el contenido recibido dentro del tbody
                $('#dataTable tbody').html(response);
            },
            error: function() {
                alert('Hubo un error al cargar los datos.');
            }
        });
    });
</script>