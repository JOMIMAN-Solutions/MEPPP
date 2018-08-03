<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Clase con las funciones que permiten gestionar el módulo de FAQs
* En esta clase se encuentran métodos como:
*     - __contruct
*     - index()
*     - cPanel
*     - cargarVistaFront()
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.1
* Creado el 15/06/2018 a las 05:09 pm
* Ultima modificacion el 03/08/2018 a las 01:49 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Nada
*/
class Faq extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Faq');
    }


     /**
    * Método para obtener todas las faqs de la base de datos 
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
        $data['title']="MEPPP | FAQS";
        $data['page']="FAQS";
        $data['seccion']="6";
        $data['imagen']='faqsSeccion';
        $data['secciones'] = $this->Mdl_Faq->getSecciones();
        $data['faqs'] = $this->Mdl_Faq->getAllFaqs();

        $this->cargarVistaFront('vw_faqs',$data);
    }


/* -------------------------------------- BACKEND --------------------------------------- */

    /**
    * Método con las propiedades de configuración de Grocery CRUD en el modulo FAQs
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo poner el idUsuario de la sesion en el campo oculto
    */
    public function cPanel()
    {
        /* Cargar la libreria */
        $this->load->library('grocery_CRUD');

        /* Instanciar un objeto de grocery crud */
        $crud = new grocery_CRUD();

        /* Establecer el tema */
        $crud->set_theme('bootstrap-v4');

        /* Indicar el "objeto" que estaremos manejando */
        $crud->set_subject('FAQ');

        /* Indicar con que tabla se trabajará */
        $crud->set_table('faqs');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idFaq' => 'ID',
            'pregunta' => 'Pregunta',
            'respuesta' => 'Respuesta',
            'Usuarios_idUsuario' => 'Administrador',
            'SeccionesFaq_idSeccionFaq' => 'Sección'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)

        /**
        * Condicion que determina si esta en alguno de los formularios, para que no establezca una relación en estas secciones.
        */
        if ($this->uri->segment(3) == 'add' || $this->uri->segment(3) == 'edit') {
            $crud->set_relation('SeccionesFaq_idSeccionFaq','secciones_faq','nombreSeccion');
        } else {
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('SeccionesFaq_idSeccionFaq','secciones_faq','nombreSeccion');
        }

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idFaq','pregunta', 'respuesta', 'Usuarios_idUsuario', 'SeccionesFaq_idSeccionFaq');
        // Perzonalizado
        $crud->columns('SeccionesFaq_idSeccionFaq', 'pregunta', 'respuesta', 'Usuarios_idUsuario');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idFaq');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idFaq','pregunta', 'respuesta', 'Usuarios_idUsuario', 'SeccionesFaq_idSeccionFaq');
        // Perzonalizado
        $crud->fields('pregunta', 'respuesta', 'Usuarios_idUsuario', 'SeccionesFaq_idSeccionFaq');
        // Para el formulario add
        //$crud->add_fields('pregunta', 'respuesta', 'Usuarios_idUsuario', 'SeccionesFaq_idSeccionFaq');
        //$crud->unset_add_fields('idFaq');
        // Para el formulario edit
        //$crud->edit_fields('pregunta', 'respuesta', 'SeccionesFaq_idSeccionFaq');
        //$crud->unset_edit_fields('idFaq', 'Usuarios_idUsuario');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);

        /**
        * Condicion que determina si esta en alguno de los formularios, para establecer un tipo de campo especifico en estas secciones.
        */
        if ($this->uri->segment(3) == 'add' || $this->uri->segment(3) == 'edit') {
            $crud->field_type('Usuarios_idUsuario', 'hidden', 1);
        }
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('pregunta', 'respuesta', 'Usuarios_idUsuario', 'SeccionesFaq_idSeccionFaq');

        /* Establecer las reglas de los formularios */
        // $crud->set_rules(campo, label, rule);
        $crud->set_rules('pregunta', 'Pregunta', 'trim|required');
        $crud->set_rules('respuesta', 'Respuesta', 'trim|required');

        /* Deshabilitar funciones */
        //$crud->unset_add();
        //$crud->unset_edit();
        //$crud->unset_read();
        //$crud->unset_delete();
        //$crud->unset_print();
        //$crud->unset_export();
        //$crud->unset_operations();
        //$crud->unset_back_to_list();
        //$crud->unset_texteditor(campo, 'full_text');
        $crud->unset_texteditor('respuesta', 'full_text');

        /* Funcion de exportar a PDF */
        $crud->unset_pdf();
        //$crud->setPdfUrl('');

        /* Condiciones para los datos a listar */
        // $crud->where(campo, valor_condicion);

        /* Ordenamiento de los datos a listar */
        // $crud->order_by(campo, direccion);
        $crud->order_by('SeccionesFaq_idSeccionFaq', 'DESC');

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Variables para perzonalizar las paginas */
        // Titulo
        $output->title = "cPanel | FAQs";
        // Clases para el menu lateral
        $output->activeAdopcion = "";
        $output->activeArbol = "";
        $output->activeCampania = "";
        $output->activeComentario = "";
        $output->activeFaq = "active";
        $output->activeUsuario = "";
        $output->activeQuienesSomos = "";
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
        $this->load->view('backend/vw_faqs.php',(array)$output);
        $this->load->view('template/backend/footer',(array)$output);
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
        if (isset($data['seccion'])) {
            $this->load->view('template/frontend/headerSeccion',$data);
        }else{
            $this->load->view('template/frontend/header', $data);   
        }
        $this->load->view('frontend/' . $view, $data);
        $this->load->view('template/frontend/footer');
    }
}