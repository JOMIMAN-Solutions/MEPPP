<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con métodos que permiten gestionar el módulo de Campañas
* En esta clase se encuentran métodos como:
*     - index()
*
* @autor Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package applications/controllers
*
* @version 1.0
* Creado el 15/06/2018 a las 10:05 am
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo Métodos para...
*     - Agregar campañas
*     - Cancelar campañas
*     - Obetener campañas para el calendario
*     - Obetener los datos de una campaña en especifico
*/
class Campania extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Campania');
    }

    /**
    * Metodo que carga las campañas terminadas en la pagina de Campañas del frontend
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function index()
    {
        $data['title'] = "MEPPP | Campañas";
        $data['page'] = "Campañas";
        $data['seccion'] = "2";
        $data['imagen'] = 'campañasSeccion';
        $data['campanias'] = $this->Mdl_Campania->getAllComplete();
        $data['imagenes'] = $this->Mdl_Campania->getImagenes();

        $this->cargarVistaFront('vw_campañas', $data);
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