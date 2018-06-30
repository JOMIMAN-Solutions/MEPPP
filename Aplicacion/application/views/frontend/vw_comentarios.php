<?php
/**
* Pagina de Comentarios
* En esta pagina se encuentran 2 secciones...
*     - Realizar comentario
*     - Comentarios recientes
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/fronted
* @package application/views/frontend
*
* @version 1.0.0
* Creado el 15/06/2018 a las 06:00 pm
*/
?>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>
<div class="row" style="margin-bottom: 20px">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">DEJANOS UN COMENTARIO</h1>
    </div>
 </div>


 <div class="row">
	<div class="col-lg-1 col-xs-12"></div>
	<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
				<div style="margin-top: 10px">
                  <div class="panel panel-default" style="">
                    <div class="panel-heading" style="border: dashed #38761d;background-color:  #38761d">
                      <h4 class="panel-title font-alt white"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#support1">Agregar comentario</a></h4>
                    </div>
                    <div class="panel-collapse collapse" id="support1">
                      <div class="panel-body" style="background-color: #2f6219 ">
						<form action="">
							<div class="row">
								<div class="col-lg-6 col-xs-12">
									<label for="" class="control-label" style="color:white">Fecha:</label>
									<input type="text" class="form-control" name="fecha"><br>
									<label for="" class="control-label" style="color:white">Asunto:</label>
									<select name="" id="" class="form-control">
										<option value="">Selecciona una opcion</option>
									</select>
								</div>
								<div class="col-lg-6 col-xs-12">
									<label for="" class="control-label" style="color:white">Usuario:</label>
									<input type="text" class="form-control" name="fecha"><br>
									<label for="" class="control-label" style="color:white">Correo:</label>
									<input type="text" class="form-control">
								</div>								
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12 col-xs-12">
									<label for="" class="control-label" style="color:white">Mensaje:</label>
									<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>	
								</div>
							</div>
							<br>
							<div class="row">
								<a href="" type="submit" class="btn btn-success center-block greenButton" style="font-size: 20px">Enviar <span class="fa fa-fw">&#xf058;</span></a>
							</div>
						</form>

                      </div>
                    </div>
                  </div>
           </div>
			
		
		
	</div>
	<div class="col-lg-1 col-xs-12"></div>
 </div>


  <div class="row">
	<div class="col-lg-1 col-xs-12"></div>
	<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
				<div style="margin-top: 10px">
                  <div class="panel panel-default" style="">
                    <div class="panel-heading" style="border: dashed #38761d;background-color:  #38761d">
                      <h4 class="panel-title font-alt white"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#support2">Comentarios Recientes</a></h4>
                    </div>
                    <div class="panel-collapse collapse " id="support2">
                      <div class="panel-body" style="background-color: #2f6219 ">
					<?php
					/**
			        * Condición que valida si existe la variable $comentarios y esta no esta vacia.
			        */
					if (isset($comentarios) && $comentarios != 0):
						$cont = 1;
						/**
				        * Bucle que recorre el arreglo $comentarios.
				        * El bucle asigna a la variable $coment el valor del elemento actual que está recorriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
				        */
						foreach ($comentarios as $coment):
							/**
					        * Condición que valida la ariable $cont.
					        * Valida que el contador sea menor o igual a 5 para mostrar los primeros 5 comentarios.
					        */
							if($cont <= 5):
					?>
								<div class="row" style="margin-top: 10px">
									<div class="col-lg-12 col-xs-12">
										<div class="row">
											<div class="col-lg-1 col-xs-12"></div>
											<div class="col-lg-10 col-xs-12">
												<div class="row" style="background-color: #38761d">
													<div class="col-lg-6 col-xs-12">
														<h4 class="white">Usuario: <?=$coment->nombreUsuario;?></h4>
													</div>
													<div class="col-lg-6 col-xs-12">
														<h4 class="white">Fecha: <?=$coment->fechaComentario;?></h4>
													</div>
												</div>
												<div class="row" style="background-color: white">
													<div class="col-lg-12 col-xs-12">
														<h5 class="black"><?=$coment->mensaje;?></h5>
													</div>
												</div>
											</div>
											<div class="col-lg-1 col-xs-12"></div>
										</div>
									</div>							
								</div>
					<?php
							else:
								/**
						        * Condición que valida la ariable $cont.
						        * Valida que el contador este entre 6 y 10 para mostrar los primeros 10 comentarios.
						        */
								if($cont >5 && $cont <= 10):
					?>
									<div class="row" style="margin-top: 10px;display: none" id="more">
										<div class="col-lg-12 col-xs-12">
											<div class="row">
												<div class="col-lg-1 col-xs-12"></div>
												<div class="col-lg-10 col-xs-12">
													<div class="row" style="background-color: #38761d">
														<div class="col-lg-6 col-xs-12">
															<h4 class="white">Usuario: <?=$coment->nombreUsuario;?></h4>
														</div>
														<div class="col-lg-6 col-xs-12">
															<h4 class="white">Fecha: <?=$coment->fechaComentario;?></h4>
														</div>
													</div>
													<div class="row" style="background-color: white">
														<div class="col-lg-12 col-xs-12">
															<h5 class="black"><?=$coment->mensaje;?></h5>
														</div>
													</div>
												</div>
												<div class="col-lg-1 col-xs-12"></div>
											</div>
										</div>							
									</div>
								<?php
								else:
								?>
									<div class="row" style="margin-top: 10px;display: none" id="more1">
										<div class="col-lg-12 col-xs-12">
											<div class="row">
												<div class="col-lg-1 col-xs-12"></div>
												<div class="col-lg-10 col-xs-12">
													<div class="row" style="background-color: #38761d">
														<div class="col-lg-6 col-xs-12">
															<h4 class="white">Usuario: <?=$coment->nombreUsuario;?></h4>
														</div>
														<div class="col-lg-6 col-xs-12">
															<h4 class="white">Fecha: <?=$coment->fechaComentario;?></h4>
														</div>
													</div>
													<div class="row" style="background-color: white">
														<div class="col-lg-12 col-xs-12">
															<h5 class="black"><?=$coment->mensaje;?></h5>
														</div>
													</div>
												</div>
												<div class="col-lg-1 col-xs-12"></div>
											</div>
										</div>							
									</div>
					<?php
								endif;
							endif;
						$cont++;
						endforeach;
					endif;
					?>
					<h3 align="center" id="verMas"><a href="" class="white">Ver más...</a></h3>
					<h3 align="center" id="verMas1"><a href="" class="white">Ver más...</a></h3>
                      </div>
                    </div>
                  </div>
           </div>
			
		
		
	</div>
	<div class="col-lg-1 col-xs-12"></div>
 </div>



 <script>
 	$(document).ready(function(){
 		$('#verMas1').hide();

        $('#verMas').on('click',function(e){
            $('#more').toggle('slow');
            e.preventDefault();
            $('#verMas').hide();
            $('#verMas1').show();
        });

        $('#verMas1').on('click',function(e){
            $('#more1').toggle('slow');
            e.preventDefault();
            $('#verMas1').hide();
        });
    }); 	
 </script>