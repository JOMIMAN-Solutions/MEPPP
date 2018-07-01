<?php 
/**
* Archivo vista, proporciona una vista de todos los arboles seleccionados para adoptar
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package views/frontend
*
* @version 1.0.0
* Creado el 25/06/2018 a las 05:08 pm
* Ultima modificacion el 30/06/2018 a las 08:47 pm
*/
?>
<div class="main" style="background-color: #b6d7a8">
  <div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>

  <div class="row" style="margin-bottom: 20px">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">MI CESTA</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-1 col-xs-12"></div>

    <div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
      <?php
      /**
      * Si el carrito contiene árboles los mostramos
      */
      if ($canasta = $this->cart->contents()): ?>
        <div>
          <table class="table table-bordered table-hover">
            <tr class="white">
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Eliminar</th>
            </tr>

            <?php 
            /**
            * Bucle que recorre el arreglo $canasta (carrito)
            * El bucle asigna a la variable $arbol el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
            */
            foreach ($canasta as $arbol): 
            ?>
              <tr class="white">
                <td><img src="<?=base_url().'images/arboles/'.$arbol['image'];?>" class="center-block" style="width: 50px;"></td>
                <td><?= $arbol['name']; ?></td>
                <td><?= $arbol['qty']; ?></td>
                <td>
                  <a href="<?=base_url().'Arbol/deleteTree/'.$arbol['rowid'];?>"><span class="fa fa-trash"></span></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>

          <a href="<?=base_url().'Arbol/vaciarCanasta';?>"><span class="fa fa-trash"> Vaciar</span></a>

          <a href="#" class="btn btn-success center-block greenButton">Enviar solicitud <span class="fa fa-seedling"></span></a>
        </div>
      <?php else: ?>
        <div class="row" class="white">
          <p class="whiteD">No has agregado árboles a tu canasta.</p>
        </div>
        <div class="row" align="center">
          <div class="col-xs-4"></div>
          <div class="col-xs-4">
            <p class="whiteD">Agrega algunos</p>
            <a href="<?=base_url().'Arbol';?>" class="btn btn-success center-block greenButton">Ir al Invernadero</a>
          </div>
          <div class="col-xs-4"></div>
        </div>
      <?php endif; ?>
    </div>

    <div class="col-lg-1 col-xs-12"></div>
  <!--</div>-->
</div>