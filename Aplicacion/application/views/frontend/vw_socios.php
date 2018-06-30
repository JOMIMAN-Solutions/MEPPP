<?php
/**
* Pagina de Socios
* En esta pagina se cargan todas los socios de la asociasion
*
* @author Giovanni Misael Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package application/views/frontend
*
* @version 1.0.0
* Creado el 15/06/2018 a las 6:30 pm
*/
?>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>

<div class="row" style="margin-bottom: 20px">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">CONOCE A NUESTROS SOCIOS</h1>
    </div>
 </div>
 <div class="row">
 	<div class="col-lg-1 col-xs-12"></div>
 	<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
 		<div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <?php
              /**
              * Condición que valida si existe la variable $socios y esta no esta vacia.
              */
              if (isset($socios) && $socios != 0):
                $cont = 0;
                /**
                * Bucle que recorre el arreglo $socios.
                * El bucle asigna a la variable $socio el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($socios as $socio):
                  /**
                  * Condición que determina cuantos elementos mostrar en el slider.
                  */
                  if ($cont % 8 == 0):
              ?>
                  <li data-target="#myCarousel" data-slide-to="<?=$cont?>" class="<?php if($cont==0){echo 'active';}?>"></li>
              <?php
                    endif;
                    $cont++;
                  endforeach;
                endif;
              ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <?php
              /**
              * Condición que valida si existe la variable $socios y esta no esta vacia.
              */
              if (isset($socios) && $socios != 0):
                $cont = 0;
              ?>
              <div class="item <?php if($cont==0){echo 'active';}?>" style="margin-top: 10px;margin-bottom: 10px">
            	 <div class="row">
                <?php
                  /**
                  * Bucle que recorre el arreglo $socios.
                  * El bucle asigna a la variable $socio el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                  */
                  foreach ($socios as $socio):
                ?>
                  <div class="col-lg-3 col-xs-12" >
                    <a class="contenedor-img ejemplo-1"><img src="<?=base_url().'images/usuarios/'.$socio->avatar;?>"></a>
                    <div style="background-color: #38761d">
                      <h4 align="center" class="titlePlanta"><?=$socio->nombreUsuario . ' ' . $socio->apePat .' ' . $socio->apeMat;?></h4>
                      <h4 align="center" class="datosPlanta">Representante de: <?=$socio->nombreOrganizacion;?></h4>
                    </div>
                  </div>
                  <?php
                      $cont++;
                    endforeach;
                  ?>
                </div>	
              </div>
            <?php
              endif;
            ?>
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
 	</div>
 	<div class="col-lg-1 col-xs-12"></div>
 </div>

 <div class="row">
 	<div class="col-lg-1 col-xs-12"></div>
 	<div class="col-lg-10 col-xs-12">
 		<a href="<?=base_url().'Frontend/login#services';?>" class="btn btn-success center-block greenButton" style="font-size: 20px">Únete Ahora <span class="fa fa-fw">&#xf061;</span></a>
 	</div>
 	<div class="col-lg-1 col-xs-12"></div>
 </div>


