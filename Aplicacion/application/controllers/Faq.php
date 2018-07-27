<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Clase con las funciones que permiten gestionar el módulo de faq
* En esta clase se encuentran métodos como:
*     - index()
*     - cargarVistaFront()
*
* @autor Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package applications/controllers
*
* @version 1.0
* Creado el 15/06/2018 a las 05:09 pm
* Ultima modificacion el 26/07/2018 a las 08:48 pm
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo Realizar método para guardar,modificar y eliminar un arbol.
*/
class Faq extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        $this->load->model('Mdl_Faq');
    }


     /**
    * Método para obtener todas las faqs de la abse de datos
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
        $data['title']="MEPPP | FAQS";
        $data['page']="FAQS";
        $data['seccion']="6";
        $data['imagen']='faqsSeccion';
        $data['secciones'] = $this->Mdl_Faq->getSecciones();
        $data['faqs'] = $this->Mdl_Faq->getAllFaqs();

        $this->cargarVistaFront('vw_faqs',$data);
    }


/* -------------------------------------- BACKEND --------------------------------------- */

    public function cPanel()
    {
        $this->load->view('template/backend/header');
        $this->load->view('backend/vw_faqs');
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
        if (isset($data['seccion'])) {
            $this->load->view('template/frontend/headerSeccion',$data);
        }else{
            $this->load->view('template/frontend/header', $data);   
        }
        $this->load->view('frontend/' . $view, $data);
        $this->load->view('template/frontend/footer');
    }
}