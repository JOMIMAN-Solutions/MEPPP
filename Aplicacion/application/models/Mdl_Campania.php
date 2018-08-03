<?php
/**
* Clase con métodos que permiten interactuar con la BD - módulo de Campañas
* Esta clase abarca las siguientes tablas de la BD:
*     - campanias
*     - tipos_campania
*     - imagenes_campania
* En esta clase se encuentran métodos como:
*     - __construct
*     - getAllComplete
*     - getImagenes
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/models
* @package application/models
*
* @version 1.0.0
* Creado el 15/06/2018 a las 10:10 am
* Ultima modificacion el 29/06/2018 a las 02:36 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Métodos para...
*     - Getters
*     - Setters
*     - Agregar campañas
*     - Cancelar campañas
*     - Obetener campañas para el calendario
*     - Obetener los datos de una campaña en especifico
*/
class Mdl_Campania extends CI_Model 
{
    private $_idCampania;
    private $_imagenPortada;
    private $_nombreCampania;
    private $_fechaInicio;
    private $_fechaFin;
    private $_hora;
    private $_lugar;
    private $_publico;
    private $_estatusCampania;
    private $_tipoCampania;
    
    public function __construct($id = null, $portada = null, $nombre = null, $fechaInicio = null, $fechaFin = null, $hora = null, $lugar = null, $publico = null, $estatus = null, $tipo = null) 
    {
        parent::__construct();
        $this->_idCampania = $id;
        $this->_imagenPortada = $portada;
        $this->_nombreCampania = $nombre;
        $this->_fechaInicio = $fechaInicio;
        $this->_fechaFin = $fechaFin;
        $this->_hora = $hora;
        $this->_lugar = $lugar;
        $this->_publico = $publico;
        $this->_estatusCampania = $estatus;
        $this->_tipoCampania = $tipo;
    }

    /**
    * Método que obtine las campañas terminadas de la tabla campanias
    *
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
	public function getAllComplete()
	{
        $this->db->select('*');
        $this->db->from('campanias');
        $this->db->join('tipos_campania', 'idTipoCampania = TiposCampania_idTipoCampania');
        $this->db->where('estatusCampania = "Realizada"');
        $campanias = $this->db->get();

        /**
        * Condición que determina el dato a retornar
        * Condición que verifica si la consulta anterior trae datos. Si se cumple retorna el arreglo del resultado; si no, retorna 0.
        */
        if ($campanias->num_rows() != 0) {
            return $campanias->result();
        } else {
            return 0;
        }
    }

    /**
    * Método que obtiene todas las imagenes de la tabla imagenes_campania
    *
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getImagenes()
    {
    	$this->db->select('*');
        $this->db->from('imagenes_campania');
        $this->db->order_by('Campanias_idCampania');
        $imagenes = $this->db->get();

        /**
        * Condición que determina el dato a retornar
        * Condición que verifica si la consulta anterior trae datos. Si se cumple retorna el arreglo del resultado; si no, retorna 0.
        */
        if ($imagenes->num_rows() != 0) {
            return $imagenes->result();
        } else {
            return 0;
        }
    }



    /**
    * Método que obtiene todos los eventos proximos que la empresa hará
    *
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getEvents(){
        $this->db->select('nombreCampania as "title",fechaInicio as "start",DATE_ADD(fechaFin, INTERVAL 1 DAY) as "end",publico,hora,lugar,imagenPortada');
        $this->db->from('campanias');
        $this->db->order_by('fechaInicio','asc');
        $events = $this->db->get();

        /**
        * Condición que determina el dato a retornar
        * Condición que verifica si la consulta anterior trae datos. Si se cumple retorna el arreglo del resultado; si no, retorna 0.
        */
        if ($events->num_rows() != 0) {
            return $events->result();
        } else {
            return 0;
        }

    }
}