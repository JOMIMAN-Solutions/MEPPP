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
    <script src="<?=base_url();?>template/frontend/js/custombox.min.js"></script>
     <script src="<?=base_url();?>template/frontend/js/efectos.js"></script>

        

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
    <link href="<?=base_url();?>template/frontend/css/estilos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/custombox.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>template/frontend/css/csshake.min.css">
    <script src="<?=base_url();?>template/frontend/js/jquery.smoove.min.js"></script>

    <!-- Main stylesheet and color file-->



    <!--FULLCALENDAR-->


        <link href='<?php echo base_url();?>template/frontend/fullcalendar/css/fullcalendar.css' rel='stylesheet' />
        <link href="<?php echo base_url();?>template/frontend/fullcalendar/css/bootstrapValidator.min.css" rel="stylesheet" />  
        <link href="<?php echo base_url();?>template/frontend/fullcalendar/css/custom.css" rel="stylesheet" />

        <script src='<?php echo base_url();?>template/frontend/fullcalendar/js/moment.min.js'></script>
        <script src="<?php echo base_url();?>template/frontend/fullcalendar/js/bootstrapValidator.min.js"></script>
        <script src="<?php echo base_url();?>template/frontend/fullcalendar/js/fullcalendar.min.js"></script>
        <script src='<?php echo base_url();?>template/frontend/fullcalendar/locale/locale-all.js'></script>
        <script src='<?php echo base_url();?>template/frontend/fullcalendar/js/main.js'></script>
      

    <link href="<?=base_url();?>template/frontend/assets/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="<?=base_url();?>template/frontend/assets/css/colors/default.css" rel="stylesheet">


  </head>
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main >
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      

<nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="<?=base_url().'Frontend/index';?>">MEPPP</a>
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
                <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown"><?=$this->session->userdata('perfil')->nombreUsuario ?></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?=base_url()?>Usuario/perfil">Perfil</a></li>
                      <li><a href="<?=base_url()?>Usuario/logout">Cerrar Sesión</a></li>
                    </ul>
                  </li>
                  
                </li>
              <?php }else{ ?>
                <li class="dropdown" style="text-decoration: underline;"><a  href="<?=base_url();?>Frontend/login" id="<?php if($page=='login'){echo 'active';} ?>" >LOGIN/ÚNETE <span class="glyphicon glyphicon-user"></span></a></li>
              <?php } ?>
            </ul>
            </div>
            </ul>
          </div>
        </div>
      </nav>

      <section class="home-section home-parallax home-fade home-full-height" id="home">
        <div class="hero-slider">
          <ul class="slides">
            <li class="bg-dark-30 bg-dark" style="background-image:url(<?=base_url()?>template/frontend/images/slider.png);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-3 animated bounceInRight" align="left" style="margin-left: 15px">Movimiento Ecologista</div>
                  <div class="font-alt mb-30 titan-title-size-2 animated bounceInLeft" align="left" style="margin-left: 15px">Preocupados por el planeta</div>
                 <!-- <div class="font-alt mb-40 titan-title-size-4">We are Titan</div>
                  <a class="section-scroll btn btn-border-w btn-round" href="#about">Learn More</a>-->
                </div>
              </div>
            </li>
            <li class="bg-dark-30 bg-dark" style="background-image:url(<?=base_url()?>template/frontend/images/slider2.png);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-4">Conoce nuestras campañas</div>
                  <a class="btn btn-border-w btn-round" href="<?=base_url();?>Frontend/campanias">Ver campañas</a>

                </div>
              </div>
            </li>
            <li class="bg-dark-30 bg-dark" style="background-image:url(<?=base_url()?>template/frontend/images/slider4.png);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-4">ADOPTA UN ARBOL</div>
                  <a class="section-scroll btn btn-border-w btn-round" href="<?=base_url();?>Frontend/invernadero">Ver invernadero</a>
                </div>
              </div>
     
            </li>
          </ul>   
      
        </div>
      </section>


