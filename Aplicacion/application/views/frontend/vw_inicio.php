<?php
/**
* Pagina principal
* En esta pagina se encuentran 3 secciones...
*     - Calendario de campañas
*     - Arboles de temporada
*     - Principales socios
*
* @autor Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package application/views/frontend
*
* @version 1.0
* Creado el 15/06/2018 a las 10:00 pm
*/
?>

<script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'40%'}); 
});

</script>

<div class="main" style="background-color: #b6d7a8">
	<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>

  <!--SECCION DE CUIDA EL PLANETA-->
  <div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px" >
      <img src="<?=base_url();?>template/frontend/images/cuidaPlaneta.png" width="50%" class="center-block">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-10 col-xs-12 col-sm-10">
      <div class="row">
        <div class="col-lg-8 col-xs-12">
          <h1 style="color:#0b5c33;">Procuremos siempre que nuestros actos, dejen una <strong>huella verde</strong> en nuestro camino.</h1>
        </div>
        <div class="col-lg-4 col-xs-12 bloque" data-move-x="500px" data-rotate="-90deg">
          <h3 align="center">
            <img src="<?=base_url();?>template/frontend/images/cuida.jpg"  width="60%">
          </h3>
        </div>
      </div>
    </div>
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
  </div>

  <!--SECCION DE PROXIMAS CAMPAÑAS-->
  <div class="bloque" data-move-x="150%">
  <div class="row">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-11 col-xs-12 col-sm-10 divRedondoR borderTopBrown shadowL">
      <h1 class="white" align="center" style="font-size: 45px;">PRÓXIMAS CAMPAÑAS</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-11 col-xs-12 col-sm-10 divContenidoR shadowL">
      <h1 class="white" align="center" style="font-size: 20px">No te pierdas ninguna de nuestras campañas!!!</h1>
      <p class="white" align="center">Ven y juntos cuidemos el medio ambiente.</p>
      <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12" style="background-color: white;margin-left: 10px">
              <div class="alert"></div>
            <div class="row clearfix">
                <div class="col-md-12 column">
                        <div id='calendar'></div><br>
                </div>
            </div>
        </div>
      </div>

      <div class="row">
            <div class="col-lg-12 col-xs-12">
              <a href="<?=base_url().'Campania';?>" class="btn btn-success center-block greenButton" style="font-size: 20px">Ver campañas <span class="fa fa-fw">&#xf06c;</span></a>
            </div>
          </div>
    </div>
  </div>
</div>
  <!--SECCION DE ARBOLES DE TEMPORADA-->
<div class="bloque" data-move-x="-150%">
  <div class="row">
    <div class="col-lg-11 col-xs-12 col-sm-10 divRedondoL borderTopBrown shadowR" >
      <h1 class="white" align="center" style="font-size: 45px">ÁRBOLES DE TEMPORADA</h1>
    </div>
      <div class="col-lg-1 col-xs-12 col-sm-1"></div>
  </div>
  <div class="row" >
    <div class="col-lg-11 col-xs-12 col-sm-1 divContenidoL shadowR">
      <h1 class="white" align="center" style="font-size: 20px">La lista que esperabas con los árboles de temporada en cada mes o estación.</h1>
      <div class="col-lg-1 col-xs-12 col-sm-1"></div>
      <div class="row" style="margin-left: 10px;margin-right: 10px;">
        <div class="col-lg-12 col-xs-12">
        
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <?php
              /**
              * Condición que valida si existe la variable $arbolesTemp y esta no esta vacia.
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
                    <li data-target="#myCarousel" data-slide-to="<?=$i;?>" class="<?php if($i==0){echo 'active';}?>"></li>                  
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
                    <div class="item <?php if($i==0){echo 'active';} ?>" style="margin-top: 10px">
                  <?php endif; ?>
                  <div class="col-lg-4 col-xs-12">
                    <img src="<?=base_url().'images/arboles/'.$arbolT->imagenArbol;?>">
                    <div style="background-color: #38761d">
                      <h4 align="center" style="color:white"><?=$arbolT->nombreComun;?></h4>
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
          * Condición que activa los botones de control si hay mas de una pestaña en el slider.
          */ 
          if ($i > 3):
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
          <?php endif;?> 
        </div>
        </div>
      </div>

      <div class="row">
          <a href="<?=base_url().'Arbol';?>" class="btn btn-success greenButton center-block" style="font-size: 20px">Ver invernadero <span class="fa fa-fw">&#xf1bb;</span></a>
      </div>
    </div>
  
    <div class="col-lg-1 col-xs-12 col-sm-10"></div>
  </div>


  <!--SECCION DE SOCIOS-->
  <div class="bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px">
  <div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo borderTopBrown shadowR" style="margin-bottom: 10px">
      <h1 class="white" align="center" style="font-size: 45px">SOCIOS</h1>
    </div>
  </div>

  <div class="row" >
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-10 col-xs-12 col-sm-1">
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
                  <li data-target="#myCarousel2" data-slide-to="<?=$cont?>" class="<?php if($cont==0){echo 'active';}?>"></li>
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
              <div class="item <?php if($cont==0){echo 'active';}?>" style="margin-top: 10px;">
               <div class="row">
                <?php
                /**
                * Bucle que recorre el arreglo $socios.
                * El bucle asigna a la variable $socio el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($socios as $socio):
                ?>
                  <div class="col-lg-4 col-xs-12" >
                    <a class="contenedor-img ejemplo-1"><img src="<?=base_url().'images/usuarios/'.$socio->avatar;?>"></a>
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
          * Condición que activa los botones de control si hay mas de una pestaña en el slider.
          */ 
          if ($cont > 3):
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
          <?php endif;?>   
        </div>

        </div>
      </div>
      <div class="row" style="background-color: #38761d">
        <h1 class="white" style="font-size: 20px" align="center">ÚNETE Y FORMA PARTE DE ESTE PROYECTO</h1>
        <a href="<?=base_url().'Frontend/login#services';?>" class="btn btn-success center-block greenButton" style="font-size: 20px">Únete Ahora <span class="fa fa-fw">&#xf061;</span></a>
      </div>

    </div>
    <div class="col-lg-1 col-xs-12 col-sm-10"></div>
   </div>


  </div>



<div id="modal" style="display: none" class="modal-example-content">
    <div class="modal-content" style="border: 5px dashed #38761d;">
      <div class="modal-header" style="background-color: #38761d;">
        <button type="button" class="close" onClick="Custombox.modal.close();">&times;</button>
        <h2 class="modal-title white" align="center" id="titleModal"></h2>
      </div>
      <div class="modal-body" style="background-color: #6aa84f;">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
          <div class="row">
            <div class="col-lg-6">
              <h3 class="white" id="hora" align="center"><strong id="str"></strong></h3>
              
            </div>
            <div class="col-lg-6">
              <h3 class="white" id="lugar" align="center"></h3>
            </div>  
          </div>
          <div class="row">
            <div class="col-lg-6">
              <h3 class="white" id="publico" align="center"></h3>
              
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
      <div class="modal-footer" style="background-color: #38761d">
      
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