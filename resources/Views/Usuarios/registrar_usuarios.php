<?php
// Incluir el archivo del menú
include '../../../app/Controller/Principal/menu.php';
include '../../../app/Controller/Usuarios/usuarios_roles.php';

//echo $id;

?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registrar Usuarios</h1>
        <div class="breadcrumb">
            <a href="#" class="breadcrumb-item">Usuarios</a>
            <span class="breadcrumb-item active">Registrar Usuarios</span>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Puedes agregar un título aquí si es necesario -->
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <form class="user" id="registerForm">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Nombre</p>
                                        <input type="text" class="form-control form-control-user" id="nombre" name="nombre" placeholder="Nombre" required autocomplete="given-name" title="Ingresa tu nombre">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Apellido</p>
                                        <input type="text" class="form-control form-control-user" id="apellido" name="apellido" placeholder="Apellido" required autocomplete="family-name" title="Ingresa tu apellido">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Correo electrónico</p>
                                        <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Correo electrónico" required autocomplete="email" title="Ingresa tu correo electrónico">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Contraseña</p>
                                        <input type="password" class="form-control form-control-user" id="contra" name="contra" placeholder="Contraseña" required autocomplete="new-password" title="Crea una contrasea segura">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Confirmar Contraseña</p>
                                        <input type="password" class="form-control form-control-user" id="contra_confirmar" name="contra_confirmar" placeholder="Confirmar Contraseña" required autocomplete="new-password" title="Confirma tu contraseña">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <p>Rol</p>
                                        <select class="form-control form-control-user" id="rol" name="rol" required title="Selecciona el rol de usuario">
                                            <?php echo $options; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group" style="padding-bottom: 5px;">
                                        <input type="hidden" class="form-control form-control-user" id="usuario_alta" name="usuario_alta" placeholder="" value="<?php echo $id; ?>">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registrar usuario
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
        $('#registerForm').on('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario por defecto

            var formData = {
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                email: $('#email').val(),
                contra: $('#contra').val(),
                contra_confirmar: $('#contra_confirmar').val(),
                rol: $('#rol').val(),
                usuario_alta: $('#usuario_alta').val() 
            };

            // Enviar los datos a través de AJAX
            $.ajax({
                    type: 'POST',
                    url: '/Cotizador/app/Controller/Usuarios/usuarios_registro.php', 
                    data: formData,
                    dataType: 'json',
                    encode: true
                })
                .done(function(data) {
                    console.log("Respuesta del servidor:", data);
                    try {
                        if (data.success) {
                            $('#responseMessage').html('<div class="alert alert-success">' + data.message + '</div>');
                            $('#registerForm')[0].reset(); 
                        } else {
                            $('#responseMessage').html('<div class="alert alert-danger">' + data.message + '</div>');
                        }
                    } catch (e) {
                        $('#responseMessage').html('<div class="alert alert-danger">Error en la respuesta: ' + e.message + '</div>');
                        console.log("Error al procesar la respuesta:", data); 
                    }
                })
                .fail(function(xhr, status, error) {
                    // Manejar errores de AJAX
                    $('#responseMessage').html('<div class="alert alert-danger">Ocurrió un error: ' + error + '</div>');
                    console.log("Error de AJAX:", xhr.responseText); 
                });
        });
    });
</script>


</html>