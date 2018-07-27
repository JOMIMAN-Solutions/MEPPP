<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar el módulo de Adopciones
* En esta clase se encuentran métodos como:
*     - index
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.0
* Creado el 26/07/2018 a las 05:50 pm
* Ultima modificacion el 26/07/2018 a las 05:50 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Nada
*/
class Adopcion extends CI_Controller 
{
	function __construct() {
        parent::__construct();
        //$this->load->library('grocery_CRUD');
    }

    public function cPanel()
    {
    	/*//Instanciar un objeto de grocery crud
		$crud = new grocery_CRUD();

		//Indicar con que tabla se trabajara
		$crud->set_table('employees');

		$crud->set_relation('officeCode','offices','city');

		$campos = array(
			'lastName' => 'Apellido',
			'firstName' => 'Nombre(s)'
		);
		$crud->display_as($campos);

		$crud->required_fields('lastName','firstName');
		$crud->set_field_upload('file_url','assets/uploads/files');

		//Renderizar la tabla
		$output = $crud->render();

		$this->load->view('vw_employees.php',(array)$output);*/

		$this->load->view('template/backend/header');
		$this->load->view('backend/vw_adopciones');
		$this->load->view('template/backend/footer');
    }
}