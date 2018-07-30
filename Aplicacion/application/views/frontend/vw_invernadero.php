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
* Ultima modificacion el 29/07/2018 a las 11:35 pm
*/
?>

<script>
  $(document).ready(function(){
    $('.bloque').smoove({offset:'10%'}); 



});

</script>

<script>
 window.onload=function(){
    var pos=window.name || 0;
    window.scrollTo(0,pos);
    
    pos=0;
    window.name=0;

    if (<?=$this->session->flashdata('item')?> ==4 || <?=$this->session->flashdata('item')?> ==1 || <?=$this->session->flashdata('item')?> == 5) {
      modalAgregada.open();
    }
  }


</script>
<div class="main" style="background-color: #b6d7a8">
  <div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>

  <div class="row bloque" data-move-x="150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondoR borderTopBrown" style="margin-top: 20px;">
      <h1 class="white" style="font-size: 45px" align="center">Arboles disponibles<span class="glyphicon glyphicon-tree-deciduous"></span></h1>
    </div>
  </div>
  <div class="row bloque" data-move-x="-150%" style="margin-bottom: 20px">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax5.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-serif" align="center" >Adopta un árbol y contribuye junto a nosotros a ayudar al medio ambiente.</h1>
                 <h3 class="white" align="center">Tu adopción contribuye a frenar el calentamiento global.<span class="glyphicon glyphicon-globe" style="color:#004e87"></span></h3>
                 <hr style="height: 3px; background-color: #ffffff; width: 500px">
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

  <div class="row bloque"  style="margin-top: 0px" data-move-x="150%" id="arboles">
    <div class="col-lg-1 col-xs-12"></div>
    <div class="col-lg-10 col-xs-12 divArboles">
      <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-2">
          <a class=" btn btn-circle greenButton2 center-block" id="exampleCesta">Mi cesta: <?=count($canasta = $this->cart->contents())?><span class="glyphicon glyphicon-leaf"></span></a>
        </div>
        <div class="col-lg-5"></div>
      </div>
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
          <div class="col-lg-3 col-xs-12" style="margin-top: 10px;">
            <a id="example<?=$i?>" class="contenedor-img ejemplo-1">
              <img src="<?=base_url();?>images/arboles/<?=$ar->imagenArbol?>" style="border-radius: 45% / 20%;margin-bottom: 10px"></a>
            
           
            <div style="background-color: #ffffff;border: solid #38761d;" class="redondeado">
              <h5 align="center" class="titlePlanta">Nombre común:</h5>
              <h4 align="center" class="titlePlanta font-serif"><strong><?=$ar->nombreComun?></strong> </h4>
              <h5 align="center" class="titlePlanta">Tipo de árbol:</h5>
              <h4 align="center" class="titlePlanta font-serif"><strong><?=$ar->tipoArbol?></strong></h4>
            </div>
       
            
            <?php
            echo form_open(base_url() . 'Arbol/addTree');
            echo form_hidden('id', $ar->idArbol);
            echo form_hidden('uri', $this->uri->segment(3));
            $btn = array(
              'type' => 'submit',
              'content' => 'Adoptar <span class="fa fa-fw">&#xf004;</span>',
              'class' => 'btn  btn-circle center-block greenButton2',
              'onclick' => 'guardarScroll()'
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
        <h2 style="color: white" align="center">No tenemos árboles por ahora, pero estamos trabajando en ello.</h2>
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
  <div class="row bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px" >
    <div class="col-lg-1 col-xs-12"></div>
    <div class="col-lg-10 col-xs-12" id="paginacion" onclick="guardarScroll()"><?= $this->pagination->create_links(); ?></div>
    <div class="col-lg-1 col-xs-12"></div>
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
        <div class="modal-content">
          <div class="modal-header" style="background-color: #38761d;">
            <button type="button" class="close" onClick="Custombox.modal.close();">&times;</button>
            <h2 class="modal-title white font-serif" align="center"><?=$ar->nombreComun?></h2>
          </div>
          <div class="modal-body" style="background-color: #6aa84f;">
          <div class="row">
            <div class="col-lg-4 col-xs-12">
              <img src="<?=base_url()?>images/arboles/<?=$ar->imagenArbol?>" alt="" style="border-radius: 45% / 20%;">
            </div>
            <div class="col-lg-8 col-xs-12">
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="white font-serif"><strong>Nombre: </strong><?=$ar->nombreComun?></h3>
                  
                </div>
                <div class="col-lg-6">
                  <h3 class="white font-serif"><strong>Nombre cientifico: </strong><?=$ar->nombreCientifico?></h3>
                </div>  
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="white font-serif"><strong>Tipo de arbol: </strong><?=$ar->tipoArbol?></h3>
                  
                </div>
                <div class="col-lg-6">
                  <h3 class="white font-serif"><strong>Temporada: </strong><?=$ar->temporadaArbol?></h3>
                </div>  
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <h3 class="white font-serif"><?=$ar->descripcion?></h3>
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
              'class' => 'btn btn-default btn-circle center-block blueButton',
              'onclick' => 'guardarScroll()'
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

  var modalCesta = new Custombox.modal({
    content: {
      effect: 'fadein',
      target: '#modalCesta',
      width: '70%',
      }
    });

    $(function() {
      $('#exampleCesta').on('click', function () {
        modalCesta.open();
      });
    });  

    var modalAgregada = new Custombox.modal({
      content:{
        effect: 'fadein',
        target: '#modalAgregada',
        width: '20%',
      }
    });
</script>





    <div id="modalCesta" style="display: none" class="modal-example-content">
        <div class="modal-content" style="border: 5px dashed #38761d;">
          <div class="modal-header" style="background-color: #38761d;">
            <button type="button" class="close" onClick="Custombox.modal.close();">&times;</button>
            <h2 class="modal-title white font-serif" align="center">Mi cesta <span class="glyphicon glyphicon-leaf"></span></h2>
          </div>
          <div class="modal-body" style="background-color: #6aa84f;">
          <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="row">
                  <div class="col-lg-12 col-xs-12">
                    <?php
                    /**
                    * Si el carrito contiene árboles los mostramos
                    */
                    if ($canasta = $this->cart->contents()): ?>
                      <a href="<?=base_url().'Arbol/vaciarCanasta';?>" class="btn btn-circle center-block greenButton2" onclick="guardarScroll()">Vaciar cesta <span class="glyphicon glyphicon-trash"></span></a>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr style="background-color: white">
                              <th><h5 align="center" style="margin-top: 0px;margin-bottom: 0px"><strong>Imagen</strong></h5></th>
                              <th><h5 align="center" style="margin-top: 0px;margin-bottom: 0px"><strong>Nombre</strong></h5></th>
                              <th><h5 align="center" style="margin-top: 0px;margin-bottom: 0px"><strong>Cantidad</strong></h5></th>
                              <th style="background-color: red"><h5 align="center" style="color:white;margin-top: 0px;margin-bottom: 0px"><strong>Eliminar</strong></h5></th>
                            </tr>

                          <?php 
                          /**
                          * Bucle que recorre el arreglo $canasta (carrito)
                          * El bucle asigna a la variable $arbol el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                          */
                          foreach ($canasta as $arbol): 
                          ?>
                            <tr class="white">
                              <td>
                                <img src="<?=base_url().'images/arboles/'.$arbol['image'];?>" class="center-block" style="border-radius: 45% / 20%;width: 70px">
                              </td>
                              <td><h4 align="center"><?= $arbol['name']; ?></h4></td>
                              <td><h4 align="center"><?= $arbol['qty']; ?></h4></td>
                              <td>
                                <a href="<?=base_url().'Arbol/deleteTree/'.$arbol['rowid'];?>" onclick="guardarScroll()"><h4 align="center"><span class="fa fa-trash"></span></h4>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </table>

                        <a href="#" class="btn btn-circle center-block greenButton2">Adoptar <span class="glyphicon glyphicon-heart"></span></a>
                      </div>

                    <?php else: ?>
                      <div class="row" class="white">
                        <h1 class="white font-serif" align="center">No has agregado árboles a tu canasta.</h1>
                      </div>
                    <?php endif; ?>
                  </div>
                <!--</div>-->
              </div>
            </div>
          </div>
          </div>
        </div>
    </div>



    <div id="modalAgregada" style="display: none" class="modal-example-content">
        <div class="modal-content">
          <div class="modal-header" style="background-color: #38761d;">
            <button type="button" class="close" onClick="Custombox.modal.close();">&times;</button>
            <?php 
                switch ($this->session->flashdata('item')) {
                  case 1:
                      echo '<h3 class="white font-serif" align="center">Arbol eliminado de la cesta correctamente</h3>';
                    break;
                  case 4:
                      echo '<h3 class="white font-serif" align="center">Arbol agregado a la cesta correctamente</h3>';
                    break;
                  case 5:
                      echo '<h3 class="white font-serif" align="center">Se ha vaciado la canasta correctamente</h3>';
                    break;
                  
                  default:
                    # code...
                    break;
                }


             ?>
          </div>
          <div class="modal-body">
            <img src="<?=base_url()?>template/frontend/images/correcto.png" alt="" width="50%" class="center-block">
          </div>
          <div class="modal-footer" style="background-color: #38761d"></div>
        </div>
    </div>


    <script>
         function guardarScroll(){
          <?php if(!$this->session->flashdata('item')){$this->session->set_flashdata('item',3);} ?>
            window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
          }
    </script>