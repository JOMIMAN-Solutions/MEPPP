<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar el módulo de Adopciones (backend)
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.0
* Creado el 26/07/2018 a las 05:50 pm
* Ultima modificacion el 04/08/2018 a las 03:47 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Insertar la solicitud desde el front, crear método para exportar a PDF
*/
class Adopcion extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Adopcion');
    }

    /**
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Adopcion
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.0
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function cPanel()
    {
        /**
        * Verificar que exista sesion de un administrador
        */
        if ($this->session->has_userdata('idAdmin')) {
        	/* Cargar la libreria */
            $this->load->library('grocery_CRUD');

            /* Instanciar un objeto de grocery crud */
            $crud = new grocery_CRUD();

            /* Establecer el tema */
            $crud->set_theme('bootstrap-v4');

            /* Indicar el "objeto" que estaremos manejando */
            $crud->set_subject('Adopción');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('adopciones');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idAdopcion' => 'ID',
                'fechaAdopcion' => 'Fecha',
                'totalAdoptados' => 'Total',
                'estatusAdopcion' => 'Estatus',
                'Usuarios_idUsuario' => 'Usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
            // set_relation_n_n(nombre_relacion, tabla_det, tabla3, pk_tabla_actual, pk_tabla3, campo_mostrar)

            /**
            * Condicion que determina si esta en alguno de los formularios, para omitir el campo "cantidad" de la relación en estas secciones.
            */
            if ($this->uri->segment(3) == 'add' || $this->uri->segment(3) == 'edit') {
                $crud->set_relation_n_n('Adoptados', 'det_adopciones', 'arboles', 'idAdopcion', 'idArbol', '{nombreComun}');
            } else {
                $crud->set_relation_n_n('Adoptados', 'det_adopciones', 'arboles', 'idAdopcion', 'idArbol', '{nombreComun} - {cantidad}');
            }

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idAdopcion','fechaAdopcion', 'totalAdoptados', 'estatusAdopcion', 'Usuarios_idUsuario');
            // Perzonalizado
            $crud->columns('Usuarios_idUsuario', 'fechaAdopcion', 'totalAdoptados', 'estatusAdopcion');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idAdopcion');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idAdopcion','fechaAdopcion', 'totalAdoptados', 'estatusAdopcion', 'Usuarios_idUsuario');
            // Perzonalizado
            $crud->fields('Usuarios_idUsuario', 'fechaAdopcion', 'totalAdoptados', 'Adoptados', 'estatusAdopcion');
            // Para el formulario add
            //$crud->add_fields('fechaAdopcion', 'totalAdoptados', 'estatusAdopcion', 'Usuarios_idUsuario', 'Adoptados');
            //$crud->unset_add_fields('idAdopcion');
            // Para el formulario edit
            //$crud->edit_fields('fechaAdopcion', 'totalAdoptados', 'estatusAdopcion');
            //$crud->unset_edit_fields('idAdopcion', 'Usuarios_idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);
            $crud->field_type('fechaAdopcion','readonly');
            $crud->field_type('totalAdoptados','readonly');
            $crud->field_type('estatusAdopcion','dropdown', array('En proceso' => 'En proceso', 'Cubierta' => 'Cubierta', 'Cancelda' => 'Cancelada'));
            $crud->field_type('Usuarios_idUsuario','readonly');
            $crud->field_type('Adoptados','readonly');
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('estatusAdopcion');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Ordenamiento de los datos a listar */
            // $crud->order_by(campo, direccion);
            $crud->order_by('fechaAdopcion', 'ASC');

            /* Deshabilitar funciones */
            $crud->unset_add();
            //$crud->unset_edit();
            //$crud->unset_read();
            $crud->unset_delete();
            //$crud->unset_print();
            //$crud->unset_export();
            //$crud->unset_operations();
            //$crud->unset_back_to_list();
            //$crud->unset_texteditor(campo, 'full_text');

            /* Funcion de exportar a PDF */
            /**
            * Validar si existen adopciones con estatus "Cubierta"
            * Si no existen deshabilita la funcion de exportar a pdf
            */
            $adopciones = $this->Mdl_Adopcion->getAllAdopciones();
            if ($adopciones == 0) {
                $crud->unset_pdf();
            } else {
                $crud->setPdfUrl('Adopcion/pdf');
            }
            
            /* Condiciones para los datos a listar */
            // $crud->where(campo, valor_condicion);

            /* Renderizar la tabla */
            $output = $crud->render();

            /* Variables para perzonalizar las paginas */
            // Titulo
            $output->title = "cPanel | Adopciones";
            // Clases para el menu lateral
            $output->activeAdopcion = "active";
            $output->activeArbol = "";
            $output->activeCampania = "";
            $output->activeComentario = "";
            $output->activeFaq = "";
            $output->activeUsuario = "";
            $output->activeQuienesSomos = "";
            //Imagen y nombre del administrador
            $this->load->model('Mdl_usuario');
            $admin = $this->Mdl_usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            /**
            * Condicion que determina la pagina en la que se encuentra, para establecer un valor diferente a la variable $accion. 
            */
            if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'success') {
                $output->accion = "Lista";
            } else if ($this->uri->segment(3) == 'read') {
                $output->accion = "Viendo";
            } else if ($this->uri->segment(3) == 'add') {
                $output->accion = "Agregando";
            } else if ($this->uri->segment(3) == 'edit') {
                $output->accion = "Modificando";
            }

            /* Cargar las vistas */
            $this->load->view('template/backend/header',(array)$output);
            $this->load->view('backend/vw_adopciones.php',(array)$output);
            $this->load->view('template/backend/footer',(array)$output);
        } else {
            redirect('Frontend/login');
        }
    }

    /**
    * Método que genera el formato del PDF a descargar
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function pdf ()
    {
        /**
        * Verificar que exista sesion de un administrador
        */
        if ($this->session->has_userdata('idAdmin')) {
            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

            // Fecha
            date_default_timezone_set('America/Mexico_City');
            $header = 'Reporte de adopciones cubiertas';
     
            // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
            $pdf->SetHeaderData(LOGO_EMPRESA, LOGO_WIDTH, $header, NOMBRE_EMPRESA, array(12, 38, 12), array(63, 191, 63));
            $pdf->setFooterData(array(12, 38, 12), array(63, 191, 63));
     
            // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
     
            // se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
     
            // se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
     
            // se pueden modificar en el archivo tcpdf_config.php de libraries/config
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
     
            //relación utilizada para ajustar la conversión de los píxeles
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
     
     
            // ---------------------------------------------------------
            // establecer el modo de fuente por defecto
            $pdf->setFontSubsetting(true);
     
            // Establecer el tipo de letra
     
            //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
            // Helvetica para reducir el tamaño del archivo.
            $pdf->SetFont('freemono', '', 11, '', true);
     
            // Añadir una página
            // Este método tiene varias opciones, consulta la documentación para más información.
            $pdf->AddPage();
     
            //fijar efecto de sombra en el texto
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
     
            // Establecemos el contenido para imprimir
            //preparamos y maquetamos el contenido a crear
            $html = '';
            $html .= '<!DOCTYPE html>';
            $html .= '<html lang="en">';
            $html .= '<head>';
                $html .= '<meta charset="UTF-8">';
                $html .= '<title>Adopciones</title>';
                $html .= '<style type=text/css>';
                    $html .= 'body{text-align: center;}';
                    $html .= 'table, th, td{border:1px black solid; border-collapse: collapse;}';
                $html .= '</style>';
            $html .= '</head>';
            $html .= '<body>';
                $html .= '<table width="100%">';
                    $html .= '<tr>';
                        $html .= '<th><strong>Usuario</strong></th>';
                        $html .= '<th><strong>Fecha</strong></th>';
                        $html .= '<th><strong>Total</strong></th>';
                        $html .= '<th><strong>Árboles adoptados</strong></th>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                        $html .= '<td></td>';
                    $html .= '</tr>';
                    $adopciones = $this->Mdl_Adopcion->getAllAdopciones();
                    /**
                    * Ciclo que recorre los registros de adopciones e inserta una fila por cada uno.
                    */
                    foreach($adopciones as $adopcion){
                        $html .= '<tr>';
                            $html .= '<td>'.$adopcion->nombreUsuario.' '.$adopcion->apePat.' '.$adopcion->apeMat.'</td>';
                            $html .= '<td>'.$adopcion->fechaAdopcion.'</td>';
                            $html .= '<td>'.$adopcion->totalAdoptados.'</td>';
                            $html .= '<td>';
                            $arboles = $this->Mdl_Adopcion->getArbolesByAdopcion($adopcion->idAdopcion);
                                /**
                                * Ciclo que recorre los registros de arboles adoptados en cada una de las adopciones e el nombre del arbol y la cantidad
                                */
                                foreach($arboles as $arbol){
                                    $html .= $arbol->nombreComun.'('.$arbol->cantidad.'). ';
                                }
                            $html .= '</td>';
                        $html .= '</tr>';
                    }
                $html .= '</table>';
            $html .= '</body>';
            $html .= '</html>';
     
            // Imprimimos el texto con writeHTMLCell()
            $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
     
            // ---------------------------------------------------------
            // Cerrar el documento PDF y preparamos la salida
            // Este método tiene varias opciones, consulte la documentación para más información.
            $titulo = 'AdopcionesCubiertas_'.date('d').'-'.date('m').'-'.date('Y');
            $nombre_archivo = utf8_decode($titulo . ".pdf");
            $pdf->Output($nombre_archivo, 'I');
        } else {
            redirect('Frontend/login');
        }
    }
}