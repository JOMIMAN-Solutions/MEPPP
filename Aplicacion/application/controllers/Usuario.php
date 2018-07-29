<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con la funciones que permiter gestionar el módulo de Usuarios
* En esta clase se encuentrar metodos como:
*     - - __construct
*     - login
*     - perfil
*     - logout
*     - getSocios
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package application/controllers
*
* @version 1.0.0
* Creado el 14/06/2018 a las 10:28 pm
* Ultima modificacion el 29/07/2018 a las 05:46 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Realizar método para guardar,modificar y eliminar un usuario
*     - En la vista read deja ver el id (quitarlo) 
*/
class Usuario extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_Usuario');
	}

	/**
	* Método que realiza el proceso de logeo a un usuario registrado
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function login()
	{
        $this->form_validation->set_rules('user', 'Usuario', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('password', 'Contraseña', 
            'trim|required|min_length[4]|max_length[30]');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener mínimo %d caracteres.');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener máximo %d caracteres.');

        /**
        * Condicion que determina si las reglas del formulario login se corrompen o no
        * 
        */
        if ($this->form_validation->run() === false) {
            $data['title'] = ' MEPPP| Login';
            $data['err'] = 'bad rules';
            $data['page']="login";
            $data['seccion']="7";
            $data['imagen']="loginSeccion";
            //$this->load->view('template/frontend/header', $data);
            $this->cargarVista('vw_login', $data);
        } else {
        	$this->Mdl_Usuario->setUsuario($this->input->POST('user'));
       		$this->Mdl_Usuario->setContrasenia($this->input->POST('password'));
            $user = $this->Mdl_Usuario->login();

            /**
            * Condicion que determina si la consulta anterior obtuvo un usuario
            * 
            */
            if ($user != 0) {
                /**
                * Bucle que recorre el arreglo $user
                * El bucle asigna a la variable $datosUser el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($user as $datosUser) {}
                    $perfil = $this->Mdl_Usuario->getPerfil($datosUser->idUsuario);
                    /**
                    * Bucle que recorre el arreglo $user
                    * El bucle asigna a la variable $datosUser el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                    */
                    foreach ($perfil as $per) {}
                	$this->session->set_userdata('perfil', $per);
                
                
                redirect('Frontend/index');
            } else {
                $data['title'] = 'MEPPP| Login';
                $data['badUser'] = 'Inicio de sesión incorrecto!!!<br>';
                $data['page']="login";
                $data['seccion']="7";
                $data['imagen']="loginSeccion";
                //$this->load->view('template/frontend/header', $data);
                $this->cargarVista('vw_login', $data);
            }
        } 
	}

    /**
    * Este método crea una data con algunos datos importantes para transferir a la vista
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function perfil(){
        $data['title']="MEPPP | PERFIL DE USUARIO";
        $data['page']="perfil";
        $data['seccion']="8";
        $data['imagen']="perfilSeccion";

        $this->cargarVistaFront('vw_perfil',$data);  
    }

	/**
	* Método que realiza la función de cerrar sesión
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo nada
	*/
	public function logout() 
	{
        $this->session->unset_userdata('idUsuario');
        $this->session->sess_destroy();

        redirect('Frontend/index');
    }

    /**
    * Descripción corta del fichero (obligatoria, una línea)
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo [información]
    */
    public function getSocios()
    {
        $data['title'] = "MEPPP | Socios";
        $data['page'] = "Socios";
        $data['seccion'] = "3";
        $data['imagen'] = 'sociosSeccion';
        $data['socios'] = $this->Mdl_Usuario->getSocios();

        $this->cargarVistaFront('vw_socios', $data);
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
        $crud->set_subject('Usuario');

        /* Indicar con que tabla se trabajará */
        $crud->set_table('usuarios');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idUsuario' => 'ID',
            'nombreUsuario' => 'Nombre',
            'apePat' => 'Apellido paterno',
            'apeMat' => 'Apellido materno',
            'correo' => 'Correo'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'read' || $this->uri->segment(3) == 'success') {
            //$crud->set_relation('Administradores_idAdministrador','usuarios','{nombreusuario} {apePat} {apeMat}');
            //$crud->set_relation('SeccionesFaq_idSeccionFaq','secciones_faq','nombreSeccion');
        } else if ($this->uri->segment(3) == 'add') {
            //$crud->set_relation('SeccionesFaq_idSeccionFaq','secciones_faq','nombreSeccion');
        } else if ($this->uri->segment(3) == 'edit') {
            //$crud->set_relation('SeccionesFaq_idSeccionFaq','secciones_faq','nombreSeccion');
        }

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idUsuario','nombreUsuario', 'apePat', 'apeMat', 'correo');
        // Perzonalizado
        $crud->columns('nombreUsuario', 'apePat', 'apeMat', 'correo');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idUsuario');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idUsuario','nombreUsuario', 'apePat', 'apeMat', 'correo');
        // Perzonalizado
        //$crud->fields('nombreUsuario', 'apePat', 'apeMat', 'correo');
        // Para el formulario add
        //$crud->add_fields('nombreUsuario', 'apePat', 'apeMat', 'correo');
        $crud->unset_add_fields('idUsuario');
        // Para el formulario edit
        //$crud->edit_fields('nombreUsuario', 'apePat', 'apeMat', 'correo');
        $crud->unset_edit_fields('idUsuario');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        // Seccion titulos
        if ($this->uri->segment(3) == 'add') {
            //$crud->field_type('Administradores_idAdministrador', 'hidden', 1);
        } else if ($this->uri->segment(3) == 'edit') {
            
        }
        
        /* Habilitar un input como campos para subir archivos */
        // $crud->set_field_upload(campo, ruta_archivos);

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('nombreUsuario', 'apePat', 'apeMat', 'correo');

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
        $crud->order_by('nombreUsuario', 'ASC');

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Variables para perzonalizar las paginas */
        // Titulo
        $output->title = "cPanel | Usuarios";
        // Clases para el menu lateral
        $output->activeAdopcion = "";
        $output->activeArbol = "";
        $output->activeCampania = "";
        $output->activeComentario = "";
        $output->activeFaq = "";
        $output->activeUsuario = "active";
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
        $this->load->view('backend/vw_usuarios.php',(array)$output);
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
