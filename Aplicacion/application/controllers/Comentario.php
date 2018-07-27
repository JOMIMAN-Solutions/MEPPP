<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con métodos que pemriten gestionar el módulo de Comentarios
* En esta clase se encuentran métodos como:
*     - __construct
*     - index
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package application/controllers
*
* @version 1.0.0
* Creado el 15/06/2018 a las 10:35 am
* Ultima modificacion el 26/07/2018 a las 08:47 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Métodos para...
*     - Guardar comentarios
*     - Cambiar estatus del comentario para definir si se muestra o no en la pagina de comentarios
*/
class Comentario extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Comentario');
    }


    /**
    * Metodo que carga los 15 comentarios más recientes en la pagina de Comentario
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
        $data['title'] = "MEPPP | Comentarios";
        $data['page'] = "Comentarios";
        $data['seccion'] = "4";
        $data['imagen'] = 'comentariosSeccion';
        $data['comentarios'] = $this->Mdl_Comentario->getRecent();

        $this->cargarVistaFront('vw_comentarios',$data);
    }


/* -------------------------------------- BACKEND --------------------------------------- */

    public function cPanel()
    {
        $this->load->view('template/backend/header');
        $this->load->view('backend/vw_comentarios');
        $this->load->view('template/backend/footer');
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