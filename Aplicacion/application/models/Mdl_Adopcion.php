<?php
/**
* Clase con las funciones para interactuar con la base de datos - modulo Adopciones
* En esta clase se encuentran métodos como:
*     - getAllAdopciones
*     - getArbolesByAdopcion
* 
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/models
* @package applications/models
*
* @version 1.0.0
* Creado el 03/08/2018 a las 07:59 pm
* Ultima modificacion el 03/08/2018 a las 08:34 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Nada
*/
class Mdl_Adopcion extends CI_Model 
{
    public function __construct() 
	{
		parent::__construct();
	}

	/**
	* Método que interactua con la base de datos para obtener todas las adopciones mientras estos tengan un status de "Realizada"
	* @access public
	* @param Ninguno
	* @return array o int
	*
	* @since Método disponible desde la versión 1.0.0
	* @deprecated Método obsoleto en la versión 2.0.0
	* @todo Nada
	*/
	public function getAllAdopciones()
	{
        $this->db->select('nombreUsuario, apePat, apeMat, adopciones.*');
        $this->db->from('adopciones');
        $this->db->join('usuarios', 'idUsuario = Usuarios_idUsuario');
        $this->db->where('estatusAdopcion = "Cubierta"');
        $adopciones = $this->db->get();

        /**
		* Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
		* 
		*/
        if ($adopciones->num_rows() != 0) {
            return $adopciones->result();
        } else {
            return 0;
        }
    }

    /**
	* Método que interactua con la base de datos para obtener todos los árboles de una adopcion en particular.
	* @access public
	* @param Ninguno
	* @return array o int
	*
	* @since Método disponible desde la versión 1.0.0
	* @deprecated Método obsoleto en la versión 2.0.0
	* @todo Nada
	*/
	public function getArbolesByAdopcion($idAdopcion)
	{
        $this->db->select('nombreComun, cantidad');
        $this->db->from('arboles');
        $this->db->join('det_adopciones', 'arboles.idArbol = det_adopciones.idArbol');
        $this->db->where('det_adopciones.idAdopcion = '. $idAdopcion);
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
}