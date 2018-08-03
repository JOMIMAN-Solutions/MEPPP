<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Clase con las funciones que permiten gestionar el módulo de Arbol
* En esta clase se encuentran métodos como:
*     - index
*     - addTree
*     - deleteTree
*     - vaciarCanasta
*     - misAdopcione
*     - cargarVistaFront
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/controllers
* @package applications/controllers
*
* @version 1.0.0
* Creado el 14/06/2018 a las 10:40 pm
* Ultima modificacion el 03/08/2018 a las 01:24 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
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

        /**
        * Condición que determina si se esta realizando una búsqueda para dejar seleccionado el valor correspondiente en los select en la
        * vista vw_invernadero
        */
        if ($this->input->post('bTipo') || $this->input->post('bTemporada')) {
            $dataBusqueda = array(
                'tipo' => $this->input->post('bTipo'),
                'temporada' => $this->input->post('bTemporada')
            );
            $bus = (object)$dataBusqueda;
            $this->session->set_userdata('busqueda', $bus);
            $data['busquedaTipo'] = $this->input->post('bTipo');
            $data['busquedaTemporada'] = $this->input->post('bTemporada');    
        }
        /**
        * Condición que determina si la búsqueda se ha reseteado para posteriormente eliminar la sesión búsqueda;
        */
        if ($this->input->post('valorEscondido')==" " && $this->input->post('valorEscondido2')==" ") {
          $this->session->unset_userdata('busqueda');  
        }

    
        $data['title']="MEPPP | Invernadero";
        $data['page']="Invernadero";
        $data['seccion']="1";
        $data['imagen']='invernaderoSeccion';
        $data['temporadas']=$this->Mdl_Arbol->getTemporadasArboles();
        $data['tipos']=$this->Mdl_Arbol->getTiposArboles();

        //PAGINACIÓN
        $config['base_url'] = base_url() . 'Arbol/page/';
        /**
        * Condición que determina si la sesión búsqueda existe
        */
        if ($this->session->has_userdata('busqueda')) {
            $config['total_rows'] = $this->Mdl_Arbol->totalRows($this->session->userdata('busqueda')->tipo,$this->session->userdata('busqueda')->temporada);
        }else{
         $config['total_rows'] = $this->Mdl_Arbol->totalRows(0,0);   
        }

        $config['per_page'] = 4;
        $config['num_links'] = 4;
        $config['first_link'] = '<span class="fa fa-angle-double-left"></span>';
        $config['last_link'] = '<span class="fa fa-angle-double-right"></span>';
        $config['cur_tag_open'] = '<span class="active">';
        $config['cur_tag_close'] = '</span>';
        $config['next_link'] = '<span class="fa fa-angle-right"></span>';
        $config['prev_link'] = '<span class="fa fa-angle-left"></span>';
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        $data["arboles"] = $this->Mdl_Arbol->getTreesPaged($config['per_page'], $this->uri->segment(3),$this->input->post('bTipo'),$this->input->post('bTemporada'));


        /**
        * Condición que determina si la sesión búsqueda existe
        */
        if ($this->session->has_userdata('busqueda')) {
            $data["arboles"] = $this->Mdl_Arbol->getTreesPaged($config['per_page'], $this->uri->segment(3),$this->session->userdata('busqueda')->tipo,$this->session->userdata('busqueda')->temporada);
            $data['busquedaTipo'] = $this->session->userdata('busqueda')->tipo;
            $data['busquedaTemporada'] = $this->session->userdata('busqueda')->temporada;
        }

        /**
        * Condición que determina si se abrirá una ventana modal al cargar la pagina, se verifica la existencia de session con el nombre 
        * de item.
        */
        if ($this->session->flashdata('item')) {
           
        }else{
           $this->session->set_flashdata('item', 3);
        }
    
        $this->cargarVistaFront('vw_invernadero',$data);
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
    public function addTree()
    {
        $id = $this->input->post('id');
        $arbolResult = $this->Mdl_Arbol->getOneById($id);
        foreach ($arbolResult as $arbol) {}
        $cantidad = 1;
        
        // Creamos un arreglo con los productos para insertarlos en el carrito
        $insert = array(
            'id' => $id,
            'qty' => $cantidad,
            'price' => 0,
            'name' => $arbol->nombreComun,
            'image' => $arbol->imagenArbol
        );

        // Insertamos al carrito
        $this->cart->insert($insert);

        // Obtenemos la url para redirigir a la página en la que estabamos
        $uri = $this->input->post('uri');
        
        /* Redirigimos mostrando un mensaje con las sesiones flashdata
           confirmando que hemos agregado el árbol */
        $this->session->set_flashdata('item',4);
        redirect(base_url().'Arbol/page/'.$uri, 'refresh');
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
    public function deleteTree($rowid) 
    {
        /* Para eliminar un producto debemos conseguir su id y actualizarlo poniendo qty en 0 */
        $arbol = array(
            'rowid' => $rowid,
            'qty' => 0
        );

        /* después utilizamos la función update para actualizar el carrito pasando el array a actualizar */
        $this->cart->update($arbol);
        
        //$this->session->set_flashdata('productoEliminado', 'El producto fue eliminado correctamente');
        $this->session->set_flashdata('item',1);
        if ($this->cart->contents()) {
            redirect(base_url().'Arbol/', 'refresh');
        } else {
            redirect(base_url().'Arbol', 'refresh');
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
    public function vaciarCanasta() {
        $this->cart->destroy();
        //$this->session->set_flashdata('destruido', 'El carrito fue eliminado correctamente');
        $this->session->set_flashdata('item',5);
        redirect(base_url().'Arbol', 'refresh');
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

