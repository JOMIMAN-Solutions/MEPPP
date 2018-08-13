<?php 
/**
* Archivo vista, proporciona una vista de todos los datos del usuario que este logeado en el momento.
*
* @author Miguel Angel Mandujano Barragán 
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/frontend
* @package views/frontend
*
* @version 1.0.1
* Creado el 13/06/2018 a las 01:10 am
* Ultima modificacion el 03/08/2018 a las 02:33 am
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
  }
</script>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine" id="services"></div>

<div class="row bloque borderTopBrown" style="margin-bottom: 20px" data-move-x="150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">Perfil de usuario <span class="glyphicon glyphicon-user"></span></h1>
    </div>
 </div>
<form action="<?=base_url().'Usuario/updateUser'?>" method="post" enctype="multipart/form-data">
 <div class="row bloque" data-move-x="-150%">
   <div class="col-lg-4"></div>
   <div class="col-lg-4" align="center">
     <img src="<?=base_url().'images/usuarios/'.$this->session->userdata('perfil')->avatar?>" alt="">
     <input type="file" name="avatar" class="form-control" disabled id="avatar">
   </div>
   <div class="col-lg-4"></div>
 </div>

 <div class="row bloque" data-move-x="150%">
  <div class="col-lg-1 col-xs-12"></div>
  <div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
    <div role="tabpanel">
                  <ul class="nav nav-tabs font-alt" role="tablist" style="background-color: #38761d">
                    <li class="active"><a href="#datPersonal" data-toggle="tab" style="white"><span class=" icon-clipboard"></span>Datos personales</a></li>
                    <li><a href="#direccion" data-toggle="tab"><span class="icon-map-pin"></span>Dirección</a></li>
                    <li><a href="#sesion" data-toggle="tab"><span class="icon-profile-male"></span>Datos de inicio de sesión</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="alert alert-success" role="alert" style="display: none;margin-top: 10px" id="message">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i>Ahora puedes modificar tus datos
                    </div>
                    <?php
                      /**
                      * Condicion que determina si hubo errores y si la variable $badUser es igual a 4 para mostrar un error
                      * 
                      */
                       if (validation_errors() && $badUser == 4) { ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px">
                          <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>ERROR!</strong> <?=validation_errors()?>
                        </div>
                      <?php } ?>
                      <?php
                      /**
                      * Condicion que determina si la imagen que se subio cumplio con los requisitos.
                      * 
                      */
                       if (isset($badUser) && $badUser == 7) { ?>
                        <div class="alert alert-danger" role="alert" style="margin-top: 10px">
                          <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i><strong>ERROR!</strong> La imagen no cumple con los parametros
                        </div>
                      <?php } ?>
                      <?php
                      /**
                      * Condicion que determina si la imagen que se subio cumplio con los requisitos.
                      * 
                      */
                       if (isset($goodChanges)) { ?>
                        <div class="alert alert-success" role="alert" style="margin-top: 10px">
                          <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-coffee"></i>Tus datos se han actualizado con exito
                        </div>
                      <?php } ?>

                  <!--DATOS PERSONALES-->
                    <div class="tab-pane active" id="datPersonal">
                      <div style="margin-top: 10px" class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col" class="whiteD">Nombre</th>
                              <th scope="col" class="whiteD">Ape Paterno</th>
                              <th scope="col" class="whiteD">Ape Materno</th>
                              <th scope="col" class="whiteD">Correo</th>
                              <th scope="col" class="whiteD">Teléfono</th>
                              <?php 
                              /**
                              * Condicion que determina que tipo de usuario es para mostrar la columna
                              * organización.
                              * 
                              */
                                if ($this->session->userdata('perfil')->tipoUsuario == "Representante") {?>
                                <th scope="col" class="whiteD">Organización</th>
                              <?php } ?>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->nombreUsuario ?>" id="nombreUsuario" name="nombreUsuario" readonly required>
                              </td>
                              <td class="whiteD">
                                  <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->apePat ?>" id="apePat" name="apePat" readonly required>
                              </td>
                              <td class="whiteD">
                                  <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->apeMat ?>" id="apeMat" name="apeMat" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->correoUsuario ?>" id="correoUsuario" name="correoUsuario" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="number" class="form-control" value="<?=$this->session->userdata('perfil')->lada?><?=$this->session->userdata('perfil')->telefono?>" id="telefono" name="telefono" readonly required>
                              </td>
                              <?php 
                              /**
                              * Condicion que determina que tipo de usuario es para mostrar el campo
                              * organización.
                              * 
                              */
                                if ($this->session->userdata('perfil')->tipoUsuario == "Representante") {?>
                                <td class="whiteD">
                                  <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->organizacion?>" id="organizacion" name="organizacion" readonly required>
                                </td>
                              <?php } ?>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!--DIRECCIÓN-->
                    <div class="tab-pane " id="direccion">
                      <div style="margin-top: 10px">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col" class="whiteD">Dirección</th>
                              <th scope="col" class="whiteD">Número</th>
                              <th scope="col" class="whiteD">Ciudad</th>
                              <th scope="col" class="whiteD">Colonia</th>
                              <th scope="col" class="whiteD">CP</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->calle?>" id="calle" name="calle" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->numero?>" id="numero" name="numero" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->ciudad?>" id="ciudad" name="ciudad" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->colonia?>" id="colonia" name="colonia" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="number" class="form-control" name="cp" value="<?=$this->session->userdata('perfil')->cp?>" id="cp" readonly required>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <!--DATOS DE INICIÓ DE SESIÓN-->
                    <div class="tab-pane " id="sesion">
                      <div style="margin-top: 10px">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col" class="whiteD">Usuario</th>
                              <th scope="col" class="whiteD">Password</th>
                              <th scope="col" class="whiteD">Tipo de usuario</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->usuario?>" id="usuario" name="usuario" readonly required>
                              </td>
                              <td class="whiteD">
                                <?php 
                                $llave = $this->db->select("AES_DECRYPT('".$this->session->userdata('perfil')->contrasenia."', 'meppp') AS pass")->get();
                                $miLlave =  $llave->result();
                                foreach ($miLlave as $reg) {
                                  $pass = $reg->pass;
                                }
                                ?>
                                <input type="text" class="form-control" value="<?=$pass;?>" id="contrasenia" name="contrasenia" readonly required>
                              </td>
                              <td class="whiteD">
                                <input type="text" class="form-control" value="<?=$this->session->userdata('perfil')->tipoUsuario?>" id="tipo" readonly required>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>


                  </div>
            </div>
            <div class="row">
              <div class="col-lg-12" id="liberar">
                <a class="btn btn-circle center-block greenButton" style="font-size: 13px" onclick="modificar()">Modificar mis datos <span class="glyphicon glyphicon-cog"></span></a>
              </div> 
              <div class="col-lg-6" id="acept" style="display: none">
                <button type="submit" class="btn btn-circle center-block greenButton" style="font-size: 13px" onclick="guardarScroll()" >Aceptar modificación<span class="fa fa-check"></span></button>
              </div>
              <div class="col-lg-6" id="cance" style="display:none">
                <a class="btn btn-circle center-block greenButton" style="font-size: 13px" onclick="cancelar()">Cancelar <span class="fa fa-times"></span>
                </a>
              </div>
            </div>
  </div>
  <div class="col-lg-1 col-xs-12"></div>
</div>
</form>


<script>
  function modificar(){
    document.getElementById("avatar").removeAttribute("disabled");
    document.getElementById("nombreUsuario").removeAttribute("readonly");
    document.getElementById("apePat").removeAttribute("readonly");
    document.getElementById("apeMat").removeAttribute("readonly");
    document.getElementById("correoUsuario").removeAttribute("readonly");
    document.getElementById("telefono").removeAttribute("readonly");
    var repre = "<?=$this->session->userdata('perfil')->tipoUsuario?>";

      if (repre == "Representante") {
        document.getElementById("organizacion").removeAttribute("readonly");
      }

    document.getElementById("calle").removeAttribute("readonly");
    document.getElementById("numero").removeAttribute("readonly");
    document.getElementById("ciudad").removeAttribute("readonly");
    document.getElementById("colonia").removeAttribute("readonly");
    document.getElementById("cp").removeAttribute("readonly");
    document.getElementById("usuario").removeAttribute("readonly");
    document.getElementById("contrasenia").removeAttribute("readonly");
    $("#liberar").hide();
    $("#acept").show();
    $("#cance").show();
    $("#message").show();

    setTimeout(function() {
        $("#message").fadeOut(1500);
    },3000);
  }

  function cancelar(){
    document.getElementById("avatar").value = "";
    document.getElementById("avatar").setAttribute("disabled","true");

    document.getElementById("nombreUsuario").value = "<?=$this->session->userdata('perfil')->nombreUsuario?>";
    document.getElementById("nombreUsuario").setAttribute("readonly","true");

    document.getElementById("apePat").value = "<?=$this->session->userdata('perfil')->apePat?>";
    document.getElementById("apePat").setAttribute("readonly","true");

    document.getElementById("apeMat").value = "<?=$this->session->userdata('perfil')->apeMat?>";
    document.getElementById("apeMat").setAttribute("readonly","true");

    document.getElementById("correoUsuario").value = "<?=$this->session->userdata('perfil')->correoUsuario?>";
    document.getElementById("correoUsuario").setAttribute("readonly","true");

    document.getElementById("telefono").value = "<?=$this->session->userdata('perfil')->lada?><?=$this->session->userdata('perfil')->telefono?>";
    document.getElementById("telefono").setAttribute("readonly","true");

    var repre = "<?=$this->session->userdata('perfil')->tipoUsuario?>";
    if (repre == "Representante") {
      document.getElementById("organizacion").value = "<?=$this->session->userdata('perfil')->organizacion?>";
      document.getElementById("organizacion").setAttribute("readonly","true");
    }

    document.getElementById("calle").value = "<?=$this->session->userdata('perfil')->calle?>";
    document.getElementById("calle").setAttribute("readonly","true");

    document.getElementById("numero").value = "<?=$this->session->userdata('perfil')->numero?>";
    document.getElementById("numero").setAttribute("readonly","true");

    document.getElementById("ciudad").value = "<?=$this->session->userdata('perfil')->ciudad?>";
    document.getElementById("ciudad").setAttribute("readonly","true");

    document.getElementById("colonia").value = "<?=$this->session->userdata('perfil')->colonia?>";
    document.getElementById("colonia").setAttribute("readonly","true");

    document.getElementById("cp").value = "<?=$this->session->userdata('perfil')->cp?>";
    document.getElementById("cp").setAttribute("readonly","true");

    document.getElementById("usuario").value = "<?=$this->session->userdata('perfil')->usuario?>";
    document.getElementById("usuario").setAttribute("readonly","true");

    document.getElementById("contrasenia").value = "<?=$pass;?>";
    document.getElementById("contrasenia").setAttribute("readonly","true");

    $("#acept").hide();
    $("#cance").hide();
    $("#liberar").show();
  }
</script>


<script>
  function guardarScroll(){
    window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
  }
</script>