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
* Ultima modificacion el 29/07/2018 a las 05:42 pm
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Realizar método para guardar,modificar y eliminar un arbol.
*     - Cambiar el tipo de input "existencia" a number, mostrar los estatus como letras y no como numeros, poder mostrar las temporadas del arbol. em la vista read la imagen carga como un vinculo a la imagen.
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
        //Paginación
        $config['base_url'] = base_url() . 'Arbol/page/';
        $config['total_rows'] = $this->Mdl_Arbol->totalRows();
        $config['per_page'] = 2;
        $config['num_links'] = 4;
        $config['first_link'] = '<span class="fa fa-angle-double-left"></span>';
        $config['last_link'] = '<span class="fa fa-angle-double-right"></span>';
        $config['cur_tag_open'] = '<span class="active">';
        $config['cur_tag_close'] = '</span>';
        $config['next_link'] = '<span class="fa fa-angle-right"></span>';
        $config['prev_link'] = '<span class="fa fa-angle-left"></span>';
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        //$data['arboles'] = $this->Mdl_Arbol->getAllInvernadero();
        $data["arboles"] = $this->Mdl_Arbol->getTreesPaged($config['per_page'], $this->uri->segment(3));

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
        //$this->session->set_flashdata('agregado', 'El árbol fue agregado correctamente');
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
        if ($this->cart->contents()) {
            redirect(base_url().'Arbol/misAdopciones', 'refresh');
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
        redirect(base_url().'Arbol', 'refresh');
    }

    /**
    * Método que carga los arboles que has agregado a tu "carrito"
    * Descripción larga del fichero (opcional, líneas que necesarias)
    *
    * @access public
    * @param Ninguno
    * @return void
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo [información]
    */
    public function misAdopciones()
    {
        $data['title']="MEPPP | Mis Adopciones";
        $data['page']="Mis Adopciones";
        $data['seccion']="9";
        $data['imagen']='invernaderoSeccion';

        $this->cargarVistaFront('vw_misAdopciones',$data);
    }


/* -------------------------------------- BACKEND --------------------------------------- */

    public function cPanel()
    {
        /* Cargar la libreria */
        $this->load->library('grocery_CRUD');

        /* Instanciar un objeto de grocery crud */
        $crud = new grocery_CRUD();

        /* Establecer el tema */
        $crud->set_theme('bootstrap-v4');

        /* Indicar el "objeto" que estaremos manejando */
        $crud->set_subject('Árbol');

        /* Indicar con que tabla se trabajará */
        $crud->set_table('arboles');

        /* Perzonalizar como se muestras los nombres de los campos */
        $campos = array(
            'idArbol' => 'ID',
            'imagenArbol' => 'Imagen',
            'nombreComun' => 'Nombre Común',
            'nombreCientifico' => 'Nombre Científico',
            'descripcion' => 'Descripción',
            'existencia' => 'Existencia',
            'estatusArbol' => 'Estatus',
            'TiposArbol_idTipoArbol' => 'Tipo de árbol'
        );
        $crud->display_as($campos);

        /* Establecer relaciones entra tablas */
        // set_relation(campo_tabla_actual, tabla_a_relacionar, campo_tabla_relacionada)
        if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'read' || $this->uri->segment(3) == 'success') {
            $crud->set_relation('TiposArbol_idTipoArbol','tipos_arbol','tipoArbol');
        } else if ($this->uri->segment(3) == 'add') {
            $crud->set_relation('TiposArbol_idTipoArbol','tipos_arbol','tipoArbol');
        } else if ($this->uri->segment(3) == 'edit') {
            $crud->set_relation('TiposArbol_idTipoArbol','tipos_arbol','tipoArbol');
        }

        /* Establecer los campos que queremos ver en la lista */
        // Todas
        //$crud->columns('idArbol','imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
        // Perzonalizado
        $crud->columns('imagenArbol', 'nombreComun', 'existencia', 'estatusArbol');
        // Deshabilitando las que no se quieren
        //$crud->unset_columns('idArbol', 'nombreCientifico', 'descripcion', 'TiposArbol_idTipoArbol');

        /* Establecer los campos que queremos ver en los formularios */
        // Todos
        //$crud->fields('idArbol','imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
        // Perzonalizado
        $crud->fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
        // Para el formulario add
        //$crud->add_fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
        //$crud->unset_add_fields('idFaq');
        // Para el formulario edit
        //$crud->edit_fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');
        //$crud->unset_edit_fields('idFaq', 'Administradores_idAdministrador');

        /* Cambiar el atributo type a un campo */
        // The field type is a string and can take the following options:
            // hidden      // set          // text       // enum         
            // invisible   // integer      // date       // string      
            // password    // true_false   // datetime   //readonly                           
        // $crud->field_type(campo, type, value);
        // Seccion titulos
        if ($this->uri->segment(3) == 'add') {
            $crud->field_type('estatusArbol', 'true_false');
        } else if ($this->uri->segment(3) == 'edit') {
            $crud->field_type('estatusArbol', 'true_false');
        }
        
        /* Habilitar un input como campos para subir archivos */
        $crud->set_field_upload('imagenArbol', 'images/arboles');

        /* Establecer los campos que son requeridos en los formularios */
        $crud->required_fields('imagenArbol', 'nombreComun', 'nombreCientifico', 'descripcion', 'existencia', 'estatusArbol', 'TiposArbol_idTipoArbol');

        /* Establecer las reglas de los formularios */
        // $crud->set_rules(campo, label, rule);

        /* Deshabilitar funciones */
        //$crud->unset_add();
        //$crud->unset_edit();
        //$crud->unset_read();
        //$crud->unset_delete();
        //$crud->unset_print();
        //$crud->unset_export();
        //$crud->unset_operations();
        //$crud->unset_back_to_list();
        //$crud->unset_texteditor(campo, 'full_text');
        $crud->unset_texteditor('descripcion', 'full_text');

        /* Condiciones para los datos a listar */
        // $crud->where(campo, valor_condicion);

        /* Ordenamiento de los datos a listar */
        // $crud->order_by(campo, direccion);
        $crud->order_by('nombreComun', 'ASC');

        /* Renderizar la tabla */
        $output = $crud->render();

        /* Variables para perzonalizar las paginas */
        // Titulo
        $output->title = "cPanel | Invernadero";
        // Clases para el menu lateral
        $output->activeAdopcion = "";
        $output->activeArbol = "active";
        $output->activeCampania = "";
        $output->activeComentario = "";
        $output->activeFaq = "";
        $output->activeUsuario = "";
        $output->activeQuienesSomos = "";
        // Seccion titulos
        if ($this->uri->segment(3) == '' || $this->uri->segment(3) == 'success') {
            $output->seccion = "Lista";
        } else if ($this->uri->segment(3) == 'read') {
            $output->seccion = "Viendo";
        } else if ($this->uri->segment(3) == 'add') {
            $output->seccion = "Agregando";
        } else if ($this->uri->segment(3) == 'edit') {
            $output->seccion = "Modificando";
        }

        /* Cargar las vistas */
        $this->load->view('template/backend/header',(array)$output);
        $this->load->view('backend/vw_invernadero.php',(array)$output);
        $this->load->view('template/backend/footer',(array)$output);
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

