<?php 
/**
* Archivo vista, proporciona una vista de todas las preguntas frecuentes que hay en el sitio
*
* @autor Miguel Angel Mandujano Barragán 
* @link [dirección_url_de_la_ubicacion]
* @package views/frontend
*
* @version 1.0
* Creado el 13/06/2018 a las 01:11 am
*/
 ?>
 <script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'10%'}); 
});

</script>
<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>
<div class="row bloque" data-move-x="-150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo borderTopBrown" >
      <h1 class="white" style="font-size: 45px" align="center">¿Tienes dudas? <span class="glyphicon glyphicon-question-sign"></span></h1>
    </div>
 </div>
 <div class="row bloque" data-move-x="150%" style="margin-bottom: 20px">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax9.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-serif" align="center" >Resuelve tus dudas aquí!.</h1>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>



 <div class="row bloque" data-move-x="-150%">
	<div class="col-lg-1 col-xs-12"></div>
	<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
		<div role="tabpanel">
                  <!--SECCIONES-->
                  <ul class="nav nav-tabs font-alt" role="tablist" style="background-color: #38761d">
                    <?php $i=0;
                    /**
                    * Bucle que recorre el arreglo $arboles
                    * El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                    */
                     foreach($secciones as $sec): ?>
                      <li class="<?php if($i==0){echo 'active';} ?>"><a href="#seccion<?=$i?>" data-toggle="tab"><?=$sec->nombreSeccion?></a></li>
                    <?php $i++; endforeach; ?>
                  </ul>

                  <div class="tab-content">
                    <?php $i=0;
                    /**
                    * Bucle que recorre el arreglo $arboles
                    * El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                    */
                     foreach($secciones as $sec): ?>
                      <!--PREGUNTA SECCIÓN 1-->
                        <div class="<?php if($i==0){echo 'tab-pane active';}else{ echo 'tab-pane';} ?>" id="seccion<?=$i?>">
                          <div style="margin-top: 10px">
                            <div class="panel panel-default">
                      <?php $j=0;
                      /**
                      * Bucle que recorre el arreglo $arboles
                      * El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                      */
                       foreach($faqs as $faq):?>
                      <?php
                      /**
                      * Condicion que determina cuando imprimir una faq
                      * Si la condicion se cumple, se imprimirá la faq y la respuesta en la sección indicada.
                      * 
                      */
                       if($faq->SeccionesFaq_idSeccionFaq == $sec->idSeccionFaq): ?>           
                          <div class="panel-heading" style="border: dashed #38761d;background-color:  #38761d">
                              <h4 class="panel-title font-alt white"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?=$j?>"><?=$faq->pregunta?></a></h4>
                          </div>
                            <div class="panel-collapse collapse " id="<?=$j?>">
                              <div class="panel-body" >
                                <div class="row">
                                   <div class="col-lg-12 col-xs-12">
                                      <h4 class="black"><?=$faq->respuesta?></h4>
                                   </div>
                                </div>
                              </div>
                          </div>
                    <?php endif; ?>
                    <?php $j++; endforeach; ?>
                        </div>
                      </div>
                    </div>

                    <?php $i++; endforeach; ?>


                  </div>
            </div>
	</div>
	<div class="col-lg-1 col-xs-12"></div>
 </div>
