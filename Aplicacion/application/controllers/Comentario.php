<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con métodos que pemriten gestionar el módulo de Comentarios
* En esta clase se encuentran métodos como:
*     - __construct
*     - index
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package application/controllers
*
* @version 1.0.0
* Creado el 15/06/2018 a las 10:35 am
* Ultima modificacion el 29/07/2018 a las 05:45 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Métodos para...
*     - Guardar comentarios
*     - Cambiar estatus del comentario para definir si se muestra o no en la pagina de comentarios
*/
class Comentario extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Comentario');
    }


    /**
    * Metodo que carga los 15 comentarios más recientes en la pagina de Comentario
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
        $data['title'] = "MEPPP | Comentarios";
        $data['page'] = "Comentarios";
        $data['seccion'] = "4";
        $data['imagen'] = 'comentariosSeccion';
        $data['comentarios'] = $this->Mdl_Comentario->getRecent();

        $this->cargarVistaFront('vw_comentarios',$data);
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
        $crud->set_subject('Comentario');

        /* Indicar con que tabla se trabajará */
        $crud->set_table('comentarios');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idComentario' => 'ID',
            'fechaComentario' => 'Fecha',
            'mensaje' => 'Mensaje',
            'estatusComentario' => 'Estatus',
            'Usuarios_idUsuario' => 'De',
            'TiposComentario_idTipoComentario' => 'Tipo de comentario'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'read' || $this->uri->segment(3) == 'success') {
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposComentario_idTipoComentario','tipos_comentario','tipoComentario');
        } else if ($this->uri->segment(3) == 'add') {
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposComentario_idTipoComentario','tipos_comentario','tipoComentario');
        } else if ($this->uri->segment(3) == 'edit') {
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposComentario_idTipoComentario','tipos_comentario','tipoComentario');
        }

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idComentario', 'fechaComentario', 'mensaje', 'estatusComentario', 'Usuarios_idUsuario', 'TiposComentario_idTipoComentario');
        // Perzonalizado
        $crud->columns('Usuarios_idUsuario', 'TiposComentario_idTipoComentario', 'mensaje', 'fechaComentario', 'estatusComentario');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idComentario');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idComentario', 'fechaComentario', 'mensaje', 'estatusComentario', 'Usuarios_idUsuario', 'TiposComentario_idTipoComentario');
        // Perzonalizado
        //$crud->fields('fechaComentario', 'mensaje', 'estatusComentario', 'Usuarios_idUsuario', 'TiposComentario_idTipoComentario');
        // Para el formulario add
        //$crud->add_fields('fechaComentario', 'mensaje', 'estatusComentario', 'Usuarios_idUsuario', 'TiposComentario_idTipoComentario');
        $crud->unset_add_fields('idComentario');
        // Para el formulario edit
        //$crud->edit_fields('fechaComentario', 'mensaje', 'estatusComentario', 'TiposComentario_idTipoComentario');
        $crud->unset_edit_fields('idComentario', 'Usuarios_idUsuario');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        // Seccion titulos
        if ($this->uri->segment(3) == 'add') {
            $crud->field_type('estatusComentario', 'true_false');
        } else if ($this->uri->segment(3) == 'edit') {
            $crud->field_type('estatusComentario', 'true_false');
        }
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('fechaComentario', 'mensaje', 'estatusComentario', 'Usuarios_idUsuario', 'TiposComentario_idTipoComentario');

        /* Establecer las reglas de los formularios */
        // $crud->set_rules(campo, label, rule);

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
        $crud->unset_texteditor('mensaje', 'full_text');

        /* Condiciones para los datos a listar */
        // $crud->where(campo, valor_condicion);

        /* Ordenamiento de los datos a listar */
        // $crud->order_by(campo, direccion);
        $crud->order_by('fechaComentario', 'DESC');

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Variables para perzonalizar las paginas */
        // Titulo
        $output->title = "cPanel | Comentarios";
        // Clases para el menu lateral
        $output->activeAdopcion = "";
        $output->activeArbol = "";
        $output->activeCampania = "";
        $output->activeComentario = "active";
        $output->activeFaq = "";
        $output->activeUsuario = "";
        $output->activeQuienesSomos = "";
        // Seccion titulos
        if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'success') {
            $output->seccion = "Lista";
        } else if ($this->uri->segment(3) == 'read') {
            $output->seccion = "Viendo";
        } else if ($this->uri->segment(3) == 'add') {
            $output->seccion = "Agregando";
        } else if ($this->uri->segment(3) == 'edit') {
            $output->seccion = "Modificando";
        }

        /* Cargar las vistas */
        $this->load->view('template/backend/header',(array)$output);
        $this->load->view('backend/vw_comentarios.php',(array)$output);
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
        $this->load->view('template/frontend/headerSeccion',$data);
        $this->load->view('frontend/' . $view, $data);
        $this->load->view('template/frontend/footer');
    }
}