 <script>
      $(document).ready(function(){
$('.bloque').smoove({offset:'10%'}); 
});

</script>

<div class="main" style="background-color: #b6d7a8">
<div style="height:10px;background-color:#b9a11f;margin-bottom: 40px" class="shadowBrownLine"></div>
<div class="row bloque" data-move-x="-150%">
    <div class="col-lg-12 col-xs-12 col-sm-10 divRedondo borderTopBrown" >
      <h1 class="white" style="font-size: 45px" align="center">Conócenos <span class="glyphicon glyphicon-globe"></span></h1>
    </div>
</div>
 <div class="row bloque" data-move-x="150%" style="margin-bottom: 20px">
      <div class="col-lg-12 col-xs-12 col-sm-12 divContenidoR">
        <section class="module pb-0 bg-dark-10 pt-0 pb-0 parallax-bg" data-background="<?=base_url();?>template/frontend/images/parallax10.png">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <img src="<?=base_url()?>template/frontend/images/cuida.jpg" alt="" class="center-block" width="30%" style="margin-top:15px ;margin-bottom: 15px">
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

  <!--MISIÓN-->
  <div class="row bloque" data-move-x="150%">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-11 col-xs-12 col-sm-10 divRedondoR borderTopBrown shadowL">
      <h1 class="white font-serif" align="center" style="font-size: 45px;">Misión</h1>
    </div>
  </div>
  <div class="row bloque" data-move-x="150%">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-11 col-xs-12 col-sm-10 divContenidoR shadowL">
		<div class="row">
			<div class="col-lg-3">
				<img src="<?=base_url()?>template/frontend/images/mision.png" width="70%" style="margin-top: 10px;margin-bottom: 10px;border-radius: 45% / 20%" class="center-block">
			</div>
      <div class="col-lg-9">
        <h1 class="white" align="center" style="margin-left: 10px;margin-right: 10px"><?=$filosofia->mision;?></h1>
      </div>
		</div>
    </div>
  </div>

    <!--VISIÓN-->
  <div class="row bloque" data-move-x="-150%">
    
    <div class="col-lg-11 col-xs-12 col-sm-10 divRedondoL borderTopBrown shadowL">
      <h1 class="white font-serif" align="center" style="font-size: 45px;">Visión</h1>
    </div>
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
  </div>
  <div class="row bloque" data-move-x="-150%">
    <div class="col-lg-11 col-xs-12 col-sm-10 divContenidoL shadowR">
		<div class="row">
      <div class="col-lg-9">
        <h1 class="white" align="center" style="margin-left: 10px;margin-right: 10px"><?=$filosofia->mision;?></h1>
      </div>
			<div class="col-lg-3">
				<img src="<?=base_url()?>template/frontend/images/vision.png" width="70%" style="margin-top: 10px;margin-bottom: 10px;border-radius: 45% / 20%" class="center-block">
			</div>
		</div>
    </div>
     <div class="col-lg-1 col-xs-12 col-sm-1"></div>
  </div>

  <!--VALORES-->
  <div class="row bloque" data-move-x="150%">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-11 col-xs-12 col-sm-10 divRedondoR borderTopBrown shadowL">
      <h1 class="white font-serif" align="center" style="font-size: 45px;">Valores</h1>
    </div>
  </div>
  <div class="row bloque" data-move-x="150%">
    <div class="col-lg-1 col-xs-12 col-sm-1"></div>
    <div class="col-lg-11 col-xs-12 col-sm-10 divContenidoR shadowL">
    <div class="row">
      <div class="col-lg-3">
        <img src="<?=base_url()?>template/frontend/images/valores.png" width="70%" style="margin-top: 10px;margin-bottom: 10px;border-radius: 45% / 20%" class="center-block">
      </div>
      <div class="col-lg-9">
        <div role="tabpanel" style="margin-top: 10px">
          <ul class="nav nav-tabs font-alt" role="tablist" style="background-color: #38761d">
            <?php
            $iconos = ['icon-heart', 'icon-global', 'icon-chat', 'icon-happy'];
            $i = 0;
            foreach ($valores as $valor): 
            ?>
              <li class="<?php if($i==0){echo 'active';}?>"><a href="#<?=$valor->nombreValor;?>" data-toggle="tab"><span class="<?=$iconos[$i];?>"></span><?=$valor->nombreValor;?></a></li>
            <?php
              $i++;
            endforeach;
            ?>
          </ul>
          <div class="tab-content">
            <?php
            $i = 0;
            foreach ($valores as $valor): 
            ?>
              <div class="tab-pane <?php if($i==0){echo 'active';}?>" id="<?=$valor->nombreValor;?>">
              <div style="margin-top: 10px">
                <h3 class="white" style="margin-right: 10px" align="center"><?=$valor->descripcionValor;?></h3>
               </div>
            </div>
            <?php
              $i++;
            endforeach;
            ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>