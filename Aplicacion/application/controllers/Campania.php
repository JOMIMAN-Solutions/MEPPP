<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con métodos que permiten gestionar el módulo de Campañas
* En esta clase se encuentran métodos como:
*     - index()
*
* @autor Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0
* Creado el 15/06/2018 a las 10:05 am
* Ultima modificacion el 29/07/2018 a las 05:43 pm
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo Métodos para...
*     - Agregar campañas
*     - Cancelar campañas
*     - Obetener campañas para el calendario
*     - Obetener los datos de una campaña en especifico
*     - Mostrar los estatus como letras, revisar los valores de estatus que una campaña puede tomar para ponerlas en el select.
*/
class Campania extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Campania');
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

    public function cPanel()
    {
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
            'Administradores_idAdministrador' => 'Adminitrador',
            'TiposCampania_idTipoCampania' => 'Tipo de campaña'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'read' || $this->uri->segment(3) == 'success') {
            $crud->set_relation('Administradores_idAdministrador','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposCampania_idTipoCampania','tipos_campania','tipoCampania');
        } else if ($this->uri->segment(3) == 'add') {
            $crud->set_relation('Administradores_idAdministrador','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposCampania_idTipoCampania','tipos_campania','tipoCampania');
        } else if ($this->uri->segment(3) == 'edit') {
            $crud->set_relation('Administradores_idAdministrador','usuarios','{nombreusuario} {apePat} {apeMat}');
            $crud->set_relation('TiposCampania_idTipoCampania','tipos_campania','tipoCampania');
        }

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idCampania', 'imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Administradores_idAdministrador', 'TiposCampania_idTipoCampania');
        // Perzonalizado
        $crud->columns('imagenPortada', 'nombreCampania', 'fechaInicio', 'TiposCampania_idTipoCampania', 'estatusCampania');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idCampania', 'fechaFin', 'lugar', 'hora', 'publico', 'Administradores_idAdministrador');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idCampania', 'imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Administradores_idAdministrador', 'TiposCampania_idTipoCampania');
        // Perzonalizado
        //$crud->fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Administradores_idAdministrador', 'TiposCampania_idTipoCampania');
        // Para el formulario add
        //$crud->add_fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Administradores_idAdministrador', 'TiposCampania_idTipoCampania');
        $crud->unset_add_fields('idCampania');
        // Para el formulario edit
        //$crud->edit_fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Administradores_idAdministrador', 'TiposCampania_idTipoCampania');
        $crud->unset_edit_fields('idCampania', 'Administradores_idAdministrador');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        // Seccion titulos
        if ($this->uri->segment(3) == 'add') {
            $crud->field_type('estatusCampania','dropdown', array('0' => 'Cancelada', '1' => 'Realizada', '2' => 'Pospuesta'));
            //$crud->field_type('Administradores_idAdministrador', 'hidden', 1);
        } else if ($this->uri->segment(3) == 'edit') {
            $crud->field_type('estatusCampania','dropdown', array('0' => 'Cancelada', '1' => 'Realizada', '2' => 'Pospuesta'));
        }
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);
        $crud->set_field_upload('imagenPortada', 'images/campañas');

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('imagenPortada', 'nombreCampania', 'fechaInicio', 'fechaFin', 'hora', 'lugar', 'publico', 'estatusCampania', 'Administradores_idAdministrador', 'TiposCampania_idTipoCampania');

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
        $this->load->view('backend/vw_campanias.php',(array)$output);
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