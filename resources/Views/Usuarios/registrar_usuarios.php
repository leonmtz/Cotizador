<?php
// Incluir el archivo del menú
include '../../../app/Controller/Principal/menu.php';

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
                                        <input type="password" class="form-control form-control-user" id="contra" name="contra" placeholder="Contraseña" required autocomplete="new-password" title="Crea una contraseña segura">
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
                                            <option value="" disabled selected>-- Seleccionar un rol --</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuario</option>
                                            <option value="3">Invitado</option>
                                            <!-- Puedes agregar más opciones según lo que necesites -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Registrar usuariox|
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