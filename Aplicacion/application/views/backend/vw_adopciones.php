<?php
/**
* Pagina de adopciones, del lado administrador
*
* @author Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package application/view/backend
*
* @version 1.0.0
* Creado el 26/07/2018 a las 06:00 pm
* Ultima modificacion el 03/08/2018 a las 12:48 am
*/
?>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-12">
                <h3 class="text-themecolor">Adopciones</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><span class="text-themecolor">cPanel</span></li>
                    <li class="breadcrumb-item active">Adopciones</li>
                    <li class="breadcrumb-item active"><?=$accion;?></li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <?=$output;?>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center">
        © 2017 Monster Admin by wrappixel.com
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->