<?php 
/**
* Archivo vista, proporciona una vista de todos los arboles que hay en existencia así como detalles de cada uno de ellos.
*
* @autor Miguel Angel Mandujano Barragán 
* @link [dirección_url_de_la_ubicacion]
* @package views/frontend
*
* @version 1.0
* Creado el 13/06/2018 a las 01:10 am
*/
 ?>
<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>

<div class="row" style="margin-bottom: 20px">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">ARBOLES DISPONIBLES</h1>
    </div>
 </div>
 <div class="row">
 	<div class="col-lg-1 col-xs-12"></div>
 	<div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
 		<div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>
            <!-- Wrapper for slides -->
          <div class="carousel-inner">
                <?php 
                  /**
                  * Bucle que recorre el arreglo $arboles
                  * El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                  */

                  $i=0; foreach($arboles as $ar): ?>
                  <?php 
                  /**
                  * Condicion que determina cuantos elementos contendra el slider
                  * 
                  */
                  if (($i % 8) == 0): ?>
                    <?php
                    /**
                    * Condicion que determina cuando cerrar el slider
                    * 
                    * 
                    */
                    if($i != 0):  ?>
                      </div>
                    <?php endif; ?>
                    <div class="item <?php if($i==0){echo 'active';} ?>" style="margin-top: 10px">
                  <?php endif; ?>
                

                  <div class="col-lg-3 col-xs-12" >
                        <a id="example<?=$i?>" class="contenedor-img ejemplo-1"><img src="<?=base_url();?>images/arboles/<?=$ar->imagenArbol?>"></a>
                    <div style="background-color: #38761d">
                      <h4 align="center" class="titlePlanta"><?=$ar->nombreComun?></h4>
                    </div>
                    <div style="background-color: #38761d;">
                      <h4 align="center" class="datosPlanta"><?=$ar->tipoArbol?></h4>
                    </div>
                    <div >
                       <a href="" class="btn btn-success center-block greenButton">Adoptar <span class="fa fa-fw">&#xf004;</span></a>
                    </div>

                  </div>
                
              	<?php $i++;  endforeach; ?>
                
              </div>
    
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


<?php $i=0;
/**
* Bucle que recorre el arreglo $arboles
* El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
*/

 foreach($arboles as $ar): ?>

<div id="<?php echo 'modal'.$i; ?>" style="display: none" class="modal-example-content">
    <div class="modal-content" style="border: 5px dashed #38761d;">
      <div class="modal-header" style="background-color: #38761d;">
        <button type="button" class="close" onClick="Custombox.modal.close();">&times;</button>
        <h2 class="modal-title white" align="center"><?=$ar->nombreComun?></h2>
      </div>
      <div class="modal-body" style="background-color: #6aa84f;">
     	<div class="row">
     		<div class="col-lg-4 col-xs-12">
     			<img src="<?=base_url()?>images/arboles/<?=$ar->imagenArbol?>" alt="">
     		</div>
     		<div class="col-lg-8 col-xs-12">
     			<div class="row">
            <div class="col-lg-6">
              <h3 class="white"><strong>Nombre: </strong><?=$ar->nombreComun?></h3>
              
            </div>
            <div class="col-lg-6">
              <h3 class="white"><strong>Nombre cientifico: </strong><?=$ar->nombreCientifico?></h3>
            </div>  
          </div>
          <div class="row">
            <div class="col-lg-6">
              <h3 class="white"><strong>Tipo de arbol: </strong><?=$ar->tipoArbol?></h3>
              
            </div>
            <div class="col-lg-6">
              <h3 class="white"><strong>Temporada: </strong><?=$ar->temporadaArbol?></h3>
            </div>  
          </div>
          <div class="row">
            <div class="col-lg-12">
              <h3 class="white"><?=$ar->descripcion?></h3>
            </div>
          </div>
     		</div>
     	</div>
      </div>
      <div class="modal-footer" style="background-color: #38761d">
        <a href="" class="btn btn-success greenButton center-block" style="font-size: 10px">Añadir a la cesta <span class="fa fa-fw">&#xf004;</span></a>
      </div>
    </div>
</div>

<?php $i++; endforeach; ?>

<script>

<?php $i=0;
/**
* Bucle que recorre el arreglo $arboles
* El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
*/
foreach($arboles as $ar): ?>

var modal<?=$i?> = new Custombox.modal({
  content: {
    effect: 'fadein',
    target: '#modal<?=$i?>',
    width: '70%',
  }
});


$(function() {
    $('#example<?=$i?>').on('click', function () {
    	modal<?=$i?>.open();
    });
});



<?php $i++; endforeach; ?>


</script>

