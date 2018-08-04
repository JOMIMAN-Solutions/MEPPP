<?php
/**
* Archivo que contiene los scripts a los archivos JavaScript
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/views/template/backend
* @package application/view/template/backend
*
* @version 1.0.0
* Creado el 26/07/2018 a las 05:30 pm
* Ultima modificacion el 04/08/2018 a las 04:11 am
*/
?>

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- JS files of Grocery CRUD -->
    <?php foreach ($js_files as $file): ?>
    <script src="<?=$file;?>"></script>
    <?php endforeach; ?>

    <!-- Script para ocultar el preloader -->
    <script type="text/javascript">
        $(window).load(function() {
            $(".preloader").fadeOut("slow");
        });
    </script>

    <!--<script src="<?php //=base_url().'template/backend/assets/plugins/jquery/jquery.min.js';?>"></script>-->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url().'template/backend/assets/plugins/bootstrap/js/tether.min.js';?>"></script>
    <script src="<?=base_url().'template/backend/assets/plugins/bootstrap/js/bootstrap.min.js';?>"></script>
    <!--Wave Effects -->
    <script src="<?=base_url().'template/backend/template/js/waves.js';?>"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url().'template/backend/template/js/sidebarmenu.js';?>"></script>
    <!--stickey kit -->
    <script src="<?=base_url().'template/backend/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js';?>"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url().'template/backend/template/js/custom.min.js';?>"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?=base_url().'template/backend/assets/plugins/styleswitcher/jQuery.style.switcher.js';?>"></script>
</body>
</html>