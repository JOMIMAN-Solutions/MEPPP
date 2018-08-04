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
* @version 1.0.1
* Creado el 14/06/2018 a las 10:45 pm
* Ultima modificacion el 03/08/2018 a las 02:14 am
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
        $this->db->join('det_temporadas', 'arboles.idArbol = det_temporadas.idArbol');
        $this->db->join('temporadas_arbol', 'temporadas_arbol.idTemporadaArbol = det_temporadas.idTemporadaArbol');
        $this->db->where('estatusTemporada = "Activa" AND estatusArbol = "Activo" AND existencia > 0');
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
        $this->db->join('det_temporadas', 'arboles.idArbol = det_temporadas.idArbol');
        $this->db->join('temporadas_arbol', 'temporadas_arbol.idTemporadaArbol = det_temporadas.idTemporadaArbol');
        $this->db->where('estatusArbol = "Activo" AND existencia > 0');
        $this->db->group_by('det_temporadas.idArbol');
        $this->db->order_by('nombreComun', 'ASC');
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
    * @param int $tipo indica el tipo de árbol que se este búscando
    *		 int $temporada indica la temporada del árbol que se este búscando 
    * @return int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function totalRows($tipo,$temporada) 
    {
    	$this->db->select('*');
    	$this->db->from('arboles');
    	$this->db->join('tipos_arbol', 'idTipoArbol = TiposArbol_idTipoArbol');
        $this->db->join('det_temporadas', 'arboles.idArbol = det_temporadas.idArbol');
        $this->db->join('temporadas_arbol', 'temporadas_arbol.idTemporadaArbol = det_temporadas.idTemporadaArbol');

        /**
		* Condición que determina como se realizará la condición WHERE para la realizar la paginación adecuadamente, se verifica la 
		* existencia de algo dentro de las variables $tipo y $temporada.
		*/
        if ($tipo && $temporada) {
        	$this->db->where('estatusArbol = "Activo" AND existencia > 0 AND idTipoArbol = '.$tipo.' AND temporadas_arbol.idTemporadaArbol = '.$temporada);
        }else{

        	/**
			* Condición que determina como se realizará la condición WHERE para la realizar la paginación adecuadamente, se verifica la
			* existencia de algo dentro de la variable $tipo.
			*/
        	if($tipo){
        		$this->db->where('estatusArbol = "Activo" AND existencia > 0 AND idTipoArbol = '.$tipo);
        	}else{
        		/**
				* Condición que determina como se realizará la condición WHERE para la realizar la paginación adecuadamente, se verifica
				* la existencia de algo dentro de la variable $temporada.
				*/
        		if ($temporada) {
        			$this->db->where('estatusArbol = "Activo" AND existencia > 0 AND temporadas_arbol.idTemporadaArbol = '.$temporada);
        		}else{
        			$this->db->where('estatusArbol = "Activo" AND existencia > 0');
        		}
        	}
        }

        $this->db->group_by('det_temporadas.idArbol');
    	$this->db->order_by('nombreComun', 'ASC');

        $arboles = $this->db->get();

        return $arboles->num_rows();
    }

    /**
    * Obtenemos todos los árboles para paginarlos
    *
    * @access public
    * @param int $perpage indica cuantos arboles se mostrarán por página
    *		 int $segment indica el rango para realizar la condicioón LIMIT
    *        int $tipo indica el tipo de árbol que se este búscando
    *		 int $temporada indica la temporada del árbol que se este búscando 
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getTreesPaged($perPage, $segment, $tipo, $temporada)
    {

    	/**
		* Condición que determina como se realizará la condición LIMIT de la consulta para obtener los arboles para la paginación
		*/
    	if ($segment!=0) {
    		$segment = ($perPage * ($segment-1));
    	}
  
    	$this->db->select('*');
    	$this->db->from('arboles');
    	$this->db->join('tipos_arbol', 'idTipoArbol = TiposArbol_idTipoArbol');
        $this->db->join('det_temporadas', 'arboles.idArbol = det_temporadas.idArbol');
        $this->db->join('temporadas_arbol', 'temporadas_arbol.idTemporadaArbol = det_temporadas.idTemporadaArbol');

        /**
		* Condición que determina como se realizará la condición WHERE para obtener las plantas que coincidan con los parametros de 
		* busqueda, se verifica la existencia de algo dentro de las variables $tipo y $temporada.
		*/
        if ($tipo && $temporada) {
          $this->db->where('estatusArbol = "Activo" AND existencia > 0 AND idTipoArbol = '.$tipo.' AND temporadas_arbol.idTemporadaArbol = '.$temporada);
        }else{
	        /**
			* Condición que determina como se realizará la condición WHERE para obtener las plantas que coincidan con los parametros de 
			* busqueda, se verifica la existencia de algo dentro de la variable $tipo.
			*/
	        if ($tipo) {
	         	$this->db->where('estatusArbol = "Activo" AND existencia > 0 AND idTipoArbol = '.$tipo);
	        }else{
	          /**
			  * Condición que determina como se realizará la condición WHERE para obtener las plantas que coincidan con los parametros de 
			  * busqueda, se verifica la existencia de algo dentro de la variable $temporada.
			  */
	          	if ($temporada) {
	             	$this->db->where('estatusArbol = "Activo" AND existencia > 0 AND temporadas_arbol.idTemporadaArbol = '.$temporada);
	            }else{
	              $this->db->where('estatusArbol = "Activo" AND existencia > 0'); 
	            }  
	        }   
        }

        $this->db->group_by('det_temporadas.idArbol');
        $this->db->order_by('nombreComun', 'ASC');

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


    /**
    * Obtenemos todas las temporadas de arboles para realizar una búsqueda
    *
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getTemporadasArboles()
    {
    	$this->db->select('*');
    	$this->db->from('temporadas_arbol');
    	$temporadas = $this->db->get();

    	/**
		* Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
		* 
		*/
    	if($temporadas->num_rows()!=0){
    		return $temporadas->result();
    	}else{
    		return 0;
    	}
    }

     /**
    * Obtenemos todas los tipos de arboles para realizar una búsqueda
    *
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getTiposArboles()
    {
    	$this->db->select('*');
    	$this->db->from('tipos_arbol');
    	$tipos = $this->db->get();

    	/**
		* Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
		* 
		*/
    	if ($tipos->num_rows()!=0) {
    		return $tipos->result();
    	}else{
    		return 0;
    	}
    }

    /**
    * Método que pemrite enviar la solicitud de adopcion
    *
    * @access public
    * @param Ninguno
    * @return Nada
    *
    * @since Método disponible desde la versión 1.0.1
    * @deprecated Método obsoleto en la versión 2.0.0
    * @todo Nada
    */
    public function adoptar()
    {
    	$adopcion = array(
            'fechaAdopcion' => date('Y-m-d'),
            'totalAdoptados' => 0,
            'estatusAdopcion' => 'En proceso',
            'Usuarios_idusuario' => $this->session->userdata('perfil')->idUsuario
        );

        $this->db->trans_begin();

		$this->db->insert('adopciones', $adopcion);

		$lastIdAdopcion = $this->db->insert_id();

		$totalAdoptados = 0;
		/**
		* Ciclo que recorre el contenido del carrito
		* La funcion es obetener los datos de cada árbol que se añadio al carrito para poder mandarlos a la bd e ir sumando el total de arboles adoptados
		*/
		foreach ($this->cart->contents() as $cesta) {
			$totalAdoptados += $cesta['qty'];

			$detalle = array(
	            'idAdopcion' => $lastIdAdopcion,
	            'idArbol' => $cesta['id'],
	            'cantidad' => $cesta['qty']
	        );

			$this->db->insert('det_adopciones', $detalle);

			// Obteber la existencia actual del árbol
			$this->db->where('idArbol', $cesta['id']);
	        $arbol = $this->db->get('arboles');
	        /**
	        * Ciclo para acceder al objeto obetenido de la consulta y guardar su existencia
	        */
	        foreach ($arbol->result() as $tree) {
	            $existencia = $tree->existencia;
	        }
	        // Hacer la resta
	        $existencia = $existencia - $cesta['qty'];

			$this->db->where("idArbol = " . $cesta['id']);
        	$this->db->update('arboles', array('existencia' => $existencia));
		}

		$this->db->where("idAdopcion = $lastIdAdopcion");
        $this->db->update('adopciones', array('totalAdoptados' => $totalAdoptados));

        /**
        * Condicion que comprueba el estado de la transacción
        * Si todo sale bien confirma los cambios, si no los revierte
        */
        if ($this->db->trans_status() === TRUE){
            $this->db->trans_commit();
        }else{
            $this->db->trans_rollback();
        }
    }

    /**
	* Método que interactua con la base de datos para obtener todos las temporadas de un árbol en particular.
	* @access public
	* @param Ninguno
	* @return array o int
	*
	* @since Método disponible desde la versión 1.0.1
	* @deprecated Método obsoleto en la versión 2.0.0
	* @todo Nada
	*/
	public function getTempsArboles($idArbol)
	{
        $this->db->select('temporadaArbol');
        $this->db->from('temporadas_arbol');
        $this->db->join('det_temporadas', 'temporadas_arbol.idTemporadaArbol = det_temporadas.idTemporadaArbol');
        $this->db->where('det_temporadas.idArbol = '. $idArbol);
        $temps = $this->db->get();

        /**
		* Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
		* 
		*/
        if ($temps->num_rows() != 0) {
            return $temps->result();
        } else {
            return 0;
        }
    }
}