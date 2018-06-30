<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--  
    Document Title
    =============================================
    -->
    <title><?=$title?></title>
    <!--  
    Favicons
    =============================================
    -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>template/frontend/assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url();?>template/frontend/assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>template/frontend/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url();?>template/frontend/assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>template/frontend/assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=base_url();?>template/frontend/assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--  
    Stylesheets
    =============================================
    
    -->
    <!-- Default stylesheets-->

    <link href="<?=base_url();?>template/frontend/assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="<?=base_url();?>template/frontend/assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/custombox.min.css">


    <!--JS-->
    <script src="<?=base_url();?>template/frontend/assets/lib/jquery/dist/jquery.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/wow/dist/wow.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/smoothscroll.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/js/plugins.js"></script>
    <script src="<?=base_url();?>template/frontend/assets/js/main.js"></script>
    <script src="<?=base_url();?>template/frontend/js/jquery.smoove.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="<?=base_url();?>template/frontend/css/estilos.css" rel="stylesheet">
    <script src="<?=base_url();?>template/frontend/js/custombox.min.js"></script>
    <!--JS TERMINADO-->





    <!-- Main stylesheet and color file-->
    <link href="<?=base_url();?>template/frontend/assets/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="<?=base_url();?>template/frontend/assets/css/colors/default.css" rel="stylesheet">
  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>

      <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="index.html">MEPPP</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a  href="<?=base_url().'Frontend/index';?>" id="<?php if($page=='Inicio'){echo 'active';} ?>">Inicio <span class="glyphicon glyphicon-home"></span></a></li>
              <li class="dropdown"><a  href="<?=base_url().'Arbol';?>" id="<?php if($page=='Invernadero'){echo 'active';} ?>">Invernadero <span class="glyphicon glyphicon-tree-conifer"></span></a></li>
              <li class="dropdown"><a  href="<?=base_url().'Campania';?>" id="<?php if($page=='Campañas'){echo 'active';} ?>" >Campañas <span class="glyphicon glyphicon-leaf"></span></a></li>
              <li class="dropdown"><a  href="<?=base_url().'Usuario/getSocios';?>" id="<?php if($page=='Socios'){echo 'active';} ?>" >Socios <span class="glyphicon glyphicon-briefcase"></span></a></li>
              <li class="dropdown"><a  href="<?=base_url().'Comentario';?>" id="<?php if($page=='Comentarios'){echo 'active';} ?>">Comentarios <span class="glyphicon glyphicon-comment"></span></a></li>
              <li class="dropdown"><a  href="<?=base_url().'Faq';?>" id="<?php if($page=='FAQS'){echo 'active';} ?>">FAQS <span class="glyphicon glyphicon-question-sign"></span></a></li>
              <li class="dropdown"><a  href="<?=base_url().'Frontend/quienesSomos';?>" id="<?php if($page=='¿Quienes Somos?'){echo 'active';} ?>" >¿Quiénes somos? <span class="glyphicon glyphicon-globe"></span></a></li>
              <?php
              /**
              * Condicion que determina si la session perfil existe
              * Si se cumple la condición, se abrirá una sección con el nombre del usuario logeado si no, se abrirá una sección para logearse o inscribirse. 
              *
              */
               if ($this->session->userdata('perfil')) { ?>
                <li class="dropdown"><a class="dropdown-toggle" id="<?php if($page=='perfil'){echo 'active';} ?>" data-toggle="dropdown"><?=$this->session->userdata('perfil')->nombreUsuario ?></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?=base_url()?>Usuario/perfil">Perfil</a></li>
                      <li><a href="<?=base_url()?>Usuario/logout">Cerrar Sesión</a></li>
                    </ul>
                  </li>
                  
                </li>
              <?php }else{ ?>
                <li class="dropdown" style="text-decoration: underline;"><a  href="<?=base_url();?>Frontend/login" id="<?php if($page=='login'){echo 'active';} ?>" >LOGIN/ÚNETE <span class="glyphicon glyphicon-user"></span></a></li>
              <?php } ?>
              <li class="dropdown"><a  href="#" ><span class="glyphicon glyphicon-tree-deciduous"></span></a></li>
            </ul>
          </div>
        </div>
      </nav>

      <section class="home-section home-parallax home-fade <?php if($page=='login'){echo 'home-full-height';} ?> bg-dark-30" id="home" data-background="<?=base_url();?>template/Frontend/images/<?=$imagen?>.jpg">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-alt mb-40 titan-title-size-4"><?=$page?></div>
            <?php 
            /**
              * Switch que determina el contenido que tendra la sección dependiendo de la variable $seccion
              *
              */
              switch ($seccion) {
                case '1': ?>
                    <div class="font-alt mb-40 titan-title-size-2">Adopta un árbol y contribuye junto a nosotros a ayudar al medio ambiente.<br> Tu adopción contribuye a frenar el calentamiento global.</div>
                  <?php
                  break;
                case '2': ?>
                    <div class="font-alt mb-40 titan-title-size-2"></div>
                  <?php
                  break;
                case '3': ?>
                    <div class="font-alt mb-40 titan-title-size-2"></div>
                  <?php
                  break;
                case '4': ?>
                    <div class="font-alt mb-40 titan-title-size-2"></div>
                  <?php
                  break;
                case '5': ?>
                    <div class="font-alt mb-40 titan-title-size-2"></div>
                  <?php
                  break;
                case '6': ?>
                    <div class="font-alt mb-40 titan-title-size-2"></div>
                  <?php
                  break;  
                case '7': ?>
                    <div class="col-lg-4"></div>

                    
                        <div class="col-lg-4">
                          <?php
                          /**
                          * Condición que determina si la variable $badUser existe
                          * Si existe la variable $badUser se imprimira un error
                          *
                          */
                           if(isset($badUser)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>ERROR!</strong> <?php echo $badUser; ?>
                            </div>
                            <?php }?>
                            <?php
                            /**
                            * Condición que determina si hubo errores en el formulario
                            * Si hubo errores se imprimira el error
                            *
                            */
                             if(validation_errors()){ ?>
                            <div class="alert alert-danger" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>ERROR!</strong> <?=validation_errors()?>
                            </div>
                            <?php }?>
                          
                          <form action="<?=base_url()?>Usuario/login" method="POST">
                            <label for="" class="control-label">Usuario</label>
                              <input type="text" class="form-control center-block" name="user" id="user" required=""><br>
                            <label for="" class="control-label" placeholder="Nombre de usuario">Password</label>
                              <input type="password" class="form-control center-block" name="password" id="password" required=""><br>
                              <button type="submit" class="btn btn-success">Entrar</button>
                          </form>
                        <div class="large-text align-center"><a class="section-scroll" href="#services">Registrate <i class="fa fa-angle-down"></i></a></div>



                        </div>

                        <div class="col-lg-4"></div>

                  <?php
                  break;  
                default:
                  # code...
                  break;
              }
             ?>
            
          </div>
        </div>
      </section>



