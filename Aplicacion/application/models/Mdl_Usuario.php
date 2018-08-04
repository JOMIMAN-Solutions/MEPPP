<?php
/**
* Modelo del módulo usuario
* Tiene la interacion y funcion de manejar los datos del usuario en la BD
* En esta clase se encuentran métodos como:
*     - __construct
*     - login
*     - getPerfil
*     - defineTypeUser
*     - getLasSocios
*     - getSocios
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/models
* @package application/models
*
* @version 1.0.0
* Creado el 14/06/2018 a las 10:41 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo colorcar getters y setters de todos los datos del usuario, metodos eliminar, agregar y modificar usuario.
*     - Getters
*     - Setters
*/
class Mdl_Usuario extends CI_Model 
{
	private $_idUsuario;
    private $_nombreUsuario;
    private $_apePat;
    private $_apeMat;
    private $_correo;
    private $_avatar;
    private $_usuario;
    private $_contrasenia;
    private $_fechaNac;
    private $_ocupacion;
    private $_nombreOrganizacion;
    private $_calle;
    private $_numero;
    private $_colonia;
    private $_ciudad;
    private $_puesto;
    private $_privilegios;

	public function __construct () 
	{
		parent::__construct();

	}

	/**
	* Método que retorna la variable $_usuario referente al usuario
	*
	* @access public
	* @param Ninguno
	* @return string
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getUsuario()
	{
		return $this->_usuario;
	}

	/**
	* Método que retorna la variable $_contrasenia referente al usuario
	*
	* @access public
	* @param Ninguno
	* @return string
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getContrasenia()
	{
		return $this->_contrasenia;
	}


	/**
	* Método que asigna a la variable global $_usuario el valor que viene como parametro
	*
	* @access public
	* @param string $usuario especifica el usuario 
	* @return string
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setUsuario($usuario)
	{
		$this->_usuario = $usuario;
	}

	/**
	* Método que asigna a la variable global $_contrasenia el valor que viene como parametro
	*
	* @access public
	* @param string $contrasenia especifica la contraseña del usuario
	* @return string
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setContrasenia($contrasenia)
	{
		$this->_contrasenia = $contrasenia;
	}

	/**
	* Método que interactua con la base de datos y la tabla usuarios, usuarios_registrados
	* Este método realiza la función de buscar un usuario en la base de datos que coincida con los datos recibidos
	*
	* @access public
	* @param Ninguno
	* @return array || int
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function login()
	{
		$data = array(
			'usuario' => $this->_usuario,
			'contrasenia' => $this->_contrasenia,
		);
        $this->db->select("*");
        $this->db->from('usuarios');
        $this->db->where($data);
        $usuario = $this->db->get();
        /**
        * Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
        * 
        */
        if ($usuario->num_rows() != 0) {
            return $usuario->result();
        } else {
            return 0;
        }
	}

	/**
	* Método que interactua con la base de datos para obtener un usuario completo
	* Este método realiza la función de buscar un usuario en la base de datos que coincida con el id recibido como parametro
	*
	* @access public
	* @param int $idUsuario hace referencia a el id del usuario 
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getPerfil($idUsuario) {
        $data = array('idUsuario' => $idUsuario);

        //$typeUser = $this->defineTypeUser($idUsuario);

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->join('telefonos', 'Telefonos_idTelefono = idTelefono');
        $this->db->join('tipos_usuario', 'idTipoUsuario = TiposUsuario_idTipoUsuario');
        $this->db->join('direcciones', 'idDireccion = Direcciones_idDireccion');
        $this->db->join('colonias', 'idColonia = Colonias_idColonia');
        $this->db->join('ciudades', 'idCiudad = Ciudades_idCiudad');
        $this->db->where($data);
        $usuario = $this->db->get();

        return $usuario->result(); 
    }


    /**
    * Método que permite insertar un nuevo usuario desde el frontend
    *
    * @access public
    * @param array $ciudad hace referencia a un arreglo con los datos de la tabla ciudad.
    *        array $colonia hace referencia a un arreglo con los datos de la tabla colonia.
    *        array $direccion hace referencia a un arreglo con los datos de la tabla direccion.
    *        array $telefono hace referencia a un arreglo con los datos de la tabla telefono.
    *        array $usuario hace referencia a un arreglo con los datos de la tabla usuario.
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function insert($ciudad,$colonia,$direccion,$telefono,$usuario,$re) {
        $this->db->trans_begin();

        $this->db->insert('ciudades', $ciudad);
        $lastIdCiudad = $this->db->insert_id();

        $colonia+= array('Ciudades_idCiudad' => $lastIdCiudad);
        $this->db->insert('colonias', $colonia);
        $lastIdColonia = $this->db->insert_id();

        $direccion+= array('Colonias_idColonia' => $lastIdColonia);
        $this->db->insert('direcciones', $direccion);
        $lastIdDireccion = $this->db->insert_id();

        $this->db->insert('telefonos', $telefono);
        $lastIdTelefono = $this->db->insert_id();

        $usuario += array('Telefonos_idTelefono' => $lastIdTelefono);
        $usuario += array('Direcciones_idDireccion' => $lastIdDireccion);
        /**
        * Condicion que determina que tipo de usuario será.
        * 
        */
        if($re==1){
            $usuario += array('TiposUsuario_idTipoUsuario' => 3);
        }else{
           $usuario += array('TiposUsuario_idTipoUsuario' => 2); 
        }
 
        $this->db->set('avatar',$usuario['avatar'])
                ->set('nombreUsuario',$usuario['nombreUsuario'])
                ->set('apePat',$usuario['apePat'])
                ->set('apeMat',$usuario['apeMat'])
                ->set('correoUsuario',$usuario['correoUsuario'])
                ->set('organizacion',$usuario['organizacion'])
                ->set('usuario',$usuario['usuario'])
                ->set('contrasenia',"AES_ENCRYPT('{$this->user_password}','{$this->user_name}')",FALSE)
                ->set('privilegios',$usuario['privilegios'])
                ->set('estatusUsuario',$usuario['estatusUsuario'])
                ->set('Telefonos_idTelefono',$usuario['Telefonos_idTelefono'])
                ->set('Direcciones_idDireccion',$usuario['Direcciones_idDireccion'])
                ->set('TiposUsuario_idTipoUsuario',$usuario['TiposUsuario_idTipoUsuario']);
        $this->db->insert('usuarios');

        if ($this->db->trans_status() === TRUE){
            $this->db->trans_commit();
        }else{
            $this->db->trans_rollback();
        }
    }

    /**
    * Método que permite modificar un usuario existente e la aplicación
    *
    * @access public
    * @param array $ciudad hace referencia a un arreglo con los datos de la tabla ciudad.
    *        array $colonia hace referencia a un arreglo con los datos de la tabla colonia.
    *        array $direccion hace referencia a un arreglo con los datos de la tabla direccion.
    *        array $telefono hace referencia a un arreglo con los datos de la tabla telefono.
    *        array $usuario hace referencia a un arreglo con los datos de la tabla usuario.
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function update($ciudad,$colonia,$direccion,$telefono,$usuario,$re){
        $this->db->trans_begin();

        $this->db->where("idTelefono = ".$this->session->userdata('perfil')->idTelefono);
        $this->db->update('telefonos', $telefono);

        $this->db->where("idCiudad = ".$this->session->userdata('perfil')->idCiudad);
        $this->db->update('ciudades', $ciudad);

        $this->db->where("idColonia = ".$this->session->userdata('perfil')->idColonia);
        $this->db->update('colonias', $colonia);

        $this->db->where("idDireccion = ".$this->session->userdata('perfil')->idDireccion);
        $this->db->update('direcciones', $direccion);

        $this->db->where("idUsuario = ".$this->session->userdata('perfil')->idUsuario);
        $this->db->update('usuarios', $usuario);

        if ($this->db->trans_status() === TRUE){
            $this->db->trans_commit();
        }else{
            $this->db->trans_rollback();
        }
    }

    /**
	* Método que interactua con la base de datos para determinar que tipo de usuario es.
	*
	* @access public
	* @param int $idUsuario hace referencia a el id del usuario 
	* @return string
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
    public function defineTypeUser($idUsuario)
    {
    	$data = array('idUsuario' => $idUsuario);

        $this->db->select('*');
        $this->db->from('representantes');
        $this->db->join('personas', 'idPersona = Personas_idPersona');
        $this->db->join('usuarios_registrados', 'idUsuarioRegistrado = UsuariosRegistrados_Persona_idUsuarioRegistrado');
        $this->db->join('usuarios', 'idUsuario = Usuarios_idUsuario');
        $this->db->where($data);
        $representante = $this->db->get();
        /**
        * Condición que verifica si la consulta anterior obtuvo un resultado, si lo obtuvo, retorna string con el valor de representante, si no retorna un string con el valor de persona.
        * 
        */
        if ($representante->num_rows() != 0) {
            return 'Representante';
        } else {
            return 'Persona';
        }
    }

    /**
    * Método que interactua con la basse de datos y obtiene los ultimos 3 socios registras en la base de datos
    *
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
	public function getLastSocios()
	{
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->join('tipos_usuario', 'idTipoUsuario = TiposUsuario_idTipoUsuario');
        $this->db->where('idTipoUsuario = 5');
        $this->db->order_by('idUsuario', 'DESC');
        $this->db->limit(5);
        $socios = $this->db->get();
        /**
        * Condición que verifica si la consulta anterior obtuvo un resultado, si lo obtuvo, retorna un arreglo con el resultado de la consulta, si no, retorna un int con valor de 0.
        * 
        */
        if ($socios->num_rows() != 0) {
            return $socios->result();
        } else {
            return 0;
        }
    }

    /**
    * Descripción corta del fichero (obligatoria, una línea)
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param 
    *    - [tipo] [nombre_de_variable] [descripción]
    *    - [tipo] [nombre_de_variable] [descripción]
    * @return [tipo_de_dato]
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo [información]
    */
    public function getSocios()
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->join('telefonos', 'Telefonos_idTelefono = idTelefono');
        $this->db->join('tipos_usuario', 'idTipoUsuario = TiposUsuario_idTipoUsuario');
        $this->db->where('idTipoUsuario = 5');
        $this->db->order_by('idUsuario', 'DESC');
        $socios = $this->db->get();

        if ($socios->num_rows() != 0) {
            return $socios->result();
        } else {
            return 0;
        }
    }

}