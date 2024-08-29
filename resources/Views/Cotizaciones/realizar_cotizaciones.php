<?php
// Incluir el archivo del menú
include '../../../app/Controller/Principal/menu.php';

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Realizar Cotización</h1>
        <div class="breadcrumb">
            <a href="#" class="breadcrumb-item">Cotizaciones</a>
            <span class="breadcrumb-item active">Realizar Cotización</span>
        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <form class="user" id="cotizacionForm">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Cliente</p>
                                        <input type="text" class="form-control form-control-user" id="cliente" name="cliente" placeholder="Nombre del cliente" required autocomplete="name" title="Ingresa el nombre del cliente">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Tipo de Pasto</p>
                                        <select class="form-control form-control-user" id="tipo_pasto" name="tipo_pasto" required title="Selecciona el tipo de pasto">
                                            <option value="" disabled selected>-- Selecciona un tipo de pasto --</option>
                                            <option value="monofilamento" data-precio="240">Monofilamento</option>
                                            <option value="fibrilado" data-precio="240">Fibrilado</option>
                                            <option value="hibrido" data-precio="250">Híbrido</option>
                                            <option value="texturizado" data-precio="320">Texturizado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Cantidad de metros</p>
                                        <input type="number" class="form-control form-control-user" id="metros" name="metros" min="1" required placeholder="Cantidad de metros" title="Ingresa la cantidad de metros">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Total</p>
                                        <input type="text" class="form-control form-control-user" id="total_precio" name="total_precio" readonly placeholder="Total" title="Precio total">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <input type="hidden" class="form-control form-control-user" id="id_usuario" name="id_usuario" placeholder="" value="<?php echo $id; ?>">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Cotizar
                            </button>
                        </form>

                        <div id="responseMessage"></div> <!-- Para mostrar el mensaje de respuesta -->
                    </div>
                </div>
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
        $('#tipo_pasto, #metros').on('change keyup', function() {
            let precio = $('#tipo_pasto').find(':selected').data('precio');
            let metros = $('#metros').val();
            let total = precio * metros;
            $('#total_precio').val('$' + total.toFixed(2));
        });

        $('#cotizacionForm').on('submit', function(event) {
            event.preventDefault();

            let formData = {
                cliente: $('#cliente').val(),
                tipo_pasto: $('#tipo_pasto').val(),
                metros: $('#metros').val(),
                total_precio: $('#total_precio').val(),
                id_usuario: $('#id_usuario').val()
            };

            $.ajax({
                    type: 'POST',
                    url: '/Cotizador/app/Controller/Cotizaciones/cotizacion_registro.php',
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {
                    if (data.success) {
                        $('#responseMessage').html('<div class="alert alert-success">' + data.message + '</div>');

                        // Mostrar el PDF en una ventana emergente
                        window.open('/Cotizador/' + data.pdf_url, '_blank');

                        $('#cotizacionForm')[0].reset(); // Reiniciar el formulario
                    } else {
                        $('#responseMessage').html('<div class="alert alert-danger">' + data.message + '</div>');
                    }
                })
                .fail(function(xhr, status, error) {
                    $('#responseMessage').html('<div class="alert alert-danger">Ocurrió un error: ' + error + '</div>');
                });
        });
    });
</script>