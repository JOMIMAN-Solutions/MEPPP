<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine" id="services"></div>

<div class="row" style="margin-bottom: 20px" >
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">PERFIL DE USUARIO</h1>
    </div>
 </div>


 <div class="row">
  <div class="col-lg-1 col-xs-12"></div>
  <div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
    <div role="tabpanel">
                  <ul class="nav nav-tabs font-alt" role="tablist" style="background-color: #38761d">
                    <li class="active"><a href="#datPersonal" data-toggle="tab" style="white"><span class=" icon-heart"></span>Datos personales</a></li>
                    <li><a href="#direccion" data-toggle="tab"><span class="icon-map"></span>Dirección</a></li>
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
                              <th scope="col" class="whiteD">Fecha nac</th>
                              <th scope="col" class="whiteD">Ocupación</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->nombreUsuario ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->apePat ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->apeMat ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->correo ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->lada.$this->session->userdata('perfil')->telefono ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->fechaNac ?></td>
                              <td class="whiteD"><?=$this->session->userdata('perfil')->ocupacion ?></td>
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
  </div>
  <div class="col-lg-1 col-xs-12"></div>
</div>
