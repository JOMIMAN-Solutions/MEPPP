
<script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'10%'}); 
});

</script>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine" id="services"></div>

<div class="row bloque borderTopBrown" data-move-x="150%" >
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo" >
      <h1 class="white" style="font-size: 45px" align="center">Registrate <span class="glyphicon glyphicon-star"></span></h1>
    </div>
 </div>
 <div class="row bloque" data-move-x="-150%" style="margin-bottom: 20px">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax11.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <h1 class="font-serif" align="center" >Y uneté a este maravilloso proyecto.</h1>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>


 <div class="row bloque" data-move-x="150%" >
  <div class="col-lg-1 col-xs-12"></div>
  <div class="col-lg-10 col-xs-12 divContenido borderTopBrown">
    <form action="" method="post" enctype="multipart/form-data">
      <!--TIPO DE USUARIO-->
      <div class="row" style="margin-left: 10px;margin-right: 10px;margin-bottom:15px">
        <div class="col-lg-6">
          <h4 class="font-alt mb-0 white" style="margin-left: 10px"><span class="icon-clipboard"></span> Datos personales</h4>
        </div>
        <div class="col-lg-6">
        
        </div>
      </div> 
      
      <!--DATOS PERSONALES-->
      <hr class="divider-w mt-10 mb-20">
      <div class="row" style="margin-left: 10px;margin-right: 10px;margin-bottom:15px">
        <div class="col-lg-6">
          
            <label for="" class="control-label labelCampo">Nombre: </label>
              <input type="text" class="form-control" name="userName" required="true" placeholder="Nombre personal"><br>
            <label for="" class="control-label labelCampo">Apellido Materno: </label>
              <input type="text" class="form-control" name="userMaterno" required="true" placeholder="Apellido Materno"><br>
            <label for="" class="control-label labelCampo">Teléfono: </label>
              <input type="text" class="form-control" name="telefono" required="true" placeholder="Telefono"><br>
        </div>
        <div class="col-lg-6">
            <label for="" class="control-label labelCampo">Apellido Paterno: </label>
              <input type="text" class="form-control" name="userPaterno" required="true" placeholder="Apellido Paterno"><br>
            <label for="" class="control-label labelCampo">Correo: </label>
              <input type="text" class="form-control" name="userEmail" required="true" placeholder="Correo electronico"><br>
        </div>
      </div>

      <!--DIRECCIÓN-->
      <h4 class="font-alt mb-0 white" style="margin-left: 10px"><span class="icon-map-pin"></span>  Dirección</h4>
      <hr class="divider-w mt-10 mb-20">
      <div class="row" style="margin-left: 10px;margin-right: 10px;margin-bottom:15px">
        <div class="col-lg-6">
            <label for="" class="control-label labelCampo">Calle: </label>
              <input type="text" class="form-control" name="calle" required="true" placeholder="Calle"><br>
            <label for="" class="control-label labelCampo">Colonia: </label>
              <input type="text" class="form-control" name="colonia" required="true" placeholder="Colonia"><br>
        </div>
        <div class="col-lg-3">
            <label for="" class="control-label labelCampo">Número: </label>
              <input type="text" class="form-control" name="numero"mrequired="true" placeholder="Número de casa"><br>
            <label for="" class="control-label labelCampo">Ciudad: </label>
              <input type="text" class="form-control" name="ciudad" required="true" placeholder="Ciudad">
        </div>
        <div class="col-lg-3">
          <label for="" class="control-label labelCampo">CP: </label>
              <input type="number" class="form-control" name="cp" required="true" placeholder="Código postal"><br>
        </div>
      </div>

      <!--INICIO SESIÓN-->
      <h4 class="font-alt mb-0 white" style="margin-left: 10px"><span class="icon-profile-male"></span> Datos sesión</h4>
      <hr class="divider-w mt-10 mb-20">
      <div class="row" style="margin-left: 10px;margin-right: 10px;margin-bottom:15px">
        <div class="col-lg-6">
            <label for="" class="control-label labelCampo">Usuario: </label>
              <input type="text" class="form-control" name="user" required="true" placeholder="Nombre de usuario"><br>
            <label for="" class="control-label labelCampo">Avatar: </label>
              <input type="file" class="form-control" name="avatar" required="true" ><br>
        </div>
        <div class="col-lg-6">
            <label for="" class="control-label labelCampo">Contraseña: </label>
              <input type="password" class="form-control" name="pass" required="true" placeholder="Contraseña"><br>
        </div>
      </div>
      <!--REPRESENTANTE-->
      <h4 class="font-alt mb-0 white" style="margin-left: 10px"><span class="icon-briefcase"></span> Representante <input type="checkbox" id="repre" name="repre" value="hola" onclick="cambio()">
      <hr class="divider-w mt-10 mb-20"></h4>
      <div class="row" style="margin-left: 10px;margin-right: 10px;margin-bottom:15px;display:none" id="repreOculto">
        <div class="col-lg-12">
            <label for="" class="control-label labelCampo">Nombre de la organización: </label>
              <input type="text" class="form-control" id="nameOrganizacion" placeholder="Nombre de la organización"><br>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
         <button type="submit" class="btn btn-success btn-circle center-block greenButton" style="font-size: 20px">Registrarse<span class="fa fa-fw">&#xf061;</span></button>
        </div>
      </div> 
    </form>
  </div>
  <div class="col-lg-1 col-xs-12"></div>
</div>


<script>
  function cambio(){
    if( $('#repre').prop('checked') ) {
      $('#repreOculto').toggle('slow');
      document.getElementById("nameOrganizacion").setAttribute("required","true");
    }else{
      $('#repreOculto').hide();
      document.getElementById("nameOrganizacion").removeAttribute("required");
    }
  }
</script>