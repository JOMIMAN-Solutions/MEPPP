<?php
/**
* Archivo que contiene la barra superior y sideBar de las paginas
* Ademas de esto contine los enlaces a los archicos css para dar los estilos a los elementos.
*
* @author Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package application/view/template/backend
*
* @version 1.0.0
* Creado el 26/07/2018 a las 05:30 pm
* Ultima modificacion el 28/07/2018 a las 07:55 pm
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url().'template/backend/assets/images/favicon.png';?>">
    <title><?=$title;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url().'template/backend/assets/plugins/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url().'template/backend/template/css/style.css';?>" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=base_url().'template/backend/template/css/colors/green-dark.css';?>" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- CSS files of Grocery CRUD -->
    <?php 
    foreach ($css_files as $file): 
        if ($file == "http://localhost/MEPPP/Aplicacion/assets/grocery_crud/themes/bootstrap-v4/css/bootstrap/bootstrap.min.css"): 
    ?>
            <link rel="stylesheet" href="http://localhost/MEPPP/Aplicacion/assets/grocery_crud/themes/bootstrap-v4/css/bootstrap/bootstrap.css">
        <?php else: ?>
            <link rel="stylesheet" href="<?=$file;?>">
        <?php endif; ?>
    <?php endforeach; ?>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <b><img src="<?=base_url().'template/backend/assets/images/logo-icon.png';?>" alt="homepage"/></b>
                        <!--End Logo icon -->

                        <!-- Logo text -->
                        <span style="color: #525c65;"> MEPPP </span>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->

                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            	<img src="<?=base_url().'template/backend/assets/images/users/1.jpg';?>" alt="user" class="profile-pic m-r-5" />Markarn Doe
                            </a>

                            <ul class="dropdown-menu">
                                <a href="">
                                    <li class="dropdown-item">
                                        <span class="fa fa-user m-r-5"></span>Perfil
                                    </li>
                                </a>
                                <a href="">
                                    <li class="dropdown-item">
                                        <span class="fa fa-sign-out m-r-5"></span>Cerrar sesión
                                    </li>
                                </a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                        <li class="<?=$activeAdopcion;?>">
                            <a href="<?=base_url().'Adopcion/cPanel';?>" class="waves-effect <?=$activeAdopcion;?>"><i class="fa fa-shopping-basket m-r-10" aria-hidden="true"></i>Adopciones</a>
                        </li>
                        <li class="<?=$activeArbol;?>">
                            <a href="<?=base_url().'Arbol/cPanel';?>" class="waves-effect <?=$activeArbol;?>"><i class="fa fa-tree m-r-10" aria-hidden="true"></i>Invernadero</a>
                        </li>
                        <li class="<?=$activeCampania;?>">
                            <a href="<?=base_url().'Campania/cPanel';?>" class="waves-effect <?=$activeCampania;?>"><i class="fa fa-leaf m-r-10" aria-hidden="true"></i>Campañas</a>
                        </li>
                        <li class="<?=$activeComentario;?>">
                            <a href="<?=base_url().'Comentario/cPanel';?>" class="waves-effect <?=$activeComentario;?>"><i class="fa fa-comments m-r-10" aria-hidden="true"></i>Comentarios</a>
                        </li>
                        <li class="<?=$activeFaq;?>">
                            <a href="<?=base_url().'Faq/cPanel';?>" class="waves-effect <?=$activeFaq;?>"><i class="fa fa-question-circle m-r-10" aria-hidden="true"></i>FAQs</a>
                        </li>
                        <li class="<?=$activeUsuario;?>">
                            <a href="<?=base_url().'Usuario/cPanel';?>" class="waves-effect <?=$activeUsuario;?>"><i class="fa fa-users m-r-10" aria-hidden="true"></i>Usuarios</a>
                        </li>
                        <li class="<?=$activeQuienesSomos;?>">
                            <a href="<?=base_url().'QuienesSomos/cPanel';?>" class="waves-effect <?=$activeQuienesSomos;?>"><i class="fa fa-globe m-r-10" aria-hidden="true"></i>¿Quiénes somos?</a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->