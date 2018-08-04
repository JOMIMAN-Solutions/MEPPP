<?php
/**
* Pagina de ¿Quiénes somos?, del lado administrador
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/backend
* @package application/view/backend
*
* @version 1.0.0
* Creado el 26/07/2018 a las 08:33 pm
* Ultima modificacion el 03/08/2018 a las 10:11 pm
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
                <h3 class="text-themecolor">¿Quiénes somos?</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><span class="text-themecolor">cPanel</span></li>
                    <li class="breadcrumb-item active">¿Quiénes somos?</li>
                    <li class="breadcrumb-item active"><?=$seccion;?></li>
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
                        <div class="row">
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'QuienesSomos/datos';?>" class="btn btn-default btn-outline-dark m-r-10 <?php if($seccion == 'Datos'){echo 'active';}?>"><i class="fa fa-file m-r-5"></i>Datos</a>
                            </div>

                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'QuienesSomos/valores';?>" class="btn btn-default btn-outline-dark m-r-10 <?php if($seccion == 'Valores'){echo 'active';}?>"><i class="fa fa-heart m-r-5"></i>Valores</a>
                            </div>

                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'QuienesSomos/direccion';?>" class="btn btn-default btn-outline-dark m-r-10 <?php if($seccion == 'Dirección'){echo 'active';}?>"><i class="fa fa-map-marker m-r-5"></i>Dirección</a>
                            </div>
                        </div>

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