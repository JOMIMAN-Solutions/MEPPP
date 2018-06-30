<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar el módulo de Arbol
* En esta clase se encuentran métodos como:
*     - getArbolesTemp()
*     - getAllInvernadero()
*     - cargarVistaFront()
*
* @autor Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package applications/controllers
*
* @version 1.0
* Creado el 14/06/2018 a las 10:40 pm
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo Realizar método para guardar,modificar y eliminar un arbol.
*/
class Arbol extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Arbol');
    }

    /**
    * Método para cargar todos los arboles de la base de datos y enviar un array con datos al metodo de cargarVistaFront
    * 
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
    	$data['title']="MEPPP | Invernadero";
        $data['page']="Invernadero";
        $data['seccion']="1";
        $data['imagen']='invernaderoSeccion';
        $data['arboles'] = $this->Mdl_Arbol->getAllInvernadero();

        $this->cargarVistaFront('vw_invernadero',$data);
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

