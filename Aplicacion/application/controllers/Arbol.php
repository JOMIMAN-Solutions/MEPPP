<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar el módulo de Arbol
* En esta clase se encuentran métodos como:
*     - index
*     - addTree
*     - deleteTree
*     - vaciarCanasta
*     - misAdopciones
*     - cPanel
*     - pdf
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.1
* Creado el 14/06/2018 a las 10:40 pm
* Ultima modificacion el 04/08/2018 a las 09:30 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Método para exporta a PDF
*/
class Arbol extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Arbol');
        $this->load->model('Mdl_QuienesSomos');
    }

    /**
    * Método para cargar todos los arboles de la base de datos y enviar un array con datos al metodo de cargarVistaFront
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function index()
    {

        /**
        * Condición que determina si se esta realizando una búsqueda para dejar seleccionado el valor correspondiente en los select en la
        * vista vw_invernadero
        */
        if ($this->input->post('bTipo') || $this->input->post('bTemporada')) {
            $dataBusqueda = array(
                'tipo' => $this->input->post('bTipo'),
                'temporada' => $this->input->post('bTemporada')
            );
            $bus = (object)$dataBusqueda;
            $this->session->set_userdata('busqueda', $bus);
            $data['busquedaTipo'] = $this->input->post('bTipo');
            $data['busquedaTemporada'] = $this->input->post('bTemporada');    
        }
        /**
        * Condición que determina si la búsqueda se ha reseteado para posteriormente eliminar la sesión búsqueda;
        */
        if ($this->input->post('valorEscondido')==" " && $this->input->post('valorEscondido2')==" ") {
          $this->session->unset_userdata('busqueda');  
        }

    
        $data['title']="MEPPP | Invernadero";
        $data['page']="Invernadero";
        $data['seccion']="1";
        $data['imagen']='invernaderoSeccion';
        $data['temporadas']=$this->Mdl_Arbol->getTemporadasArboles();
        $data['tipos']=$this->Mdl_Arbol->getTiposArboles();

        //PAGINACIÓN
        $config['base_url'] = base_url() . 'Arbol/page/';
        /**
        * Condición que determina si la sesión búsqueda existe
        */
        if ($this->session->has_userdata('busqueda')) {
            $config['total_rows'] = $this->Mdl_Arbol->totalRows($this->session->userdata('busqueda')->tipo,$this->session->userdata('busqueda')->temporada);
        }else{
         $config['total_rows'] = $this->Mdl_Arbol->totalRows(0,0);   
        }

        $config['per_page'] = 4;
        $config['num_links'] = 4;
        $config['first_link'] = '<span class="fa fa-angle-double-left"></span>';
        $config['last_link'] = '<span class="fa fa-angle-double-right"></span>';
        $config['cur_tag_open'] = '<span class="active">';
        $config['cur_tag_close'] = '</span>';
        $config['next_link'] = '<span class="fa fa-angle-right"></span>';
        $config['prev_link'] = '<span class="fa fa-angle-left"></span>';
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        $data["arboles"] = $this->Mdl_Arbol->getTreesPaged($config['per_page'], $this->uri->segment(3),$this->input->post('bTipo'),$this->input->post('bTemporada'));


        /**
        * Condición que determina si la sesión búsqueda existe
        */
        if ($this->session->has_userdata('busqueda')) {
            $data["arboles"] = $this->Mdl_Arbol->getTreesPaged($config['per_page'], $this->uri->segment(3),$this->session->userdata('busqueda')->tipo,$this->session->userdata('busqueda')->temporada);
            $data['busquedaTipo'] = $this->session->userdata('busqueda')->tipo;
            $data['busquedaTemporada'] = $this->session->userdata('busqueda')->temporada;
        }

        /**
        * Condición que determina si se abrirá una ventana modal al cargar la pagina, se verifica la existencia de session con el nombre 
        * de item.
        */
        if ($this->session->flashdata('item')) {
           
        }else{
           $this->session->set_flashdata('item', 3);
        }
    
        $this->cargarVistaFront('vw_invernadero',$data);
    }

    /**
    * Descripción corta del fichero (obligatoria, una línea)
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param 
    *    - [tipo] [nombre_de_variable] [descripción]
    *    - [tipo] [nombre_de_variable] [descripción]
    * @return [tipo_de_dato]
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo [información]
    */
    public function addTree()
    {
        $id = $this->input->post('id');
        $arbolResult = $this->Mdl_Arbol->getOneById($id);
        foreach ($arbolResult as $arbol) {}
        $cantidad = 1;
        
        // Creamos un arreglo con los productos para insertarlos en el carrito
        $insert = array(
            'id' => $id,
            'qty' => $cantidad,
            'price' => 0,
            'name' => $arbol->nombreComun,
            'image' => $arbol->imagenArbol
        );

        // Insertamos al carrito
        $this->cart->insert($insert);

        // Obtenemos la url para redirigir a la página en la que estabamos
        $uri = $this->input->post('uri');
        
        /* Redirigimos mostrando un mensaje con las sesiones flashdata
           confirmando que hemos agregado el árbol */
        $this->session->set_flashdata('item',4);
        redirect(base_url().'Arbol/page/'.$uri, 'refresh');
    }
    
    /**
    * Descripción corta del fichero (obligatoria, una línea)
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param 
    *    - [tipo] [nombre_de_variable] [descripción]
    *    - [tipo] [nombre_de_variable] [descripción]
    * @return [tipo_de_dato]
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo [información]
    */
    public function deleteTree($rowid) 
    {
        /* Para eliminar un producto debemos conseguir su id y actualizarlo poniendo qty en 0 */
        $arbol = array(
            'rowid' => $rowid,
            'qty' => 0
        );

        /* después utilizamos la función update para actualizar el carrito pasando el array a actualizar */
        $this->cart->update($arbol);
        
        //$this->session->set_flashdata('productoEliminado', 'El producto fue eliminado correctamente');
        $this->session->set_flashdata('item',1);
        if ($this->cart->contents()) {
            redirect(base_url().'Arbol/', 'refresh');
        } else {
            redirect(base_url().'Arbol', 'refresh');
        }
        
    }
    
    /**
    * Descripción corta del fichero (obligatoria, una línea)
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param 
    *    - [tipo] [nombre_de_variable] [descripción]
    *    - [tipo] [nombre_de_variable] [descripción]
    * @return [tipo_de_dato]
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo [información]
    */
    public function vaciarCanasta() {
        $this->cart->destroy();
        //$this->session->set_flashdata('destruido', 'El carrito fue eliminado correctamente');
        $this->session->set_flashdata('item',5);
        redirect(base_url().'Arbol', 'refresh');
    }

    /**
    * Método que pemrite enviar la solicitud de adopcion
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function adoptar()
    {
        /**
        * Condición para determinar si existe la sesión perfil
        * Si no, se le mandara a loguearse. De lo contrario podra seguir con el proceso
        */
        if ($this->session->has_userdata('perfil')) {
            $this->Mdl_Arbol->adoptar();

            $this->cart->destroy();

            redirect('Arbol/index');
        } else {
            redirect('Frontend/login');
        }
    }


/* -------------------------------------- BACKEND --------------------------------------- */

    /**
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Invernadero
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
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
            $crud->set_subject('Árbol');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('arboles');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idArbol' => 'ID',
                'imagenArbol' => 'Imagen',
                'nombreComun' => 'Nombre Común',
                'nombreCientifico' => 'Nombre Científico',
                'descripcion' => 'Descripción',
                'existencia' => 'Existencia',
                'estatusArbol' => 'Estatus',
                'TiposArbol_idTipoArbol' => 'Tipo de árbol'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('TiposArbol_idTipoArbol','tipos_arbol','tipoArbol');
            // set_relation_n_n(nombre_relacion, tabla_det, tabla3, pk_tabla_actual, pk_tabla3, campo_mostrar)
            $crud->set_relation_n_n('Temporadas', 'det_temporadas', 'temporadas_arbol', 'idArbol', 'idTemporadaArbol', 'temporadaArbol');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idArbol','imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
            // Perzonalizado
            $crud->columns('imagenArbol', 'nombreComun', 'existencia', 'TiposArbol_idTipoArbol', 'Temporadas', 'estatusArbol');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idArbol', 'nombreCientifico', 'descripcion', 'TiposArbol_idTipoArbol');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idArbol','imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol', 'Temporadas');
            // Perzonalizado
            $crud->fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol', 'Temporadas');
            // Para el formulario add
            //$crud->add_fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
            //$crud->unset_add_fields('idFaq');
            // Para el formulario edit
            //$crud->edit_fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
            //$crud->unset_edit_fields('idFaq', 'Administradores_idAdministrador');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);
            $crud->field_type('estatusArbol','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            
            /* Habilitar un input como campos para subir archivos */
            $crud->set_field_upload('imagenArbol', 'images/arboles');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);
            $crud->set_rules('nombreComun', 'Nombre Común', 'trim|required');
            $crud->set_rules('nombreCientifico', 'Nombre Científico', 'trim|required');
            $crud->set_rules('descripcion', 'Descripción', 'trim|required');

            /* Deshabilitar funciones */
            //$crud->unset_add();
            //$crud->unset_edit();
            //$crud->unset_read();
            $crud->unset_delete();
            //$crud->unset_print();
            //$crud->unset_export();
            //$crud->unset_operations();
            //$crud->unset_back_to_list();
            //$crud->unset_texteditor(campo, 'full_text');
            $crud->unset_texteditor('descripcion', 'full_text');

            /* Funcion de exportar a PDF */
            /**
            * Validar si existen arboles en el invernadero
            * Si no existen deshabilita la funcion de exportar a pdf
            */
            $arboles = $this->Mdl_Arbol->getAllInvernadero();
            if ($arboles == 0) {
                $crud->unset_pdf();
            } else {
                $crud->setPdfUrl('Arbol/pdf');
            }

            /* Condiciones para los datos a listar */
            // $crud->where(campo, valor_condicion);

            /* Ordenamiento de los datos a listar */
            // $crud->order_by(campo, direccion);
            $crud->order_by('nombreComun', 'ASC');

            /* Renderizar la tabla */
            $output = $crud->render();

            /* Variables para perzonalizar las paginas */
            // Titulo
            $output->title = "cPanel | Invernadero";
            // Clases para el menu lateral
            $output->activeAdopcion = "";
            $output->activeArbol = "active";
            $output->activeCampania = "";
            $output->activeComentario = "";
            $output->activeFaq = "";
            $output->activeUsuario = "";
            $output->activeQuienesSomos = "";
            //Imagen y nombre del administrador
            $this->load->model('Mdl_Usuario');
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
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
            } else {
                $output->accion = "";
            }

            /* Cargar las vistas */
            $this->load->view('template/backend/header',(array)$output);
            $this->load->view('backend/vw_invernadero.php',(array)$output);
            $this->load->view('template/backend/footer',(array)$output);
        } else {
            /**
            * Verificar si hay sesión de un usuario que no es administrador
            */
            if ($this->session->has_userdata('perfil')) {
                redirect('Frontend/index');
            } else {
                redirect('Frontend/login');
            }
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
            $header = 'Reporte del invernadero';
     
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
                $html .= '<title>Invernadero</title>';
                $html .= '<style type=text/css>';
                    $html .= 'body{text-align: center;}';
                    $html .= 'table, th, td{border:1px black solid; border-collapse: collapse;}';
                $html .= '</style>';
            $html .= '</head>';
            $html .= '<body>';
                $html .= '<table width="100%">';
                    $html .= '<tr>';
                        $html .= '<th><strong>Nombre Común</strong></th>';
                        $html .= '<th><strong>Nombre Científico</strong></th>';
                        $html .= '<th><strong>Existencia</strong></th>';
                        $html .= '<th><strong>Tipo de arbol</strong></th>';
                        $html .= '<th><strong>Temporada(s)</strong></th>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                        $html .= '<td></td>';
                    $html .= '</tr>';
                    $arboles = $this->Mdl_Arbol->getAllInvernadero();
                    /**
                    * Ciclo que recorre los registros de arboles e inserta una fila por cada uno.
                    */
                    foreach($arboles as $arbol){
                        $html .= '<tr>';
                            $html .= '<td>'.$arbol->nombreComun.'</td>';
                            $html .= '<td>'.$arbol->nombreCientifico.'</td>';
                            $html .= '<td>'.$arbol->existencia.'</td>';
                            $html .= '<td>'.$arbol->tipoArbol.'</td>';
                            $html .= '<td>';
                                $temps = $this->Mdl_Arbol->getTempsArboles($arbol->idArbol);
                                /**
                                * Ciclo que recorre los registros de las temporadas de cada árbol
                                */
                                foreach($temps as $temp){
                                    $html .= $temp->temporadaArbol.'. ';
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
            $titulo = 'Invernadero_'.date('d').'-'.date('m').'-'.date('Y');
            $nombre_archivo = utf8_decode($titulo.".pdf");
            $pdf->Output($nombre_archivo, 'I');
        } else {
            /**
            * Verificar si hay sesión de un usuario que no es administrador
            */
            if ($this->session->has_userdata('perfil')) {
                redirect('Frontend/index');
            } else {
                redirect('Frontend/login');
            }
        }
    }



/* ------------------------------------------------------------------------------------- */

    /**
    * Método que carga las vistas especificadas para el frontend
    * Por defecto ya carga el header y footer y la vista a cargar debe ser especificada.
    *
    * @access public
    * @param 
    *    - String $view Vista que se desea cargar
    *    - Array $data Arreglo que contiene variables que serviran en la pagina cargada
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function cargarVistaFront($view, $data) 
    {
        $this->load->view('template/frontend/headerSeccion',$data);
        $this->load->view('frontend/' . $view, $data);

        $datos = $this->Mdl_QuienesSomos->getDatos();
        foreach ($datos as $dato) {}
        $data['dato'] = $dato;

        $direccion = $this->Mdl_QuienesSomos->getDireccion();
        foreach ($direccion as $dir) {}
        $data['direccion'] = $dir;

        $this->load->view('template/frontend/footer', $data);
    }
}

