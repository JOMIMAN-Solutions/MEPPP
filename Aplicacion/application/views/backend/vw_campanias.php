<?php
/**
* Pagina de campañas, del lado administrador
*
* @author Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package application/view/backend
*
* @version 1.0.0
* Creado el 26/07/2018 a las 08:33 pm
* Ultima modificacion el 02/08/2018 a las 12:13 pm
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
                <h3 class="text-themecolor">Campañas</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><span class="text-themecolor">cPanel</span></li>
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
                                <a href="<?=base_url().'Campania/cPanel';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Campañas'){echo 'active';}?>"><i class="fa fa-leaf m-r-5"></i>Campañas</a>
                            </div>
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'Campania/evidencia';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Evidencia'){echo 'active';}?>"><i class="fa fa-image m-r-5"></i>Evidencia</a>
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