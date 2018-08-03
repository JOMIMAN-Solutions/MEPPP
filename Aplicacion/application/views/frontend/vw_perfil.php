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

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine" id="services"></div>

<div class="row bloque borderTopBrown" style="margin-bottom: 20px" data-move-x="150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">Perfil de usuario <span class="glyphicon glyphicon-user"></span></h1>
    </div>
 </div>

 <div class="row bloque" data-move-x="-150%">
   <div class="col-lg-4"></div>
   <div class="col-lg-4" align="center">
     <img src="<?=base_url().'images/usuarios/'.$this->session->userdata('perfil')->avatar?>" alt="">
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

                  <!--DATOS PERSONALES-->
                    <div class="tab-pane active" id="datPersonal">
                      <div style="margin-top: 10px">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col" class="whiteD">Nombre</th>
                              <th scope="col" class="whiteD">Ape Paterno</th>
                              <th scope="col" class="whiteD">Ape Materno</th>
                              <th scope="col" class="whiteD">Correo</th>
                              <th scope="col" class="whiteD">Teléfono</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->nombreUsuario ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->apePat ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->apeMat ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->correoUsuario ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->lada.$this->session->userdata('perfil')->telefono ?></td>
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
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->calle.' #'.$this->session->userdata('perfil')->numero.' '.$this->session->userdata('perfil')->ciudad.' '.$this->session->userdata('perfil')->colonia.' '.$this->session->userdata('perfil')->cp ?></td>
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
                              <td class="whiteD"><?=$this->session->userdata('perfil')->usuario?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->contrasenia?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->tipoUsuario?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>


                  </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <a href="#" class="btn btn-circle center-block greenButton" style="font-size: 13px">Modificar mis datos <span class="glyphicon glyphicon-cog"></span></a>
              </div> 
            </div>
  </div>
  <div class="col-lg-1 col-xs-12"></div>
</div>
