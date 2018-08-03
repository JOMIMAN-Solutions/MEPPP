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

        $this->db->select('*');
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