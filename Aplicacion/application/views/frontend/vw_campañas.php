<?php
/**
* Pagina de Campañas
* En esta pagina se cargan todas las campañas que ya fueron realizadas por la asociasion
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package application/views/frontend
*
* @version 1.0.0
* Creado el 15/06/2018 a las 05:41 pm
* ultima Modificación el 28/07/2018 a las 12:06 am
*/
?>
<script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'10%'}); 
});

</script>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>
<div class="row bloque" data-move-x="150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondoR borderTopBrown">
      <h1 class="white" style="font-size: 45px" align="center">Conoce nuestras campañas <span class="glyphicon glyphicon-heart-empty"></span></h1>
    </div>
 </div>
 <div class="row bloque" data-move-x="-150%" style="margin-bottom: 20px">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax6.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-serif" align="center" >Este al tanto de nuestras campañas.</h1>
                 <hr style="height: 3px; background-color: #ffffff; width: 500px">
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>


 <div class="row bloque" data-move-x="150%">
	<div class="col-lg-1 col-xs-12"></div>
		<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
			<div style="margin-top: 10px">
                <?php
                /**
		        * Condición que valida si existe la variable $campanias y esta no esta vacia.
		        */
                if (isset($campanias) && $campanias != 0){
                	/**
			        * Bucle que recorre el arreglo $campanias.
			        * El bucle asigna a la variable $campania el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
			        */
					foreach ($campanias as $campania):
                ?>
						<div class="panel panel-default" style="">
		                    <div class="panel-heading" style="border: dashed #38761d;background-color:  #38761d">
		                      <h4 class="font-serif white"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#support1"><?=$campania->nombreCampania;?> <span class="glyphicon glyphicon-apple"></span></a></h4>
		                    </div>
		                    <div class="panel-collapse collapse " id="support1">
		                      <div class="panel-body" style="background-color: #2f6219 ">
								<div class="row">
									<div class="col-lg-12 col-xs-12">
										<h1 class="white font-serif" align="center"><strong><?=$campania->nombreCampania;?></strong></h1>
										<img src="<?=base_url().'/images/campañas/'.$campania->imagenPortada;?>" class="center-block">
									</div>							
								</div>
								<div class="row borderTopBrown" align="center" style="background-color: white;margin-top:15px">
									<div class="col-lg-4 col-xs-12">
										<h3 class="font-serif"><strong>Lugar:</strong> <?=$campania->lugar;?></h3>
									</div>
									<div class="col-lg-4 col-xs-12">
										<h3 class="font-serif"><strong>Publico:</strong> <?=$campania->publico;?></h3>
									</div>
									<div class="col-lg-4 col-xs-12">
										<h3 class="font-serif"><strong>Tipo:</strong> <?=$campania->tipoCampania;?></h3>
									</div>						
								</div>
								<div class="row borderBottomBrown" align="center" style="background-color: white;margin-bottom:15px">
									<div class="col-lg-4 col-xs-12">
										<h3 class="font-serif"><strong>Hora:</strong> <?=$campania->hora;?></h3>
									</div>
									<div class="col-lg-4 col-xs-12">
										<h3 class="font-serif"><strong>Inicio:</strong> <?=$campania->fechaInicio;?></h3>
									</div>
									<div class="col-lg-4 col-xs-12">
										<h3 class="font-serif"><strong>Fin:</strong> <?=$campania->fechaFin;?></h3>
									</div>						
								</div>
								<div class="row">
									<h2 class="font-serif white" align="center">Fotografias del evento <span class="glyphicon glyphicon-camera"></span></h2>
								</div>
								<div class="row">
									<div class="col-lg-12 col-xs-12">
										<div id="myCarousel" class="carousel slide" data-ride="carousel">
											<!-- Indicators -->
										  	<ol class="carousel-indicators">
											<?php
											/**
									        * Condición que valida si existe la variable $imagenes y esta no esta vacia.
									        */
											if (isset($imagenes) && $imagenes != 0):
												$cont = 0;
												/**
										        * Bucle que recorre el arreglo $imagenes.
										        * El bucle asigna a la variable $images el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
										        */
												foreach ($imagenes as $images):
													/**
											        * Condición que compara el id de la campaña con sus imagenes.
											        * Compara el id de la campaña con el id de la campaña en la tabal imagenes (foranea) para cargar las imagenes de la campaña que se esta recorriendo en este momento.
											        */
													if ($campania->idCampania == $images->Campanias_idCampania):
											?>
														<li data-target="#myCarousel" data-slide-to="<?=$cont?>" class="<?php if($cont==0){echo 'active';}?>"></li>
											<?php
														$cont++;
													endif;
												endforeach;
											endif;
											?>
											</ol>

		  									<!-- Wrapper for slides -->
										  <div class="carousel-inner">
										  	<?php
										  	/**
									        * Condición que valida si existe la variable $imagenes y esta no esta vacia.
									        */
											if (isset($imagenes) && $imagenes != 0):
												$cont = 0;
												/**
										        * Bucle que recorre el arreglo $imagenes.
										        * El bucle asigna a la variable $images el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
										        */
												foreach ($imagenes as $images):
													/**
											        * Condición que compara el id de la campaña con sus imagenes.
											        * Compara el id de la campaña con el id de la campaña en la tabal imagenes (foranea) para cargar las imagenes de la campaña que se esta recorriendo en este momento.
											        */
													if ($campania->idCampania == $images->Campanias_idCampania):
											?>
											    <div class="item <?php if($cont==0){echo 'active';}?>">
											      <img src="<?=base_url().'/images/campañas/evidencia/'.$images->urlImagen;?>" alt="Los Angeles" class="center-block">
											    </div>
										    <?php
														$cont++;
													endif;
												endforeach;
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
								</div>
		                      </div>
		                    </div>
		                  </div>
                <?php
                  	endforeach;
              	}else{
              		echo "<h1 class='white' align='center'>Por el momento no hay campañas.</h1>";
              	}
                ?>
           	</div>
		</div>
	<div class="col-lg-1 col-xs-12"></div>
 </div>