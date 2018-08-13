<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con métodos que pemriten gestionar el módulo de Comentarios
* En esta clase se encuentran métodos como:
*     - __construct
*     - index
*     - save
*     - cPanel
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package application/controllers
*
* @version 1.0.1
* Creado el 15/06/2018 a las 10:35 am
* Ultima modificacion el 04/08/2018 a las 09:30 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Métodos para...
*     - Guardar comentarios
*     - Verificar el cambio de estatus del comentario para definir si se muestra o no en la pagina de comentarios
*/
class Comentario extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Comentario');
        $this->load->model('Mdl_QuienesSomos');
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
        $data['commentTypes'] = $this->Mdl_Comentario->getCommentTypes();

        $this->cargarVistaFront('vw_comentarios',$data);
    }

    /**
    * Método que guarda un comentario hecho desde el Frontend
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Comprobar que guarde, revisar los campos post conforme el formulario, revisar las rules y los messages
    */
    public function save()
    {
        $this->form_validation->set_rules('asunto', 'Asunto', 'required');
        $this->form_validation->set_rules('userMessage', 'Mensaje', 'trim|required|max_length[300]');
        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('trim','El campo %s no puede quedar vacio');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener máximo %d caracteres.');

        if ($this->form_validation->run() === false){
            $data['title'] = "MEPPP | Comentarios";
            $data['page'] = "Comentarios";
            $data['seccion'] = "4";
            $data['imagen'] = 'comentariosSeccion';
            $data['comentarios'] = $this->Mdl_Comentario->getRecent();
            $data['commentTypes'] = $this->Mdl_Comentario->getCommentTypes();
            $this->cargarVistaFront('vw_comentarios',$data);
        } else{
            $comentario = array(
                'fechaComentario' => $this->input->POST('fecha'),
                'mensaje' => $this->input->POST('userMessage'),
                'estatusComentario' => 'Inactivo',
                'Usuarios_idUsuario' => $this->session->userdata('perfil')->idUsuario,
                'TiposComentario_idTipoComentario' => $this->input->POST('asunto')
            );
            $this->Mdl_Comentario->insert($comentario);
            $this->session->set_flashdata('comentario',1);
            redirect('Comentario/index');
        }
    }


/* -------------------------------------- BACKEND --------------------------------------- */

    /**
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Comentarios
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
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposComentario_idTipoComentario','tipos_comentario','tipoComentario');

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
            $crud->fields('Usuarios_idUsuario', 'TiposComentario_idTipoComentario', 'fechaComentario', 'mensaje', 'estatusComentario');
            // Para el formulario add
            //$crud->add_fields('fechaComentario', 'mensaje', 'estatusComentario', 'Usuarios_idUsuario', 'TiposComentario_idTipoComentario');
            //$crud->unset_add_fields('idComentario');
            // Para el formulario edit
            //$crud->edit_fields('fechaComentario', 'mensaje', 'estatusComentario', 'TiposComentario_idTipoComentario');
            //$crud->unset_edit_fields('idComentario', 'Usuarios_idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);
            $crud->field_type('fechaComentario','readonly');
            $crud->field_type('mensaje','readonly');
            $crud->field_type('estatusComentario','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            $crud->field_type('Usuarios_idUsuario','readonly');
            $crud->field_type('TiposComentario_idTipoComentario','readonly');
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('estatusComentario');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
            //$crud->unset_edit();
            //$crud->unset_read();
            //$crud->unset_delete();
            //$crud->unset_print();
            //$crud->unset_export();
            //$crud->unset_operations();
            //$crud->unset_back_to_list();
            //$crud->unset_texteditor(campo, 'full_text');

            /* Funcion de exportar a PDF */
            $crud->unset_pdf();
            //$crud->setPdfUrl('');

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
            }

            /* Cargar las vistas */
            $this->load->view('template/backend/header',(array)$output);
            $this->load->view('backend/vw_comentarios.php',(array)$output);
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