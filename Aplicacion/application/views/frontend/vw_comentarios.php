<?php
/**
* Pagina de Comentarios
* En esta pagina se encuentran 2 secciones...
*     - Realizar comentario
*     - Comentarios recientes
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package application/views/frontend
*
* @version 1.0.0
* Creado el 15/06/2018 a las 06:00 pm
* Última modificación 03/08/2018 a las 02:16 am
*/
?>
<script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'10%'}); 
});

</script>
<?php 
	$hoy = getdate();
	/**
    * Condición para determinar si el numero del mes actual es menor a 10 para colocar un 0 antes.
    */
	if ($hoy["mon"]<10) {
	 	$hoy["mon"]="0".$hoy["mon"];
	 }
	 /**
    * Condición para determinar si el numero de dia actual es menor a 10 para colocar un 0 antes.
    */
	 if ($hoy["mday"]<10) {
	 	$hoy["mday"]="0".$hoy["mday"];
	 }
	 $fechaActual= $hoy["mday"]."/".$hoy["mon"]."/".$hoy["year"]; 

?>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>
<div class="row bloque" data-move-x="150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo borderTopBrown" >
      <h1 class="white" style="font-size: 45px" align="center">Dejanos un comentario <span class="glyphicon glyphicon-comment"></span></h1>
    </div>
 </div>

 <div class="row bloque" data-move-x="-150%" style="margin-bottom: 20px">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax8.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-serif" align="center" >Para nosotros, tu opinion es muy importante.</h1>
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
                  <div class="panel panel-default" style="">
                    <div class="panel-heading" style="border: dashed #38761d;background-color:  #38761d">
                      <h4 class="font-serif white"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#support1">Agregar comentario <span class="glyphicon glyphicon-comment"></span></a></h4>
                    </div>
                    <?php


                    /**
    				* Condición para determinar si existe la sesión perfil para mostrar el formulario de comentario
    				*/
                     if ($this->session->userdata('perfil')) { ?>
                    
                    <div class="panel-collapse collapse" id="support1">
                      <div class="panel-body" style="background-color: #2f6219 ">
						<form action="" method="POST">
							<input type="hidden" name="fecha" value="<?=$fechaActual?>">
							<div class="row">
								<div class="col-lg-6 col-xs-12">
									
									
								</div>
								<div class="col-lg-6 col-xs-12">
									<label for="" class="control-label" style="color:white">Asunto:</label>
									<select name="asunto" id="" class="form-control" required="true">
										<option value="">-Selecciona una opción-</option>
										<option value="Comentario">Comentario</option>
										<option value="Sugerencia">Sugerencia</option>
										<option value="Duda">Duda</option>
										<option value="Queja">Queja</option>
									</select><br>
									
								</div>								
							</div>
							<div class="row">
								<div class="col-lg-6 col-xs-12">
									<label for="" class="control-label" style="color:white">Usuario:</label>
									<input type="text" class="form-control" name="user" placeholder="Usuario" required="true" value="<?=$this->session->userdata('perfil')->usuario?>" readonly><br>
								</div>
								<div class="col-lg-6 col-xs-12">
									<label for="" class="control-label" style="color:white">Correo:</label>
									<input type="text" class="form-control" name="userEmail" placeholder="Correo electrónico" required="true" value="<?=$this->session->userdata('perfil')->correoUsuario?>" readonly>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12 col-xs-12">
									<label for="" class="control-label" style="color:white">Mensaje:</label>
									<textarea id="" cols="30" rows="10" name="userMessage" class="form-control" placeholder="Dejanos un mensaje" required="true"></textarea>	
								</div>
							</div>
							<br>
							<div class="row">
								<button type="submit" class="btn btn-circle center-block blueButton" style="font-size: 20px">Enviar <span class="fa fa-fw">&#xf058;</span></button>
							</div>
						</form>

                      </div>
                    </div> <!--Aqui termina -->
					<?php    }else{ ?>
						<div class="panel-collapse collapse" id="support1">
							<div class="panel-body" style="background-color: #2f6219 ">
								<div class="row">
									<h1 align="center" class="white">Entra a tu cuenta para dejar un comentario.</h1>
									<div class="col-lg-4"></div>
									<div class="col-lg-4" align="center">
									<form action="<?=base_url()?>Usuario/login" method="POST">
	                            		<label for="" class="control-label" style="color: white">Usuario</label>
				                            <div class="input-group">
				                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				                                <input type="text" class="form-control center-block" name="user" id="user" required="" placeholder="Nombre de usuario">
				                            </div>
				                              <br>
				                            <label for="" class="control-label" style="color: white">Password</label>
				                            <div class="input-group">
				                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				                                <input type="password" class="form-control center-block" name="password" id="password" required="" placeholder="Contraseña"><br>
				                            </div><br>
	                              		<button type="submit" class="btn btn-success center-block">Entrar</button>
                          			</form>
                          			<h4 class="white font-serif"><a href="<?=base_url().'Frontend/login#services';?>">Registrate</a></h4>
									</div>
									<div class="col-lg-4"></div>
								</div>	
							</div>
						</div>

						<?php } ?>
                  </div>
           </div>
			
		
		
	</div>
	<div class="col-lg-1 col-xs-12"></div>
 </div>


  <div class="row bloque" data-move-x="-150%">
	<div class="col-lg-1 col-xs-12"></div>
	<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
				<div style="margin-top: 10px">
                  <div class="panel panel-default" style="">
                    <div class="panel-heading" style="border: dashed #38761d;background-color:  #38761d">
                      <h4 class="font-serif white"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#support2">Comentarios Recientes <span class="glyphicon glyphicon-hourglass"></span></a></h4>
                    </div>
                    <div class="panel-collapse collapse " id="support2">
                      <div class="panel-body" style="background-color: #2f6219 ">
					<?php
					/**
			        * Condición que valida si existe la variable $comentarios y esta no esta vacia.
			        */
					if (isset($comentarios) && $comentarios != 0){
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
								$fecha = explode("-", $coment->fechaComentario);
					?>
								<div class="row" style="margin-top: 10px">
									<div class="col-lg-12 col-xs-12">
										<div class="row">
											<div class="col-lg-1 col-xs-12"></div>
											<div class="col-lg-10 col-xs-12">
												<div class="row" style="background-color: #38761d">
													<div class="col-lg-6 col-xs-12">
														<h4 class="white"><?=$coment->nombreUsuario;?></h4>
													</div>
													<div class="col-lg-6 col-xs-12">
														<h4 class="white"><?=$fecha[2]."-".$fecha[1]."-".$fecha[0]?></h4>
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
					}else{
						echo "<h1 class='white' align='center'>Por el momento no hay comentarios <span class='glyphicon glyphicon-comment'></span></h1>";
					}
					?>
					<?php

					/**
    				* Condición para determinar si la variable comentarios existe, si es diferente a 0 y si es mayor a 5 para mostrar
    				* los botones para ver más comentarios.
    				*/
					 if (isset($comentarios) && $comentarios != 0 && $comentarios > 5) {?> 
				
					<h3 align="center" id="verMas"><a class="white pointerHover">Ver más...</a></h3>
					<h3 align="center" id="verMas1"><a  class="white pointerHover">Ver más...</a></h3>
					<h3 align="center" id="ocultar"><a class="white pointerHover">Ocultar...</a></h3>
					<?php } ?>
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
 		$('#ocultar').hide();

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
            $('#ocultar').show();
        });
        $('#ocultar').on('click',function(){
        	$('#more').hide();
        	$('#more1').hide();
        	$('#ocultar').hide();
        	$('#verMas').show();
        });

    }); 	
 </script>