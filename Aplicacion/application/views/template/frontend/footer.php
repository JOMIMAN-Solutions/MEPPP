
 <div class="row">
    <img src="<?=base_url()?>template/frontend/images/grass.png" width="100%" height="100%">
  </div>
  <div style="height:10px;background-color:#b9a11f;"></div>


<div class="module-small bg-dark">
          <div class="container">
            <div class="row">

              <div class="col-sm-3">
                <div class="widget">
                	<img src="<?=base_url()?>template/frontend/images/icon.png" width="50%" class="center-block" style="margin-bottom: 20px">
                  <p>
                    <strong>Teléfono:</strong> <?=$dato->telefono1;?>
                    <?php if($dato->telefono2 != ''): ?>
                      <strong>Celular:</strong> <?=$dato->telefono2;?>
                    <?php endif; ?>
                    <br><strong>Dirección:</strong>  <?=$direccion->calle.' #'.$direccion->numero. ' Col.'.$direccion->colonia.', '.$direccion->ciudad;?>
                    <br> <strong>Correo:</strong> <?=$dato->correoEmpresa;?>
                  </p>
                </div>
              </div>


			<div class="col-sm-3">
                <div class="widget">
              
            
                </div>
              </div>
             

              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Menú</h5>
                  <ul class="icon-list">
                    <li><a href="<?=base_url().'Frontend/index';?>">Inicio</a></li>
                    <li><a href="<?=base_url().'Arbol';?>">Invernadero</a></li>
                    <li><a href="<?=base_url().'Campania';?>">Camapañas</a></li>
                    <li><a href="<?=base_url().'Usuario/getSocios';?>">Socios</a></li>
                    <li><a href="<?=base_url().'Comentario';?>">Comentarioss</a></li>
                    <li><a href="<?=base_url().'Faq';?>">Faqs</a></li>
                    <li><a href="<?=base_url().'QuienesSomos';?>">¿Quiénes Somos?</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Redes sociales</h5>
                  <a href="https://www.facebook.com/Movimiento-Ecologista-Preocupados-por-El-Planeta-AC-259202034280295/" target="_blank">
                    <div class="col-sm-6 shake-slow" align="center" ><img src="<?=base_url()?>template/frontend/images/fb.png" width="50%"></div>
                  </a>
                  <div class="col-sm-6 shake-slow" align="center"><img src="<?=base_url()?>template/frontend/images/insta.png" width="50%"></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <hr class="divider-d">

		<footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2018&nbsp;<a href="#">JOMIMAN Solutions</a>, TODOS LOS DERECHOS RESERVADOS</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links">
                   <a href="https://www.facebook.com/Movimiento-Ecologista-Preocupados-por-El-Planeta-AC-259202034280295/" target="_blank"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>

        
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
</main>


</body>
    
</html>