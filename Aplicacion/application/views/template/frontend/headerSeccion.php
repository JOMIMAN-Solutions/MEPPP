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
    
    


    <!--JS-->
    <script src="<?=base_url();?>template/frontend/assets/lib/jquery/dist/jquery.js"></script>
    <script src="<?=base_url();?>template/frontend/js/bootstrap4.min.js"></script>
    <script src="<?=base_url();?>template/frontend/fullcalendar/js/jquery.min.js"></script>
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
    <script src="<?=base_url();?>template/frontend/js/jquery.smoove.min.js"></script>
    <!--JS TERMINADO-->

    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/custombox.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/csshake.min.css">




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
                      <?php if ($this->session->has_userdata('idAdmin')): ?>
                        <li><a href="<?=base_url().'Adopcion/cPanel';?>">Volver al cPanel</a></li>
                      <?php endif; ?>
                      <li><a href="<?=base_url()?>Usuario/logout">Cerrar Sesión</a></li>
                    </ul>
                  </li>
                  
                </li>
              <?php }else{ ?>
                <li class="dropdown" style="text-decoration: underline;"><a  href="<?=base_url();?>Frontend/login" id="<?php if($page=='login'){echo 'active';} ?>" >LOGIN/ÚNETE <span class="glyphicon glyphicon-user"></span></a></li>
              <?php } ?>
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
                    <div class="font-alt mb-40 titan-title-size-2"></div>
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
                           if(isset($badUser) && $badUser==5){ ?>
                            <div class="alert alert-danger" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>ERROR!</strong> <?php echo "El usuario no existe"; ?>
                            </div>
                            <?php }?>
                            <?php
                            /**
                            * Condición que determina si hubo errores en el formulario
                            * Si hubo errores se imprimira el error
                            *
                            */
                             if(validation_errors() && $badUser==5){ ?>
                            <div class="alert alert-danger" role="alert">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>ERROR!</strong> <?=validation_errors()?>
                            </div>
                            <?php }?>
              
                          <form action="<?=base_url()?>Usuario/login" method="POST">
                            <label for="" class="control-label">Usuario</label>
                            <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control center-block" name="user" id="user" required="" placeholder="Nombre de usuario">
                            </div><br>
                            <label for="" class="control-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control center-block" name="password" id="password" required="" placeholder="Contraseña">
                            </div><br>
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



