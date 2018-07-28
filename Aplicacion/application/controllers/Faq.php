<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Clase con las funciones que permiten gestionar el módulo de faq
* En esta clase se encuentran métodos como:
*     - index()
*     - cargarVistaFront()
*
* @autor Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package applications/controllers
*
* @version 1.0
* Creado el 15/06/2018 a las 05:09 pm
* Ultima modificacion el 27/07/2018 a las 10:50 pm
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo Realizar método para guardar,modificar y eliminar un arbol.
*/
class Faq extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Faq');
    }


     /**
    * Método para obtener todas las faqs de la abse de datos
    * 
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

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        $crud->columns('idFaq','pregunta', 'respuesta', 'Administradores_idAdministrador', 'SeccionesFaq_idSeccionFaq');
        // Perzonalizado
        //$crud->columns('pregunta', 'respuesta', 'Administradores_idAdministrador', 'SeccionesFaq_idSeccionFaq');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idFaq');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idFaq','pregunta', 'respuesta', 'Administradores_idAdministrador', 'SeccionesFaq_idSeccionFaq');
        // Perzonalizado
        //$crud->fields('pregunta', 'respuesta', 'Administradores_idAdministrador', 'SeccionesFaq_idSeccionFaq');
        // Para el formulario add
        //$crud->add_fields('idFaq','pregunta', 'respuesta', 'Administradores_idAdministrador', 'SeccionesFaq_idSeccionFaq');
        //$crud->unset_add_fields('idFaq');
        // Para el formulario edit
        //$crud->edit_fields('idFaq','pregunta', 'respuesta', 'SeccionesFaq_idSeccionFaq');
        //$crud->unset_edit_fields('Administradores_idAdministrador');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden
            // invisible
            // password
            // enum
            // set
            // integer
            // true_false
            // string
            // text
            // date
            // datetime
            // readonly
        // $crud->field_type(campo, type, value);

        /* Habilitar un input como campos para subir archivos */
        // set_fiekd_upload(campo, ruta_archivos);
        //$crud->set_field_upload('idFaq','assets/uploads/files');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idFaq' => 'ID',
            'pregunta' => 'Pregunta',
            'respuesta' => 'Respuesta',
            'Administradores_idAdministrador' => 'Creador',
            'SeccionesFaq_idSeccionFaq' => 'Sección'
        );
        $crud->display_as($campos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('idFaq','pregunta', 'respuesta', 'Administradores_idAdministrador', 'SeccionesFaq_idSeccionFaq');

        /* Establecer las reglas de los formularios */
        $crud->set_rules('idFaq', 'Id Faq', 'required');

        /* Deshabilitar funciones */
        //$crud->unset_add();
        //$crud->unset_edit();
        //$crud->unset_read();
        //$crud->unset_delete();
        //$crud->unset_print();
        //$crud->unset_export();
        //$crud->unset_operations();
        //$crud->unset_back_to_list();

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        $crud->set_relation('Administradores_idAdministrador','usuarios','{nombreusuario} {apePat} {apeMat}');
        $crud->set_relation('SeccionesFaq_idSeccionFaq','secciones_faq','nombreSeccion');

        /* Condiciones para los datos a listar */
        // $crud->where(campo, valor_condicion);

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Clases para el menu lateral */
        $output->activeAdopcion = "";
        $output->activeArbol = "";
        $output->activeCampania = "";
        $output->activeComentario = "";
        $output->activeFaq = "active";
        $output->activeUsuario = "";
        $output->activeQuienesSomos = "";

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