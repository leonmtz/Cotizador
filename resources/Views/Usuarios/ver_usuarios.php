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


    <div class="row">


    </div>

</div>



<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estas listo para finalizar tu sesion?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">¿Estas seguro que quieres cerrar sesion?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <a class="btn btn-primary" href="login.html">Cerrar Sesion</a>
            </div>
        </div>
    </div>
</div>

<?php
// Incluir el archivo del menú
include '../../../app/Controller/Principal/footer.php';

?>