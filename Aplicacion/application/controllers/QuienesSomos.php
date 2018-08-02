<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar datos de la empresa
* Con esta clase los administradores podran gestionar datos como: mision, vision, valores, y datos como telefonos, correo y direccion de la asociación
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.0
* Creado el 01/08/2018 a las 01:49 pm
* Ultima modificacion el 01/08/2018 a las 011:18 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Nada
*/
class QuienesSomos extends CI_Controller 
{
	function __construct() {
        parent::__construct();
    }

    public function cPanel_Datos()
    {
    	/* Cargar la libreria */
        $this->load->library('grocery_CRUD');

        /* Instanciar un objeto de grocery crud */
        $crud = new grocery_CRUD();

        /* Establecer el tema */
        $crud->set_theme('bootstrap-v4');

        /* Indicar el "objeto" que estaremos manejando */
        $crud->set_subject('Datos');

        /* Indicar con que tabla se trabajará */
        $crud->set_table('quienes_somos');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idQuienesSomos' => 'ID',
            'telefono1' => 'Teléfono 1',
            'telefono2' => 'Teléfono 2',
            'correoEmpresa' => 'Correo',
            'mision' => 'Misión',
            'vision' => 'Visión',
            'Usuarios_idUsuario' => 'Usuario'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        if ($this->uri->segment(3) == 'add') {
        } else {
            $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreUsuario} {apePat} {apeMat}');
        }
        // set_relation_n_n(nombre_relacion, tabla_det, tabla3, pk_tabla_actual, pk_tabla3, campo_mostrar)

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idQuienesSomos','telefono1', 'telefono2', 'correoEmpresa', 'mision', 'vision', 'Usuarios_idUsuario');
        // Perzonalizado
        $crud->columns('telefono1', 'telefono2', 'correoEmpresa', 'mision', 'vision');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idQuienesSomos');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idQuienesSomos','telefono1', 'telefono2', 'correoEmpresa', 'mision', 'vision', 'Usuarios_idUsuario');
        // Perzonalizado
        $crud->fields('telefono1', 'telefono2', 'correoEmpresa', 'mision', 'vision', 'Usuarios_idUsuario');
        // Para el formulario add
        //$crud->add_fields('telefono1', 'telefono2', 'correoEmpresa', 'mision', 'vision', 'Usuarios_idUsuario');
        //$crud->unset_add_fields('idQuienesSomos');
        // Para el formulario edit
        //$crud->edit_fields('telefono1', 'telefono2', 'correoEmpresa', 'mision', 'vision', 'Usuarios_idUsuario');
        //$crud->unset_edit_fields('idQuienesSomos');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        if ($this->uri->segment(3) == 'add' || $this->uri->segment(3) == 'edit') {
            $crud->field_type('Usuarios_idUsuario', 'hidden', 1);
        }
        
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('telefono1', 'correoEmpresa', 'mision', 'vision');

        /* Establecer las reglas de los formularios */
        // $crud->set_rules(campo, label, rule);
        $crud->set_rules('telefono1', 'Teléfono 1', 'trim|required');
        $crud->set_rules('telefono2', 'Teléfono 2', 'trim');
        $crud->set_rules('correoEmpresa', 'Correo', 'trim|required|valid_email');
        $crud->set_rules('mision', 'Misión', 'trim|required');
        $crud->set_rules('vision', 'Visión', 'trim|required');

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
        $crud->unset_texteditor('mision', 'full_text');
        $crud->unset_texteditor('vision', 'full_text');

        /* Condiciones para los datos a listar */
        // $crud->where(campo, valor_condicion);

        /* Ordenamiento de los datos a listar */
        // $crud->order_by(campo, direccion);

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Variables para perzonalizar las paginas */
        // Titulo
        $output->title = "cPanel | ¿Quiénes somos?";
        // Clases para el menu lateral
        $output->activeAdopcion = "";
        $output->activeArbol = "";
        $output->activeCampania = "";
        $output->activeComentario = "";
        $output->activeFaq = "";
        $output->activeUsuario = "";
        $output->activeQuienesSomos = "active";
        // Seccion titulos
        $output->seccion = "Datos";
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
        $this->load->view('backend/vw_quienes_somos.php',(array)$output);
        $this->load->view('template/backend/footer',(array)$output);
    }

    public function cPanel_Valores()
    {
        /* Cargar la libreria */
        $this->load->library('grocery_CRUD');

        /* Instanciar un objeto de grocery crud */
        $crud = new grocery_CRUD();

        /* Establecer el tema */
        $crud->set_theme('bootstrap-v4');

        /* Indicar el "objeto" que estaremos manejando */
        $crud->set_subject('Valor');

        /* Indicar con que tabla se trabajará */
        $crud->set_table('valores');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idValor' => 'ID',
            'nombrevalor' => 'Nombre',
            'descripcionValor' => 'Descripción',
            'Usuarios_idUsuario' => 'Usuario'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        $crud->set_relation('Usuarios_idUsuario','usuarios','{nombreusuario} {apePat} {apeMat}');
        // set_relation_n_n(nombre_relacion, tabla_det, tabla3, pk_tabla_actual, pk_tabla3, campo_mostrar)

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idValor', 'nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');
        // Perzonalizado
        $crud->columns('nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idValor');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idValor', 'nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');
        // Perzonalizado
        $crud->fields('nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');
        // Para el formulario add
        //$crud->add_fields('nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');
        //$crud->unset_add_fields('idValor');
        // Para el formulario edit
        //$crud->edit_fields('nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');
        //$crud->unset_edit_fields('idValor');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('nombrevalor', 'descripcionValor', 'Usuarios_idUsuario');

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
        $crud->order_by('nombreValor', 'ASC');

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Variables para perzonalizar las paginas */
        // Titulo
        $output->title = "cPanel | Valores";
        // Clases para el menu lateral
        $output->activeAdopcion = "";
        $output->activeArbol = "";
        $output->activeCampania = "";
        $output->activeComentario = "";
        $output->activeFaq = "";
        $output->activeUsuario = "";
        $output->activeQuienesSomos = "active";
        // Seccion titulos
        $output->seccion = "Valores";
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
        $this->load->view('backend/vw_quienes_somos.php',(array)$output);
        $this->load->view('template/backend/footer',(array)$output);
    }
}