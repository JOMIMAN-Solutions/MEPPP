<?php
/**
* Pagina principal
* En esta pagina se encuentran 3 secciones...
*     - Calendario de campañas
*     - Arboles de temporada
*     - Principales socios
*
* @autor Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package application/views/frontend
*
* @version 1.0
* Creado el 15/06/2018 a las 10:00 pm
* Ultima modificacion el 03/08/2018 a las 02:23 am
*/
?>

<script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'10%'}); 
});

</script>

<div class="main" style="background-color: #b6d7a8">
	<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>

  <!--SECCION DE CUIDA EL PLANETA-->
  <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax1.png">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <img src="<?=base_url();?>template/frontend/images/cuidaPlaneta.png" class="img-responsive bloque" data-move-y="200px" data-move-x="-200px" >
        </div>
      </div>
      <div class="row">
      <div class="col-sm-12 col-xs-12">
          <div class="module-subtitle font-serif">
            <h1 style="color:#ffffff;" align="center" class="bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px" >Procuremos siempre que nuestros actos, dejen una <strong>huella verde</strong> en nuestro camino. <span class="glyphicon glyphicon-leaf"></span></h1>
            <hr style="height: 3px; background-color: #ffffff;">
          </div>
      </div>
    </div>
    </div>
  </section>


  <!--SECCION DE PROXIMAS CAMPAÑAS-->
  <div class="bloque" data-move-x="150%">
    <div class="row">
      <div class="col-lg-12 col-xs-12 col-sm-12 divRedondoR borderTopBrown shadowL">
        <h1 class="white" align="center" style="font-size: 45px;">Próximas campañas <span class="glyphicon glyphicon-calendar"></span> </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax2.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-serif" align="center" >No te pierdas ninguna de nuestras campañas!!!</h1>
                 <h3 class="white" align="center">Ven y juntos cuidemos el medio ambiente. <span class="glyphicon glyphicon-globe" style="color:#004e87"></span></h3>

              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <div class="row divContenidoR" style="display: none;" id="calendario">
      <div class="col-lg-2 col-xs-12 hidden-xs hidden-sm hidden-md">
        <img src="<?=base_url();?>template/frontend/images/planta4.png" style="padding-top:100%">
      </div>
      <div class="col-lg-8 col-xs-12">
        <h1 align="center" class="white">Calendario de proximos eventos</h1>
        <div  style="background-color: white;" class="divCalendario">
          <div id='calendar' style="padding-top: 10px;"></div><br>
        </div>
      </div>
      <div class="col-lg-2 col-xs-12 hidden-xs hidden-sm hidden-md">
        <img src="<?=base_url();?>template/frontend/images/planta3.png" alt="">
      </div>
    </div> 
      <div class="row divContenidoR shadowL" style="padding-top: 10px">
        <div class="col-lg-12 col-xs-12" align="center">
          <a class="btn btn-circle blueButton2" onclick="mostrar()" id="btnCalendario">Ver proximos eventos<span class="glyphicon glyphicon-calendar"></span></a><br>
          <a href="<?=base_url().'Campania';?>" class="btn btn-circle greenButton" style="font-size: 20px;">Ver campañas <span class="fa fa-fw">&#xf06c;</span></a>
        </div>
      </div>
  </div>

  <!--SECCION DE ARBOLES DE TEMPORADA-->
  <div class="bloque" data-move-x="-150%">
    <div class="row">
      <div class="col-lg-12 col-xs-12 col-sm-12 divRedondoR borderTopBrown shadowR" >
        <h1 class="white" align="center" style="font-size: 45px"><span class="glyphicon glyphicon-tree-deciduous"></span>Árboles de temporada</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax3.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="white font-serif" align="center">La lista que esperabas con los árboles de temporada en cada mes o estación.</h1>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <div class="row" id="hola">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoL shadowR">
        <div class="row" style="margin-left: 10px;margin-right: 10px;">
        
            <div id="myCarousel" class="carousel slide" >
            <!-- Indicators -->
              <ol class="carousel-indicators">
              <?php
              /**
              * Condición que valida si existe la variable $arbolesTemp y si esta o no vacia.
              */
              if (isset($arbolesTemp) && $arbolesTemp != 0):
                $i = 0;
                /**
                * Bucle que recorre el arreglo $arbolesTemp.
                * El bucle asigna a la variable $arbolT el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($arbolesTemp as $arbolT):
                  /**
                  * Condición que determina cuantos indicadores mostrar en el carousel.
                  */
                  if (($i % 3) == 0):
              ?>
                    <li data-target="#myCarousel" data-slide-to="<?=$i;?>" class="<?php
                    /**
                    * Condición que determina si la variable i es igual a cero para colocar el indicador del slider como activo
                    */
                     if($i==0){echo 'active';}?>"></li>                  
              <?php
                  endif;
                  $i++;
                endforeach;
              endif;
              ?>
            </ol>

            <!-- Wrapper for slides -->
          <div class="carousel-inner">
                <?php
                /**
                * Condición que valida si existe la variable $arbolesTemp y esta no esta vacia.
                */
                if (isset($arbolesTemp) && $arbolesTemp != 0):
                  $i=0; 
                  /**
                  * Bucle que recorre el arreglo $arboles
                  * El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                  */
                  foreach($arbolesTemp as $arbolT):
                    /**
                    * Condicion que determina cuantos elementos contendra el slider
                    */
                    if (($i % 3) == 0):
                      /**
                      * Condicion que determina cuando cerrar el slider
                      */
                      if($i != 0):  
                ?>
                      </div>
                    <?php endif; ?>
                    <div class="item <?php
                      /**
                      * Condicion que determina si la variable i es igual a 0 para activar el item del slider correspondiente
                      */
                     if($i==0){echo 'active';} ?>">
                  <?php endif; ?>
                  <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                    <a class="contenedor-img ejemplo-1"><img src="<?=base_url().'images/arboles/'.$arbolT->imagenArbol;?>" class="img-responsive pointerHover" style="border-radius: 45% / 20%"></a>
                    <div style="background-color: #38761d;" class="redondeadoTitle">
                      <h4 align="center" class="font-serif" style="color:white;border-top: 5px solid #b9a11f;"><?=$arbolT->nombreComun;?><span class="glyphicon glyphicon-tree-deciduous"></span></h4>
                    </div>
                  </div> 
                
                <?php 
                    $i++;  
                  endforeach; 
                endif;
                ?>
                
              </div>
    
          </div>

          <?php
          /**
          * Condición que determina si la variable $i existe y activar los botones del slider.
          */ 
          if (isset($i)){
            /**
            * Condición que activa los botones de control si hay mas de una pestaña en el slider.
            */ 
            if ($i > 3) {
          ?>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          <?php } }else{ ?> 

            <h1 align="center" class="white">Por el momento no hay árboles de temporada.</h1>

          <?php } ?>
      
        </div>
      </div>

    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax3.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="white font-serif" align="center">¿¡Que esperas!?, adopta un arbol aquí.</h1>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    
      <div class="row">
          <a href="<?=base_url().'Arbol';?>" class="btn btn-circle greenButton center-block" style="font-size: 20px">Ver invernadero <span class="fa fa-fw">&#xf1bb;</span></a>
      </div>
    </div>
  
    <div class="col-lg-1 col-xs-12 col-sm-10"></div>
  </div>


  <!--SECCION DE SOCIOS-->
  <div class="bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px">
    <div class="row">
      <div class="col-lg-12 col-xs-12 col-sm-10 divRedondoR borderTopBrown">
        <h1 class="white" align="center" style="font-size: 45px">Socios <span class="glyphicon glyphicon-briefcase"></span></h1>
      </div>
    </div>

    <div class="row" style="background-color: #6aa84f">
      <div class="col-lg-12 col-xs-12 col-sm-12">
        <div class="row">
          <div class="col-lg-12 col-xs-12">
        
            <div id="myCarousel2" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
              <ol class="carousel-indicators">
              <?php
              $cont = 0; 
              /**
              * Condición que valida si existe la variable $socios y esta no esta vacia.
              */
              if (isset($socios) && $socios != 0):
               
                /**
                * Bucle que recorre el arreglo $socios.
                * El bucle asigna a la variable $socio el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($socios as $socio):
                  /**
                  * Condición que determina cuantos indicadores mostrar en el carousel.
                  */
                  if ($cont % 3 == 0):
              ?>
                  <li data-target="#myCarousel2" data-slide-to="<?=$cont?>" class="<?php

                  /**
                  * Condicion que determina si la variable cont es igual a cero para activar el indicador correspondiente
                  */
                   if($cont==0){echo 'active';}?>"></li>
              <?php
                    endif;
                    $cont++;
                  endforeach;
                endif;
              ?>
            </ol>

            <!-- Wrapper for slides -->
          <div class="carousel-inner" style="margin-bottom: 10px">
            <?php
            /**
            * Condición que valida si existe la variable $socios y esta no esta vacia.
            */
            if (isset($socios) && $socios != 0):
              $cont = 0;
            ?>
              <div class="item <?php
              /**
              * Condicion que determina si la variable cont es igual a cero para activar el item correspondiente.
              */
               if($cont==0){echo 'active';}?>" style="margin-top: 10px;">
               <div class="row">
                <?php
                /**
                * Bucle que recorre el arreglo $socios.
                * El bucle asigna a la variable $socio el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($socios as $socio):
                ?>
                  <div class="col-lg-4 col-xs-12" align="center">
                    <a class="contenedor-img ejemplo-1"><img src="<?=base_url().'images/usuarios/'.$socio->avatar;?>" width="80%" height="80%" class="pointerHover" ></a>
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

          <?php
          /**
          * Condición que determina si la variable $cont existe, para crear los botones de el slider socios.
          */ 
          if (isset($cont) && $socios != 0){
            echo "<script>alert(".$cont.");</script>";
            /**
            * Condición que activa los botones de control si hay mas de una pestaña en el slider.
            */ 
            if ($cont > 3) {
  
          ?>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel2" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          <?php } }else{ ?>
            <h1 align="center" class="white">Por el momento no hay socios.</h1>
          <?php } ?>   
        </div>

        </div>
      </div>

    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax4.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="white font-serif" align="center">Únete y forma parte de este proyecto</h1>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    

      <div class="row" style="background-color:#6aa84f">
        <div class="col-lg-12 col-lg-12">
          <a href="<?=base_url().'Frontend/login#services';?>" class="btn btn-circle center-block greenButton" style="font-size: 20px">Únete Ahora <span class="fa fa-fw">&#xf061;</span></a>
        </div>
      </div>
    </div>
   </div>
  </div>



<div id="modal" style="display: none;" class="modal-example-content">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #38761d;">
        <button type="button" class="close" onClick="Custombox.modal.close();">&times;</button>
        <h2 class="modal-title white font-serif" align="center" id="titleModal"></h2>
      </div>
      <div class="modal-body" style="background-color: #6aa84f;">
      <div class="row">
        <div class="col-lg-4 col-xs-12">
          <img id="imagen">
        </div>
        <div class="col-lg-8 col-xs-12">
          <div class="row">
            <div class="col-lg-12">
              <h3 align="center" class="white"><strong id="str">Información del evento</strong></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <h3 id="hora" align="center" class="white"><strong id="str"></strong></h3>
              
            </div>
            <div class="col-lg-6">
              <h3 id="lugar" align="center" class="white"></h3>
            </div>  
          </div>
          <div class="row">
            <div class="col-lg-6">
              <h3 id="publico" align="center" class="white"></h3>
              
            </div>
            <div class="col-lg-6">
            </div>  
          </div>
          <div class="row">
            <div class="col-lg-12">
              <h3 class="white"></h3>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="modal-footer" style="background-color:#38761d">
      
      </div>
    </div>
</div>


<script>


var modal= new Custombox.modal({
  content: {
    effect: 'fadein',
    target: '#modal',
    width: '50%',
  }
});

</script>