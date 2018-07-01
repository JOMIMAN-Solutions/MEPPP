<?php
/**
* Clase con las funciones para interactuar con la base de datos - modulo arbol
* En esta clase se encuentran métodos como:
*     - getters and setters
*     - getArblesTemp
*     - getAllInvernadero
*     - getOneById
*     - totalRows
*     - getTreesPaged
* 
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/models
* @package applications/models
*
* @version 1.0.0
* Creado el 14/06/2018 a las 10:45 pm
* Ultima modificacion el 30/06/2018 a las 08:30 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Realizar método para guardar,modificar y eliminar un arbol.
*/
class Mdl_Arbol extends CI_Model 
{
	private $_idArbol;
	private $_imagenArbol;
	private $_nombreComun;
	private $_nombreCientifico;
	private $_descripcion;
	private $_existencia;
	private $_estatusArbol;
	private $_tipoArbol;
	private $_temporada;
    
    public function __construct($id = null, $imagen = null, $nomComun = null, $nomCientifico = null, $descripcion = null, $stock = null, $estatus= null, $tipo = null, $temp = null) 
	{
		parent::__construct();
		$this->_idArbol = $id;
		$this->_imagenArbol = $imagen;
		$this->_nombreComun = $nomComun;
		$this->_nombreCientifico = $nomCientifico;
		$this->_descripcion = $descripcion;
		$this->_existencia = $stock;
		$this->_estatusArbol = $estatus;
		$this->_tipoArbol = $tipo;
		$this->_temporada = $temp;
	}

	/**
	* Método que permite obtener el identificador de un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getIdArbol()
	{
		return $this->_idArbol;
	}

	/**
	* Método que permite obtener la imagen del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getImagenArbol()
	{
		return $this->_imagenArbol;
	}

	/**
	* Método que permite obtener el nombre comun del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getNombreComun()
	{
		return $this->_nombreComun;
	}

	/**
	* Método que permite obtener el nombre cientifico del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getNombreCientifico()
	{
		return $this->_nombreCientifico;
	}

	/**
	* Método que permite obtener la descripcion del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getDescripcion()
	{
		return $this->_descripcion;
	}

	/**
	* Método que permite obtener el numero en existencia de un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getExistencia()
	{
		return $this->_existencia;
	}

	/**
	* Método que permite obtener el estatus de un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getEstatusArbol()
	{
		return $this->_estatusArbol;
	}

	/**
	* Método que permite obtener el tipo de arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getTipoArbol()
	{
		return $this->_tipoArbol;
	}

	/**
	* Método que permite obtener la temporada a la que pertenece un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getTemporada()
	{
		return $this->_temporada;
	}

	/**
	* Método que permite establecer el identificador de un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setIdArbol($id)
	{
		$this->_idArbol = $id;
	}

	/**
	* Método que permite establecer la imagen del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setImagen($imagen)
	{
		$this->_imagenArbol = $imagen;
	}

	/**
	* Método que permite establecer el nombre comun del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setNombreComun($nomComun)
	{
		$this->_nombreComun = $nomComun;
	}

	/**
	* Método que permite establecer el nombre cientifico del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setNombreCientifico($nomCientifico)
	{
		$this->_nombreCientifico = $nomCientifico;
	}

	/**
	* Método que permite establecer la descripcion del arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setDescripcion($descripcion)
	{
		$this->_descripcion = $descripcion;
	}

	/**
	* Método que permite establecer el numero en existencia de un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setExistencia($stock)
	{
		$this->_existencia = $stock;
	}

	/**
	* Método que permite establecer el estatus de un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setEstatusArbol($estatus)
	{
		$this->_estatusArbol = $estatus;
	}

	/**
	* Método que permite establecer el tipo de arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setTipoArbol($tipo)
	{
		$this->_tipoArbol = $tipo;
	}

	/**
	* Método que permite establecer la temporada a la que pertenece un arbol
	*
	* @access public
	* @param Ninguno
	* @return void
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function setTemporada($temp)
	{
		$this->_temporada = $temp;
	}

	/**
	* Método que obtiene los arboles de temporada
	*
	* @access public
	* @param Ninguno
	* @return array || int
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getArbolesTemp()
	{
		$this->db->select('*');
        $this->db->from('arboles');
        $this->db->join('tipos_arbol', 'idTipoArbol = TiposArbol_idTipoArbol');
        $this->db->join('det_temporadas', 'idArbol = Arboles_idArbol');
        $this->db->join('temporadas_arbol', 'idTemporadaArbol = TemporadasArbol_idTemporadaArbol');
        $this->db->where('estatusTemporada = 1 AND estatusArbol = 1 AND existencia > 0');
        $arboles = $this->db->get();

        if ($arboles->num_rows() != 0) {
            return $arboles->result();
        } else {
            return 0;
        }
	}

	/**
	* Método que interactua con la base de datos para obtener todos los arboles mientras estos tengan un status de 1 y su existencia sea mayor que 0
	* @access public
	* @param Ninguno
	* @return array o int
	*
	* @since Método disponible desde la versión 1.0
	* @deprecated Método obsoleto en la versión 2.0
	* @todo Nada
	*/
	public function getAllInvernadero()
	{
        $this->db->select('*');
        $this->db->from('arboles');
        $this->db->join('tipos_arbol', 'idTipoArbol = TiposArbol_idTipoArbol');
        $this->db->join('det_temporadas', 'idArbol = Arboles_idArbol');
        $this->db->join('temporadas_arbol', 'idTemporadaArbol = TemporadasArbol_idTemporadaArbol');
        $this->db->where('estatusArbol = 1 AND existencia > 0');
        $arboles = $this->db->get();

        /**
		* Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
		* 
		*/
        if ($arboles->num_rows() != 0) {
            return $arboles->result();
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
    public function getOneById($id)
    {
    	$condicion = array('idArbol' => $id);

        $this->db->select('*');
        $this->db->from('arboles');
        $this->db->where($condicion);
        $arbolResult = $this->db->get();

        return $arbolResult->result();
    }

    /**
    * Obtener la cantidad de filas de los árboles para realizar la paginación
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
    public function totalRows() 
    {
    	$this->db->select('*');
    	$this->db->from('arboles');
    	$this->db->join('tipos_arbol', 'idTipoArbol = TiposArbol_idTipoArbol');
        $this->db->join('det_temporadas', 'idArbol = Arboles_idArbol');
        $this->db->join('temporadas_arbol', 'idTemporadaArbol = TemporadasArbol_idTemporadaArbol');
        $this->db->where('estatusArbol = 1 AND existencia > 0');
        $arboles = $this->db->get();

        return $arboles->num_rows();
    }

    /**
    * Obtenemos todos los árboles para paginarlos
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
    public function getTreesPaged($perPage, $segment)
    {
    	$this->db->select('*');
    	$this->db->from('arboles');
    	$this->db->join('tipos_arbol', 'idTipoArbol = TiposArbol_idTipoArbol');
        $this->db->join('det_temporadas', 'idArbol = Arboles_idArbol');
        $this->db->join('temporadas_arbol', 'idTemporadaArbol = TemporadasArbol_idTemporadaArbol');
        $this->db->where('estatusArbol = 1 AND existencia > 0');
    	$this->db->limit($perPage, $segment);
        $treesPaged = $this->db->get();

		/**
		* Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
		* 
		*/
    	if ($treesPaged->num_rows() != 0) {
            return $treesPaged->result();
        } else {
            return 0;
        }
    }
}