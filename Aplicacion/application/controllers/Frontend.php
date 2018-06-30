<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con metodos que permiten redireccionar a secciones del sitio
*
* @autor Miguel Ángel Mandujano Barragán, Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package application/controllers
*
* @version 1.0
* Creado el 14/06/2018 a las 10:28 pm
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo [información]
*/
class Frontend extends CI_Controller 
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Mdl_Arbol');
		$this->load->model('Mdl_Usuario');
	}

    /**
    * Cargar la pagina principal del sitio
    * Esta pagina require llamar a los modelos:
    *     - Mdl_Arbol: Para cargar los arboles de temporada
    *     - Mdl_Usuario: Para obtener los socios principales de la asociasion
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function index(){
        $data['title'] = "MEPPP | Inicio";
        $data['page'] = "Inicio";
        $data['arbolesTemp'] = $this->Mdl_Arbol->getArbolesTemp();
        $data['socios'] = $this->Mdl_Usuario->getLastSocios();

        $this->cargarVista('vw_inicio', $data);
    }

    /**
    * Cargar pagina ¿Quienes somos?
    *
    * @access public
    * @param Nada
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function quienesSomos(){
        $data['title'] = "MEPPP | ¿Quienes Somos?";
        $data['page'] = "¿Quienes Somos?";
        $data['seccion'] = "5";
        $data['imagen'] = 'quienesSomosSeccion';

        $this->cargarVista('vw_quienesSomos', $data);
    }

    /**
    * Cargar el formulario para iniciar sesion
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param Nada
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function login(){
        $data['title'] = "MEPPP | LOGIN";
        $data['page'] = "login";
        $data['seccion'] = "7";
        $data['imagen'] = "loginSeccion";

        $this->cargarVista('vw_login', $data);
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
    public function cargarVista($view, $data) 
    {
        if (isset($data['seccion'])) {
            $this->load->view('template/frontend/headerSeccion',$data);
        }else{
            $this->load->view('template/frontend/header', $data);   
        }
        $this->load->view('frontend/' . $view, $data);
        $this->load->view('template/frontend/footer');
    }
}
