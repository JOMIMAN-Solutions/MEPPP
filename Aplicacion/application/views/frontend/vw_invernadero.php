<?php 
/**
* Archivo vista, proporciona una vista de todos los arboles que hay en existencia así como detalles de cada uno de ellos.
*
* @author Miguel Angel Mandujano Barragán 
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package views/frontend
*
* @version 1.0.1
* Creado el 13/06/2018 a las 01:10 am
* Ultima modificacion el 29/06/2018 a las 08:43 pm
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
      <?php
      /**
      * Condición que valida si existe la variable $arboles y esta no esta vacia.
      */
      if (isset($arboles) && $arboles != 0):
        $i=0;
        /**
        * Bucle que recorre el arreglo $arboles
        * El bucle asigna a la variable $ar el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
        */
        foreach($arboles as $ar): ?>
          <div class="col-lg-3 col-xs-12" >
            <a id="example<?=$i?>" class="contenedor-img ejemplo-1"><img src="<?=base_url();?>images/arboles/<?=$ar->imagenArbol?>"></a>
            
            <div style="background-color: #38761d">
              <h4 align="center" class="titlePlanta"><?=$ar->nombreComun?></h4>
            </div>
            
            <div style="background-color: #38761d;">
              <h4 align="center" class="datosPlanta"><?=$ar->tipoArbol?></h4>
            </div>
            
            <?php
            echo form_open(base_url() . 'Arbol/addTree');
            echo form_hidden('id', $ar->idArbol);
            echo form_hidden('uri', $this->uri->segment(3));
            $btn = array(
              'type' => 'submit',
              'content' => 'Adoptar <span class="fa fa-fw">&#xf004;</span>',
              'class' => 'btn btn-success center-block greenButton'
            );
            echo form_button($btn);
            echo form_close();
            ?>
          </div>
      <?php 
        $i++; 
        endforeach;
      else:
      ?>
        <p>No tenemos árboles por ahora, pero estamo trabajando en ello.</p>
      <?php endif; ?>
    </div>

    <div class="col-lg-1 col-xs-12"></div>
  <!--</div>-->
</div>

<!-- Creamos los enlaces de la paginación -->
<?php
/**
* Condición que verifica que la paginacion pueda crearse
* Verifica que, en base a las configuraciones de la paginación, existan mas de una pagina para asi poder mostrar los enlaces. 
*/
if($this->pagination->create_links()): 
?>
  <div class="container row">
    <div class="col-xs-1 col-md-4"></div>
    <div class="col-xs-10 col-md-4" id="paginacion"><?= $this->pagination->create_links(); ?></div>
    <div class="col-xs-1 col-md-4"></div>
  </div>
<?php endif; ?>


<?php 
/**
* Condición que valida si existe la variable $arboles y esta no esta vacia.
*/
if (isset($arboles) && $arboles != 0):
  $i=0;
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
            <?php
            echo form_open(base_url() . 'Arbol/addTree');
            echo form_hidden('id', $ar->idArbol);
            echo form_hidden('uri', $this->uri->segment(3));
            $btn = array(
              'type' => 'submit',
              'content' => 'Adoptar <span class="fa fa-fw">&#xf004;</span>',
              'class' => 'btn btn-success center-block greenButton'
            );
            echo form_button($btn);
            echo form_close();
            ?>
          </div>
        </div>
    </div>
<?php
  $i++;
  endforeach; 
endif;
?>

<script>

<?php 
/**
* Condición que valida si existe la variable $arboles y esta no esta vacia.
*/
if (isset($arboles) && $arboles != 0):
  $i=0;
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
<?php
  $i++;
  endforeach;
endif;
?>
</script>