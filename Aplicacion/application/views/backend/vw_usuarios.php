<?php
/**
* Pagina de usuarios, del lado administrador
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/backend
* @package application/view/backend
*
* @version 1.0.0
* Creado el 26/07/2018 a las 08:33 pm
* Ultima modificacion el 12/08/2018 a las 07:36 pm
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
                <h3 class="text-themecolor">Usuarios</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><span class="text-themecolor">cPanel</span></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
                            <?php if($this->session->has_userdata('idAdmin') && $this->session->userdata('perfil')->privilegios == 'Súper'): ?>
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'Usuario/admin';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Administradores'){echo 'active';}?>"><i class="fa fa-user-secret m-r-5"></i>Admins</a>
                            </div>
                        <?php endif; ?>
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'Usuario/miembros';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Miembros'){echo 'active';}?>"><i class="fa fa-pagelines m-r-5"></i>Miembros</a>
                            </div>
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'Usuario/socios';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Socios'){echo 'active';}?>"><i class="fa fa-money m-r-5"></i>Socios</a>
                            </div>
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'Usuario/representantes';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Representantes'){echo 'active';}?>"><i class="fa fa-building m-r-5"></i>Representantes</a>
                            </div>
                            <div class="col-xs-12 col-md-2 m-b-10">
                                <a href="<?=base_url().'Usuario/general';?>" class="btn btn-default btn-outline-dark <?php if($seccion == 'Usuarios generales'){echo 'active';}?>"><i class="fa fa-users m-r-5"></i>Generales</a>
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