<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con la funciones que permiter gestionar el módulo de Usuarios
* En esta clase se encuentrar metodos como:
*     - __construct
*     - login
*     - perfil
*     - logout
*     - getSocios
*     - admin
*     - miembros
*     - socios
*     - representantes
*     - general
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package application/controllers
*
* @version 1.0.1
* Creado el 14/06/2018 a las 10:28 pm
* Ultima modificacion el 04/08/2018 a las 08:16 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Revisar metodos
*/
class Usuario extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mdl_Usuario');
        $this->load->model('Mdl_Comentario');
        $this->load->model('Mdl_QuienesSomos');
	}

	/**
	* Método que realiza el proceso de logeo a un usuario registrado
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0.0
	* @deprecated Método obsoleto en la versión 2.0.0
	* @todo Nada
	*/
	public function login()
	{
        $this->form_validation->set_rules('user', 'Usuario', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('password', 'Contraseña', 
            'trim|required|min_length[4]|max_length[50]');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener mínimo %d caracteres.');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener máximo %d caracteres.');

        /**
        * Condicion que determina si las reglas del formulario login se corrompen o no
        * 
        */
        if ($this->form_validation->run() === false) {
            /**
            * Condicion que determina si se recibio por medio de POST un campo con nombre where
            * 
            */
            if ($this->input->POST('where')) {
                    $data['title'] = "MEPPP | Comentarios";
                    $data['err'] = 'bad rules';
                    $data['page'] = "Comentarios";
                    $data['seccion'] = "4";
                    $data['imagen'] = 'comentariosSeccion';
                    $data['comentarios'] = $this->Mdl_Comentario->getRecent();
                    $this->cargarVistaFront('vw_comentarios', $data);
                }else{
                    $data['title'] = 'MEPPP| Login';
                    $data['badUser'] = 5;
                    $data['page']="login";
                    $data['seccion']="7";
                    $data['imagen']="loginSeccion";
                    $this->cargarVistaFront('vw_login', $data);
                }
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
                * El bucle asigna a la variable $u el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($user as $u){}
                $tipo = $u->TiposUsuario_idTipoUsuario;

                $perfil = $this->Mdl_Usuario->getPerfil($u->idUsuario);
                /**
                * Bucle que recorre el arreglo $user
                * El bucle asigna a la variable $per el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                */
                foreach ($perfil as $per) {}
                $this->session->set_userdata('perfil', $per);

                /**
                * Verefificar entre un administrador y cualquier otro usuario
                */
                if ($u->privilegios == 'Usuario general' && $u->estatusUsuario == 'Activo' && ($tipo == 2 || $tipo == 3 || $tipo == 4 || $tipo == 5)) {
                    /**
                    * Verificar si el carrito contiene items
                    * En el caso de que asi sea, se le mandara a la pagina de inverndaero. De lo contrario se manda a la pagina de inicio.
                    */

                    if ($this->cart->contents()) {
                        redirect('Arbol/index');
                    /**
                    * Condicion que determina si se recibio por medio de POST un campo con nombre where
                    * 
                    */
                    } else if ($this->input->POST('where')) {
                        redirect('Comentario/index');
                    } else {
                        redirect('Frontend/index');
                    }

                /**
                * Verificar si es administrador
                */
                } else if ($u->privilegios == 'Súper' || $u->privilegios == 'Administrador'  && $u->estatusUsuario == 'Activo' && $tipo == 1) {
                    $this->session->set_userdata('idAdmin', $u->idUsuario);

                    redirect('Adopcion/cPanel');
                }
            } else {
                /**
                * Condicion que determina si se recibio por medio de POST un campo con nombre where
                * 
                */
                if ($this->input->POST('where')) {
                    $data['title'] = "MEPPP | Comentarios";
                    $data['badUser'] = 'Inicio de sesión incorrecto!!!<br>';
                    $data['page'] = "Comentarios";
                    $data['seccion'] = "4";
                    $data['imagen'] = 'comentariosSeccion';
                    $data['comentarios'] = $this->Mdl_Comentario->getRecent();
                    $this->cargarVistaFront('vw_comentarios', $data);
                }else{
                    $data['title'] = 'MEPPP| Login';
                    $data['badUser'] = 5;
                    $data['page']="login";
                    $data['seccion']="7";
                    $data['imagen']="loginSeccion";
                    $this->cargarVistaFront('vw_login', $data);
                }
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
    * @since Método disponible desde la versión 1.0.0
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function perfil() {
        /**
        * Verificar que exista sesion de un usuario
        */
        if ($this->session->has_userdata('perfil')) {
            $data['title']="MEPPP | Perfil de usuario";
            $data['page']="perfil";
            $data['seccion']="8";
            $data['imagen']="perfilSeccion";

            $this->cargarVistaFront('vw_perfil',$data);  
        } else {
            redirect('Frontend/login');
        }
    }

    /**
    * Este método permite insertar un usuario desde el frontend
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0.0
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function insertUser(){
        $this->form_validation->set_rules('nombreUsuario', 'Nombre', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('apeMat', 'Apellido Materno', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('apePat', 'Apellido Paterno', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('correoUsuario', 'Correo', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('calle', 'Calle', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('colonia', 'Colonia', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('numero', 'Numero', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('cp', 'Código postal', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|max_length[50]');
        /**
        * Condicion que determina si hubo post por parte del campo organización pra añadirle reglas.
        * 
        */
        if ($this->input->POST('organizacion')) {
           $this->form_validation->set_rules('organizacion', 'Organizacion', 'trim|required|max_length[100]'); 
           $organizacion = $this->input->POST('organizacion');
           $re = 1;
        }else{
            $organizacion = " ";
            $re = 0;
        }
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('trim','El campo %s no puede quedar vacio');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener máximo %d caracteres.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo %d caracteres.');

        //Imagen
        $config['upload_path'] = 'images/usuarios/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
  
        /**
        * Condicion que determina si las reglas no se cumplieron
        * 
        */
        if ($this->form_validation->run() === false){
                $data['title'] = 'MEPPP| Login';
                $data['badUser'] = 4;
                $data['page']="login";
                $data['seccion']="7";
                $data['imagen']="loginSeccion";
                $this->cargarVistaFront('vw_login', $data);
        }else{

            /**
            * Condicion que determina si la imagen que se subio cumplio con los requisitos.
            * 
            */
            if (!$this->upload->do_upload('avatar')) {
                    $data['title'] = 'MEPPP| Login';
                    $data['badUser'] = 7;
                    $data['page']="login";
                    $data['seccion']="7";
                    $data['imagen']="loginSeccion";
                    $this->cargarVistaFront('vw_login', $data);
            }else{
                    $data = array('upload_data' => $this->upload->data());
                    $img_full_path = $config['upload_path'] . $data['upload_data']['file_name'];

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $img_full_path;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 215;
                    $config['height'] = 215;
                    $config['quality'] = 100;
                    $config['new_image'] = 'images/usuarios/'. $data['upload_data']['file_name'];
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }


            $usuario = array(
                'avatar' => $data['upload_data']['file_name'],
                'nombreUsuario' => $this->input->POST('nombreUsuario'),
                'apePat' => $this->input->POST('apePat'),
                'apeMat' => $this->input->POST('apeMat'),
                'correoUsuario' => $this->input->POST('correoUsuario'),
                'organizacion' => $organizacion,
                'usuario' => $this->input->POST('usuario'),
                'contrasenia' => $this->input->POST('contrasenia'),
                'privilegios' => "Usuario general",
                'estatusUsuario' => "Activo"
            );

            $inicio = 0;$fin    = 3;
            $lada = substr($this->input->POST('telefono'),$inicio,$fin);
            $inicio = 3;$fin    = 9;
            $tel = substr($this->input->POST('telefono'),$inicio,$fin);
            $telefono = array(
                'lada' => $lada,
                'telefono' => $tel
            );

            $direccion = array(
                'calle' => $this->input->POST('calle'),
                'numero' => $this->input->POST('numero')
            );

            $colonia = array(
                'colonia' => $this->input->POST('colonia'),
                'cp' => $this->input->POST('cp')
            );
            $ciudad = array(
                'ciudad' => $this->input->POST('ciudad')
            );

            $this->Mdl_Usuario->insert($ciudad,$colonia,$direccion,$telefono,$usuario,$re);   
            redirect('Frontend/login', 'refresh');
            }
        } 
    }





    /**
    * Este método permite modificar un usuario
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0.0
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function updateUser(){

        $this->form_validation->set_rules('nombreUsuario', 'Nombre', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('apeMat', 'Apellido Materno', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('apePat', 'Apellido Paterno', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|max_length[10]|min_length[10]');
        $this->form_validation->set_rules('correoUsuario', 'Correo', 'trim|required|max_length[80]');
        $this->form_validation->set_rules('calle', 'Calle', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('colonia', 'Colonia', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('numero', 'Numero', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('cp', 'Código postal', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|max_length[50]');
        /**
        * Condicion que determina si hubo post por parte del campo organización pra añadirle reglas.
        * 
        */
        if ($this->input->POST('organizacion')) {
           $this->form_validation->set_rules('organizacion', 'Organizacion', 'trim|required|max_length[100]'); 
           $organizacion = $this->input->POST('organizacion');
           $re = 1;
        }else{
            $organizacion = " ";
            $re = 0;
        }
       
        $this->form_validation->set_message('required', 'El campo %s es obligatorio.');
        $this->form_validation->set_message('trim','El campo %s no puede quedar vacio');
        $this->form_validation->set_message('max_length', 'El campo %s debe tener máximo %d caracteres.');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo %d caracteres.');

        //Imagen
        $config['upload_path'] = 'images/usuarios/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
  
        /**
        * Condicion que determina si las reglas no se cumplieron
        * 
        */
        if ($this->form_validation->run() === false){
                $data['title']="MEPPP | Perfil de usuario";
                $data['page']="perfil";
                $data['seccion']="8";
                $data['title'] = 'MEPPP| Perfil';
                $data['badUser'] = 4;
                $data['imagen']="perfilSeccion";
                $this->cargarVistaFront('vw_perfil', $data);

        }else{

            /**
            * Condicion que determina si el campo avatar viene vacio.
            * 
            */
            if ($_FILES['avatar']['name']!= null) {
                /**
                * Condicion que determina si la imagen que se subio cumplio con los requisitos.
                * 
                */
                if (!$this->upload->do_upload('avatar')) {

                    $data['title']="MEPPP | Perfil de usuario";
                    $data['page']="perfil";
                    $data['seccion']="8";
                    $data['title'] = 'MEPPP| Perfil';
                    $data['badUser'] = 7;
                    $data['imagen']="perfilSeccion";
                    $this->cargarVistaFront('vw_perfil', $data);  
                }else{
                    $data = array('upload_data' => $this->upload->data());
                    $img_full_path = $config['upload_path'] . $data['upload_data']['file_name'];

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $img_full_path;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 215;
                    $config['height'] = 215;
                    $config['quality'] = 100;
                    $config['new_image'] = 'images/usuarios/'. $data['upload_data']['file_name'];
                    $this->load->library('image_lib', $config);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    }

                    $usuario = array(
                        'avatar' => $data['upload_data']['file_name'],
                        'nombreUsuario' => $this->input->POST('nombreUsuario'),
                        'apePat' => $this->input->POST('apePat'),
                        'apeMat' => $this->input->POST('apeMat'),
                        'correoUsuario' => $this->input->POST('correoUsuario'),
                        'organizacion' => $organizacion,
                        'usuario' => $this->input->POST('usuario'),
                        'contrasenia' => $this->input->POST('contrasenia'),
                        'privilegios' => "Usuario general",
                        'estatusUsuario' => "Activo"
                    );

                    $inicio = 0;$fin    = 3;
                    $lada = substr($this->input->POST('telefono'),$inicio,$fin);
                    $inicio = 3;$fin    = 9;
                    $tel = substr($this->input->POST('telefono'),$inicio,$fin);
                    $telefono = array(
                        'lada' => $lada,
                        'telefono' => $tel
                    );

                    $direccion = array(
                        'calle' => $this->input->POST('calle'),
                        'numero' => $this->input->POST('numero')
                    );

                    $colonia = array(
                        'colonia' => $this->input->POST('colonia'),
                        'cp' => $this->input->POST('cp')
                    );
                    $ciudad = array(
                        'ciudad' => $this->input->POST('ciudad')
                    );

                    $this->Mdl_Usuario->update($ciudad,$colonia,$direccion,$telefono,$usuario,$re);
                    $perfil = $this->Mdl_Usuario->getPerfil($this->session->userdata('perfil')->idUsuario);
                            /**
                            * Bucle que recorre el arreglo $user
                            * El bucle asigna a la variable $datosUser el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                            */
                            foreach ($perfil as $per) {}
                            $this->session->set_userdata('perfil', $per);
                        $data['title']="MEPPP | Perfil de usuario";
                        $data['page']="perfil";
                        $data['seccion']="8";
                        $data['title'] = 'MEPPP| Perfil';
                        $data['goodChanges'] = 1;
                        $data['imagen']="perfilSeccion";
                        $this->cargarVistaFront('vw_perfil', $data);

                }
            }else{

            $usuario = array(
                'avatar' => $this->session->userdata('perfil')->avatar,
                'nombreUsuario' => $this->input->POST('nombreUsuario'),
                'apePat' => $this->input->POST('apePat'),
                'apeMat' => $this->input->POST('apeMat'),
                'correoUsuario' => $this->input->POST('correoUsuario'),
                'organizacion' => $organizacion,
                'usuario' => $this->input->POST('usuario'),
                'contrasenia' => $this->input->POST('contrasenia'),
                'privilegios' => "Usuario general",
                'estatusUsuario' => "Activo"
            );

            $inicio = 0;$fin    = 3;
            $lada = substr($this->input->POST('telefono'),$inicio,$fin);
            $inicio = 3;$fin    = 9;
            $tel = substr($this->input->POST('telefono'),$inicio,$fin);
            $telefono = array(
                'lada' => $lada,
                'telefono' => $tel
            );

            $direccion = array(
                'calle' => $this->input->POST('calle'),
                'numero' => $this->input->POST('numero')
            );

            $colonia = array(
                'colonia' => $this->input->POST('colonia'),
                'cp' => $this->input->POST('cp')
            );
            $ciudad = array(
                'ciudad' => $this->input->POST('ciudad')
            );

            $this->Mdl_Usuario->update($ciudad,$colonia,$direccion,$telefono,$usuario,$re);
            $perfil = $this->Mdl_Usuario->getPerfil($this->session->userdata('perfil')->idUsuario);
                    /**
                    * Bucle que recorre el arreglo $user
                    * El bucle asigna a la variable $datosUser el valor del elemento actual que está reccoriendo en ese momento, en la siguiente iteración devolverá el siguiente valor.
                    */
                    foreach ($perfil as $per) {}
                    $this->session->set_userdata('perfil', $per);
                $data['title']="MEPPP | Perfil de usuario";
                $data['page']="perfil";
                $data['seccion']="8";
                $data['title'] = 'MEPPP| Perfil';
                $data['goodChanges'] = 1;
                $data['imagen']="perfilSeccion";
                $this->cargarVistaFront('vw_perfil', $data);

            }
        } 
    }




	/**
	* Método que realiza la función de cerrar sesión
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0.0
	* @deprecated Método obsoleto en la versión 2.0.0
	* @todo Hacer que funcione para los usuarios back y revisar que borre las sesiones correctas del front
	*/
	public function logout() 
	{
        $this->session->unset_userdata('idAdmin');
        $this->session->unset_userdata('perfil');
        $this->session->sess_destroy();

        redirect('Frontend/index');
    }

    /**
    * Método que obtiene los socios de la asociación.
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0.0
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Revisar la consulta por los cambios en la bd
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

    /**
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Usuarios
    * En particular poder gestionar los usuarios de tipo "Administrador".
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function admin()
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
            $crud->set_subject('Administrador');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('usuarios');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idUsuario' => 'ID',
                'avatar' => 'Avatar',
                'nombreUsuario' => 'Nombre',
                'apePat' => 'Apellido paterno',
                'apeMat' => 'Apellido materno',
                'correoUsuario' => 'Correo',
                'organizacion' => 'Organización',
                'usuario' => 'Usuario',
                'contrasenia' => 'Contraseña',
                'privilegios' => 'Privilegios',
                'estatusUsuario' => 'Estatus',
                'Telefonos_idTelefono' => 'Teléfono',
                'Direcciones_idDireccion' => 'Dirección',
                'TiposUsuario_idTipoUsuario' => 'Tipo de usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Telefonos_idTelefono','telefonos','{lada}-{telefono}');
            $crud->set_relation('Direcciones_idDireccion','direcciones','{calle} #{numero}');
            $crud->set_relation('TiposUsuario_idTipoUsuario','tipos_usuario','tipoUsuario');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->columns('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'estatusUsuario');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');
            // Para el formulario add
            //$crud->add_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_add_fields('idUsuario');
            // Para el formulario edit
            //$crud->edit_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_edit_fields('idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina si esta en la pagina de editar, para establecer un tipo de campo especifico para esta sección.
            */
            if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('avatar', 'readonly');
            }
            $crud->field_type('nombreUsuario', 'readonly');
            $crud->field_type('apePat', 'readonly');
            $crud->field_type('apeMat', 'readonly');
            $crud->field_type('correoUsuario', 'readonly');
            $crud->field_type('organizacion', 'readonly');
            $crud->field_type('usuario', 'hidden');
            $crud->field_type('contrasenia', 'hidden');
            $crud->field_type('privilegios','dropdown', array('Administrador' => 'Administrador', 'Usuario general' => 'Usuario general'));
            $crud->field_type('estatusUsuario','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('avatar', 'images/usuarios');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
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
            $condiciones = array(
                'TiposUsuario_idTipoUsuario' => 1,
                'privilegios' => 'Administrador'
            );
            $crud->where($condiciones);

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
            //Imagen y nombre del administrador
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            $output->seccion = "Administradores";

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
            $this->load->view('backend/vw_usuarios.php',(array)$output);
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
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Usuarios
    * En particular poder gestionar los usuarios de tipo "Miembro".
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function miembros()
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
            $crud->set_subject('Miembro');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('usuarios');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idUsuario' => 'ID',
                'avatar' => 'Avatar',
                'nombreUsuario' => 'Nombre',
                'apePat' => 'Apellido paterno',
                'apeMat' => 'Apellido materno',
                'correoUsuario' => 'Correo',
                'organizacion' => 'Organización',
                'usuario' => 'Usuario',
                'contrasenia' => 'Contraseña',
                'privilegios' => 'Privilegios',
                'estatusUsuario' => 'Estatus',
                'Telefonos_idTelefono' => 'Teléfono',
                'Direcciones_idDireccion' => 'Dirección',
                'TiposUsuario_idTipoUsuario' => 'Tipo de usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Telefonos_idTelefono','telefonos','{lada}-{telefono}');
            $crud->set_relation('Direcciones_idDireccion','direcciones','{calle} #{numero}');
            $crud->set_relation('TiposUsuario_idTipoUsuario','tipos_usuario','tipoUsuario');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->columns('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'estatusUsuario');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');
            // Para el formulario add
            //$crud->add_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_add_fields('idUsuario');
            // Para el formulario edit
            //$crud->edit_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_edit_fields('idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina si esta en la pagina de editar, para establecer un tipo de campo especifico para esta sección.
            */
            if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('avatar', 'readonly');
            }
            $crud->field_type('nombreUsuario', 'readonly');
            $crud->field_type('apePat', 'readonly');
            $crud->field_type('apeMat', 'readonly');
            $crud->field_type('correoUsuario', 'readonly');
            $crud->field_type('organizacion', 'readonly');
            $crud->field_type('usuario', 'hidden');
            $crud->field_type('contrasenia', 'hidden');
            $crud->field_type('privilegios','dropdown', array('Administrador' => 'Administrador', 'Usuario general' => 'Usuario general'));
            $crud->field_type('estatusUsuario','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('avatar', 'images/usuarios');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
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
            $condiciones = array(
                'TiposUsuario_idTipoUsuario' => 4,
                'privilegios' => 'Usuario general'
            );
            $crud->where($condiciones);

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
            //Imagen y nombre del administrador
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            $output->seccion = "Miembros";

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
            $this->load->view('backend/vw_usuarios.php',(array)$output);
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
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Usuarios
    * En particular poder gestionar los usuarios de tipo "Socio".
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function socios()
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
            $crud->set_subject('Socio');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('usuarios');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idUsuario' => 'ID',
                'avatar' => 'Avatar',
                'nombreUsuario' => 'Nombre',
                'apePat' => 'Apellido paterno',
                'apeMat' => 'Apellido materno',
                'correoUsuario' => 'Correo',
                'organizacion' => 'Organización',
                'usuario' => 'Usuario',
                'contrasenia' => 'Contraseña',
                'privilegios' => 'Privilegios',
                'estatusUsuario' => 'Estatus',
                'Telefonos_idTelefono' => 'Teléfono',
                'Direcciones_idDireccion' => 'Dirección',
                'TiposUsuario_idTipoUsuario' => 'Tipo de usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Telefonos_idTelefono','telefonos','{lada}-{telefono}');
            $crud->set_relation('Direcciones_idDireccion','direcciones','{calle} #{numero}');
            $crud->set_relation('TiposUsuario_idTipoUsuario','tipos_usuario','tipoUsuario');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->columns('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'estatusUsuario');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');
            // Para el formulario add
            //$crud->add_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_add_fields('idUsuario');
            // Para el formulario edit
            //$crud->edit_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_edit_fields('idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina si esta en la pagina de editar, para establecer un tipo de campo especifico para esta sección.
            */
            if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('avatar', 'readonly');
            }
            $crud->field_type('nombreUsuario', 'readonly');
            $crud->field_type('apePat', 'readonly');
            $crud->field_type('apeMat', 'readonly');
            $crud->field_type('correoUsuario', 'readonly');
            $crud->field_type('organizacion', 'readonly');
            $crud->field_type('usuario', 'hidden');
            $crud->field_type('contrasenia', 'hidden');
            $crud->field_type('privilegios','dropdown', array('Administrador' => 'Administrador', 'Usuario general' => 'Usuario general'));
            $crud->field_type('estatusUsuario','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('avatar', 'images/usuarios');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
            //$crud->unset_edit();
            //$crud->unset_read();
            $crud->unset_delete();
            //$crud->unset_print();
            //$crud->unset_export();
            //$crud->unset_operations();
            //$crud->unset_back_to_list();
            //$crud->unset_texteditor(campo, 'full_text');

            /* Funcion de exportar a PDF */

            /**
            * Validar si existen socios
            * Si no existen deshabilita la funcion de exportar a pdf
            */
            $usuarios = $this->Mdl_Usuario->getSocios();
            if ($usuarios == 0) {
                $crud->unset_pdf();
            } else {
                $crud->setPdfUrl('Usuario/pdf/socios');
            }

            /* Condiciones para los datos a listar */
            // $crud->where(campo, valor_condicion);
            $condiciones = array(
                'TiposUsuario_idTipoUsuario' => 5,
                'privilegios' => 'Usuario general'
            );
            $crud->where($condiciones);

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
            //Imagen y nombre del administrador
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            $output->seccion = "Socios";

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
            $this->load->view('backend/vw_usuarios.php',(array)$output);
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
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Usuarios
    * En particular poder gestionar los usuarios de tipo "Representante".
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function representantes()
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
            $crud->set_subject('Representante');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('usuarios');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idUsuario' => 'ID',
                'avatar' => 'Avatar',
                'nombreUsuario' => 'Nombre',
                'apePat' => 'Apellido paterno',
                'apeMat' => 'Apellido materno',
                'correoUsuario' => 'Correo',
                'organizacion' => 'Organización',
                'usuario' => 'Usuario',
                'contrasenia' => 'Contraseña',
                'privilegios' => 'Privilegios',
                'estatusUsuario' => 'Estatus',
                'Telefonos_idTelefono' => 'Teléfono',
                'Direcciones_idDireccion' => 'Dirección',
                'TiposUsuario_idTipoUsuario' => 'Tipo de usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Telefonos_idTelefono','telefonos','{lada}-{telefono}');
            $crud->set_relation('Direcciones_idDireccion','direcciones','{calle} #{numero}');
            $crud->set_relation('TiposUsuario_idTipoUsuario','tipos_usuario','tipoUsuario');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->columns('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'estatusUsuario');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');
            // Para el formulario add
            //$crud->add_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_add_fields('idUsuario');
            // Para el formulario edit
            //$crud->edit_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_edit_fields('idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina si esta en la pagina de editar, para establecer un tipo de campo especifico para esta sección.
            */
            if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('avatar', 'readonly');
            }
            $crud->field_type('nombreUsuario', 'readonly');
            $crud->field_type('apePat', 'readonly');
            $crud->field_type('apeMat', 'readonly');
            $crud->field_type('correoUsuario', 'readonly');
            $crud->field_type('organizacion', 'readonly');
            $crud->field_type('usuario', 'hidden');
            $crud->field_type('contrasenia', 'hidden');
            $crud->field_type('privilegios','dropdown', array('Administrador' => 'Administrador', 'Usuario general' => 'Usuario general'));
            $crud->field_type('estatusUsuario','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('avatar', 'images/usuarios');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
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
            $condiciones = array(
                'TiposUsuario_idTipoUsuario' => 3,
                'privilegios' => 'Usuario general'
            );
            $crud->where($condiciones);

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
            //Imagen y nombre del administrador
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            $output->seccion = "Representantes";

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
            $this->load->view('backend/vw_usuarios.php',(array)$output);
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
    * Método con las propiedades de configuración de Grocery CRUD en el modulo Usuarios
    * En particular poder gestionar los usuarios de tipo "Usuario general".
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function general()
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
            $crud->set_subject('Usuario general');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('usuarios');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idUsuario' => 'ID',
                'avatar' => 'Avatar',
                'nombreUsuario' => 'Nombre',
                'apePat' => 'Apellido paterno',
                'apeMat' => 'Apellido materno',
                'correoUsuario' => 'Correo',
                'organizacion' => 'Organización',
                'usuario' => 'Usuario',
                'contrasenia' => 'Contraseña',
                'privilegios' => 'Privilegios',
                'estatusUsuario' => 'Estatus',
                'Telefonos_idTelefono' => 'Teléfono',
                'Direcciones_idDireccion' => 'Dirección',
                'TiposUsuario_idTipoUsuario' => 'Tipo de usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Telefonos_idTelefono','telefonos','{lada}-{telefono}');
            $crud->set_relation('Direcciones_idDireccion','direcciones','{calle} #{numero}');
            $crud->set_relation('TiposUsuario_idTipoUsuario','tipos_usuario','tipoUsuario');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->columns('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'estatusUsuario');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');
            // Para el formulario add
            //$crud->add_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_add_fields('idUsuario');
            // Para el formulario edit
            //$crud->edit_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_edit_fields('idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina si esta en la pagina de editar, para establecer un tipo de campo especifico para esta sección. 
            */
            if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('avatar', 'readonly');
            }
            $crud->field_type('nombreUsuario', 'readonly');
            $crud->field_type('apePat', 'readonly');
            $crud->field_type('apeMat', 'readonly');
            $crud->field_type('correoUsuario', 'readonly');
            $crud->field_type('organizacion', 'readonly');
            $crud->field_type('usuario', 'hidden');
            $crud->field_type('contrasenia', 'hidden');
            $crud->field_type('privilegios','dropdown', array('Administrador' => 'Administrador', 'Usuario general' => 'Usuario general'));
            $crud->field_type('estatusUsuario','dropdown', array('Activo' => 'Activo', 'Inactivo' => 'Inactivo'));
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('avatar', 'images/usuarios');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('privilegios', 'estatusUsuario', 'TiposUsuario_idTipoUsuario');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
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
            $condiciones = array(
                'TiposUsuario_idTipoUsuario' => 2,
                'privilegios' => 'Usuario general'
            );
            $crud->where($condiciones);

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
            //Imagen y nombre del administrador
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            $output->seccion = "Usuarios generales";

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
            $this->load->view('backend/vw_usuarios.php',(array)$output);
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
    * Método con las propiedades de configuración de Grocery CRUD para mostrar el perfil del administrador logueado
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function perfilAdmin()
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
            $crud->set_subject('Perfil');

            /* Indicar con que tabla se trabajará */
            $crud->set_table('usuarios');

            /* Perzonalizar como se muestras los nombres de los campos */
            $campos = array(
                'idUsuario' => 'ID',
                'avatar' => 'Avatar',
                'nombreUsuario' => 'Nombre',
                'apePat' => 'Apellido paterno',
                'apeMat' => 'Apellido materno',
                'correoUsuario' => 'Correo',
                'organizacion' => 'Organización',
                'usuario' => 'Usuario',
                'contrasenia' => 'Contraseña',
                'privilegios' => 'Privilegios',
                'estatusUsuario' => 'Estatus',
                'Telefonos_idTelefono' => 'Teléfono',
                'Direcciones_idDireccion' => 'Dirección',
                'TiposUsuario_idTipoUsuario' => 'Tipo de usuario'
            );
            $crud->display_as($campos);

            /* Establecer relaciones entra tablas */
            // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
            $crud->set_relation('Telefonos_idTelefono','telefonos','{lada}-{telefono}');
            $crud->set_relation('Direcciones_idDireccion','direcciones','{calle} #{numero}');

            /* Establecer los campos que queremos ver en la lista */
            // Todas
            //$crud->columns('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->columns('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario');
            // Deshabilitando las que no se quieren
            //$crud->unset_columns('idUsuario');

            /* Establecer los campos que queremos ver en los formularios */
            // Todos
            //$crud->fields('idUsuario', 'avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            // Perzonalizado
            $crud->fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'Direcciones_idDireccion');
            // Para el formulario add
            //$crud->add_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_add_fields('idUsuario');
            // Para el formulario edit
            //$crud->edit_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'privilegios', 'estatusUsuario', 'Telefonos_idtelefono', 'Direcciones_idDireccion', 'TiposUsuario_idTipoUsuario');
            //$crud->unset_edit_fields('idUsuario');

            /* Cambiar el atributo type a un campo */
            // The field type is a string and can take the following options:
                // hidden      // set          // text       // enum         
                // invisible   // integer      // date       // string      
                // password    // true_false   // datetime   //readonly                           
            // $crud->field_type(campo, type, value);

            /**
            * Condicion que determina si esta en la pagina de editar, para establecer un tipo de campo especifico para esta sección. 
            */
            if ($this->uri->segment(3) == 'edit') {
                $crud->field_type('Direcciones_idDireccion', 'readonly');
            } else {
                $crud->field_type('contrasenia', 'hidden');
                $crud->field_type('privilegios', 'hidden');
                $crud->field_type('estatusUsuario', 'hidden');
                $crud->field_type('TiposUsuario_idTipoUsuario', 'hidden');
            }
            
            /* Habilitar un input como campos para subir archivos */
            // $crud->set_field_upload(campo, ruta_archivos);
            $crud->set_field_upload('avatar', 'images/usuarios');

            /* Establecer los campos que son requeridos en los formularios */
            $crud->required_fields('avatar', 'nombreUsuario', 'apePat', 'apeMat', 'correoUsuario', 'organizacion', 'usuario', 'contrasenia', 'Telefonos_idtelefono');

            /* Establecer las reglas de los formularios */
            // $crud->set_rules(campo, label, rule);

            /* Deshabilitar funciones */
            $crud->unset_add();
            //$crud->unset_edit();
            //$crud->unset_read();
            $crud->unset_delete();
            $crud->unset_print();
            $crud->unset_export();
            //$crud->unset_operations();
            //$crud->unset_back_to_list();
            //$crud->unset_texteditor(campo, 'full_text');

            /* Funcion de exportar a PDF */
            $crud->unset_pdf();
            //$crud->setPdfUrl('');

            /* Condiciones para los datos a listar */
            // $crud->where(campo, valor_condicion);
            $condiciones = array(
                'TiposUsuario_idTipoUsuario' => 1,
                'idUsuario' => $this->session->userdata('idAdmin')
            );
            $crud->where($condiciones);

            /* Ordenamiento de los datos a listar */
            // $crud->order_by(campo, direccion);

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
            //Imagen y nombre del administrador
            $admin = $this->Mdl_Usuario->getPerfil($this->session->userdata('idAdmin'));
            foreach ($admin as $perfil) {
                $output->nombreUsuario = $perfil->nombreUsuario;
                $output->avatar = $perfil->avatar;
            }
            // Seccion titulos
            $output->seccion = "Perfil";

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
            $this->load->view('backend/vw_perfil.php',(array)$output);
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
    * @param 
    *     - String tipoUsuario, sirve para definir que usuarios consultar
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function pdf ($tipoUsuario)
    {
        /**
        * Verificar que exista sesion de un administrador
        */
        if ($this->session->has_userdata('idAdmin')) {
            /**
            * Condicion para consultar un tipo de usuario en especifico en base al parametro
            */
            if ($tipoUsuario == 'socios') {
                $usuarios = $this->Mdl_Usuario->getSocios();
            }

            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

            // Fecha
            date_default_timezone_set('America/Mexico_City');
            $header = 'Reporte de Socios';
     
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
                        $html .= '<th><strong>Nombre</strong></th>';
                        $html .= '<th><strong>Teléfono</strong></th>';
                        $html .= '<th><strong>Correo</strong></th>';
                        $html .= '<th><strong>Organización</strong></th>';
                    $html .= '</tr>';
                    $html .= '<tr>';
                        $html .= '<td></td>';
                    $html .= '</tr>';
                    
                    /**
                    * Ciclo que recorre los registros de usuarios e inserta una fila por cada uno.
                    */
                    foreach($usuarios as $usuario){
                        $html .= '<tr>';
                            $html .= '<td>'.$usuario->nombreUsuario.' '.$usuario->apePat.' '.$usuario->apeMat.'</td>';
                            $html .= '<td>'.$usuario->lada.'-'.$usuario->telefono.'</td>';
                            $html .= '<td>'.$usuario->correoUsuario.'</td>';
                            $html .= '<td>'.$usuario->organizacion.'</td>';
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
            $titulo = 'Socios_'.date('d').'-'.date('m').'-'.date('Y');
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
    * @since Método disponible desde la versión 1.0.0
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function cargarVistaFront($view, $data) 
    {
        $this->load->view('template/frontend/headerSeccion',$data);
        $this->load->view('frontend/'.$view, $data);

        $datos = $this->Mdl_QuienesSomos->getDatos();
        foreach ($datos as $dato) {}
        $data['dato'] = $dato;

        $direccion = $this->Mdl_QuienesSomos->getDireccion();
        foreach ($direccion as $dir) {}
        $data['direccion'] = $dir;

        $this->load->view('template/frontend/footer', $data);
    }
}
