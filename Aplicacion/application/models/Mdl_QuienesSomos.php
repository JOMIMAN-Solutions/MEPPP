<?php
/**
* Clase con las funciones para interactuar con la base de datos de la empresa
* En esta clase se encuentran métodos como:
*     - getAllAdopciones
*     - getArbolesByAdopcion
* 
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/models
* @package applications/models
*
* @version 1.0.0
* Creado el 034/08/2018 a las 08:38 pm
* Ultima modificacion el 03/08/2018 a las 08:34 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Nada
*/
class Mdl_QuienesSomos extends CI_Model 
{
    public function __construct() 
	{
		parent::__construct();
	}

	public function getDatos()
	{
        $this->db->select('telefono1, telefono2, correoEmpresa');
        $this->db->from('quienes_somos');
        $datos = $this->db->get();

        return $datos->result();
    }

    public function getDireccion()
    {
        $this->db->select('calle, numero, colonia, ciudad');
        $this->db->from('direcciones');
        $this->db->join('colonias', 'idColonia = Colonias_idColonia');
        $this->db->join('ciudades', 'idCiudad = Ciudades_idCiudad');
        $this->db->where('idDireccion = 1');
        $direccion = $this->db->get();

        return $direccion->result();
    }

	public function getFilosofia()
	{
        $this->db->select('mision, vision');
        $this->db->from('quienes_somos');
        $filosofia = $this->db->get();

        return $filosofia->result();
    }

    public function getValores()
    {
        $this->db->select('idValor, nombreValor, descripcionValor');
        $this->db->from('valores');
        $valores = $this->db->get();

        return $valores->result();
    }
}