<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con métodos que permiten gestionar el módulo de Campañas
* En esta clase se encuentran métodos como:
*     - __construct
*     - index
*     - getEvents
*     - cPanel
*     - evidencia
*     - cargasrVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.1
* Creado el 15/06/2018 a las 10:05 am
* Ultima modificacion el 04/08/2018 a las 09:30 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Métodos para...
*     - Obetener campañas para el calendario
*     - Obetener los datos de una campaña en especifico
*/
class Campania extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Campania');
        $this->load->model('Mdl_QuienesSomos');
    }

    /**
    * Metodo que carga las campañas terminadas en la pagina de Campañas del frontend
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
        $data['title'] = "MEPPP | Campañas";
        $data['page'] = "Campañas";
        $data['seccion'] = "2";
        $data['imagen'] = 'campañasSeccion';
        $data['campanias'] = $this->Mdl_Campania->getAllComplete();
        $data['imagenes'] = $this->Mdl_Campania->getImagenes();

        $this->cargarVistaFront('vw_campañas', $data);
    }

    /**
    * Metodo que carga todos los eventos que la empresa hará para posteriormente mostrarlos en un calendario
    *
    * @access public
    * @param Ninguno
    * @return json
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getEvents(){
        $result=$this->Mdl_Campania->getEvents();
        echo json_encode($result);

    }


/* -------------------------------------- BACKEND --------------------------------------- */

    /**
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Campañas
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Poner el idUsuario de la sesion en el campo oculto
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
            $crud->set_subject('Campaña');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('campanias');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idCampania' => 'ID',
                'imagenPortada' => 'Portada',
                'nombreCampania' => 'Nombre',
                'fechaInicio' => 'Fecha de inicio',
                'fechaFin' => 'Fecha de fin',
                'hora' => 'Hora',
                'lugar' => 'Lugar',
                'publico' => 'Público',
                'estatusCampania' => 'Estatus',
                'Usuarios_idUsuario' => 'Adminitrador',
                'TiposCampania_idTipoCampania' => 'Tipo de campaña'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)

            /**
            * Condicion que determina si esta en alguno de los formularios, para que no establezca una relación en estas secciones.
            */
            if ($this->uri->segment(3) == 'add' || $this->uri->segment(3) == 'edit') {
                $crud->set_relation('TiposCampania_idTipoCampania','tipos_campania','tipoCampania');
            } else {
                $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
                $crud->set_relation('TiposCampania_idTipoCampania','tipos_campania','tipoCampania');
            }
            
            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idCampania', 'imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Usuarios_idUsuario', 'TiposCampania_idTipoCampania');
            // Perzonalizado
            $crud->columns('imagenPortada', 'nombreCampania', 'fechaInicio', 'TiposCampania_idTipoCampania', 'estatusCampania');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idCampania', 'fechaFin', 'lugar', 'hora', 'publico', 'Usuarios_idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idCampania', 'imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Usuarios_idUsuario', 'TiposCampania_idTipoCampania');
            // Perzonalizado
            $crud->fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'TiposCampania_idTipoCampania', 'estatusCampania', 'Usuarios_idUsuario');
            // Para el formulario add
            //$crud->add_fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Usuarios_idUsuario', 'TiposCampania_idTipoCampania');
            //$crud->unset_add_fields('idCampania');
            // Para el formulario edit
            //$crud->edit_fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Usuarios_idUsuario', 'TiposCampania_idTipoCampania');
            //$crud->unset_edit_fields('idCampania');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina en que pagina se encuentra, para establecer un tipo de campo especifico cada sección.
            */
            if ($this->uri->segment(3) == 'add') {
                $crud->field_type('estatusCampania','hidden', 'Próxima');
                $crud->field_type('Usuarios_idUsuario', 'hidden', $this->session->userdata('idAdmin'));
            } else if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('estatusCampania','dropdown', array('Realizada' => 'Realizada', 'Cancelada' => 'Cancelada'));
                $crud->field_type('Usuarios_idUsuario', 'hidden', $this->session->userdata('idAdmin'));
            } else {
                $crud->field_type('estatusCampania','dropdown', array('Próxima' => 'Próxima', 'Realizada' => 'Realizada', 'Cancelada' => 'Cancelada'));
            }
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('imagenPortada', 'images/campañas');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Usuarios_idUsuario', 'TiposCampania_idTipoCampania');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);
            $crud->set_rules('nombreCampania', 'Nombre', 'trim|required');
            $crud->set_rules('hora', 'Hora', 'trim|required');
            $crud->set_rules('lugar', 'Lugar', 'trim|required');
            $crud->set_rules('publico', 'Público', 'trim|required');

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

            /* Funcion de exportar a PDF */
            $crud->unset_pdf();
            //$crud->setPdfUrl('');

            /* Condiciones para los datos a listar */
            // $crud->where(campo, valor_condicion);

            /* Ordenamiento de los datos a listar */
            // $crud->order_by(campo, direccion);
            $crud->order_by('fechaInicio', 'DESC');

            /* Renderizar la tabla */
            $output = $crud->render();

            /* Variables para perzonalizar las paginas */
            // Titulo
            $output->title = "cPanel | Campañas";
            // Clases para el menu lateral
            $output->activeAdopcion = "";
            $output->activeArbol = "";
            $output->activeCampania = "active";
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
            $output->seccion = "Campañas";

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
            $this->load->view('backend/vw_campanias.php',(array)$output);
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
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Campañas
    * En particular poder gestionar las imagenes de evidencia para las campañas con estatus "Realizada".
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Poder hacer que las imagenes de una campaña se vean juntas por campaña
    */
    public function evidencia()
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
            $crud->set_subject('Imagen');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('imagenes_campania');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idImagenCampania' => 'ID',
                'urlImagen' => 'Imagen',
                'Campanias_idCampania' => 'Campaña'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Campanias_idCampania','campanias','nombreCampania', array('estatusCampania' => 'Realizada'));
            
            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idImagenCampania', 'urlImagen', 'Campanias_idCampania');
            // Perzonalizado
            $crud->columns('Campanias_idCampania', 'urlImagen');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idImagenCampania');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idImagenCampania', 'urlImagen', 'Campanias_idCampania');
            // Perzonalizado
            $crud->fields('Campanias_idCampania', 'urlImagen');
            // Para el formulario add
            //$crud->add_fields('urlImagen', 'Campanias_idCampania');
            //$crud->unset_add_fields('idImagenCampania');
            // Para el formulario edit
            //$crud->edit_fields('urlImagen', 'Campanias_idCampania');
            //$crud->unset_edit_fields('idImagenCampania');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('urlImagen', 'images/campañas/evidencia');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('urlImagen', 'Campanias_idCampania');

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

            /* Funcion de exportar a PDF */
            $crud->unset_pdf();
            //$crud->setPdfUrl('');

            /* Condiciones para los datos a listar */
            // $crud->where(campo, valor_condicion);

            /* Ordenamiento de los datos a listar */
            // $crud->order_by(campo, direccion);
            $crud->order_by('Campanias_idCampania', 'ASC');

            /* Renderizar la tabla */
            $output = $crud->render();

            /* Variables para perzonalizar las paginas */
            // Titulo
            $output->title = "cPanel | Campañas";
            // Clases para el menu lateral
            $output->activeAdopcion = "";
            $output->activeArbol = "";
            $output->activeCampania = "active";
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
            $output->seccion = "Evidencia";

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
            $this->load->view('backend/vw_campanias.php',(array)$output);
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