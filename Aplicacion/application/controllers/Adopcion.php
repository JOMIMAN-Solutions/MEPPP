<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar el módulo de Adopciones
* En esta clase se encuentran métodos como:
*     - index
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.0
* Creado el 26/07/2018 a las 05:50 pm
* Ultima modificacion el 01/08/2018 a las 10:37 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Metodo cPanel: mostrar los estatus como texto y no numeros, ´poder visualizar lo que la persona adopto, en la vista read no carga nada en el campo estatus.
*/
class Adopcion extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        //$this->load->library('grocery_CRUD');
    }

    public function cPanel()
    {
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
            'estatusAdopcion' => 'Estatus',
            'Usuarios_idUsuario' => 'Usuario'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
        // set_relation_n_n(nombre_relacion, tabla_det, tabla3, pk_tabla_actual, pk_tabla3, campo_mostrar)
        $crud->set_relation_n_n('Adoptados', 'det_adopciones', 'arboles', 'idAdopcion', 'idArbol', '{nombreComun}');

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idAdopcion','fechaAdopcion', 'estatusAdopcion', 'Usuarios_idUsuario');
        // Perzonalizado
        $crud->columns('Usuarios_idUsuario', 'fechaAdopcion', 'estatusAdopcion');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idAdopcion');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idAdopcion','fechaAdopcion', 'estatusAdopcion', 'Usuarios_idUsuario');
        // Perzonalizado
        $crud->fields('fechaAdopcion', 'estatusAdopcion', 'Usuarios_idUsuario');
        // Para el formulario add
        //$crud->add_fields('fechaAdopcion', 'estatusAdopcion', 'Usuarios_idUsuario', 'Adoptados');
        //$crud->unset_add_fields('idAdopcion');
        // Para el formulario edit
        //$crud->edit_fields('fechaAdopcion', 'estatusAdopcion');
        //$crud->unset_edit_fields('idAdopcion', 'Usuarios_idUsuario');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        $crud->field_type('fechaAdopcion','readonly');
        $crud->field_type('estatusAdopcion','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
        $crud->field_type('Usuarios_idUsuario','readonly');
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('fechaAdopcion', 'estatusAdopcion', 'UsuariosRegistrados_idUsuarioRegistrado');

        /* Establecer las reglas de los formularios */
        // $crud->set_rules(campo, label, rule);

        /* Ordenamiento de los datos a listar */
        // $crud->order_by(campo, direccion);
        $crud->order_by('fechaAdopcion', 'ASC');

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
        $this->load->view('backend/vw_adopciones.php',(array)$output);
        $this->load->view('template/backend/footer',(array)$output);
    }
}