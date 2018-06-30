<?php
/**
* Clase con las funciones para interactuar con la base de datos - modulo faq
* En esta clase se encuentran métodos como:
*     - getAllFaqs()
*     - getSecciones()
* @autor Jonathan Jair Alfaro Sánchez
* @link [dirección_url_de_la_ubicacion]
* @package applications/models
*
* @version 1.0
* Creado el 15/06/2018 a las 05:24 pm
*
* @since Clase disponible desde la versión 1.0
* @deprecated Clase obsoleta en la versión 2.0
* @todo Realizar método para guardar,modificar y eliminar una faq.
*     - Getters
*     - Setters
*/
class Mdl_Faq extends CI_Model 
{
    private $_idFaq;
    private $_pregunta;
    private $_respuesta;
    private $_seccionFaq;
    
    public function __construct($id = null, $pregunta = null, $respuesta = null, $seccion = null) 
    {
        parent::__construct();
        $this->_idFaq = $id;
        $this->_pregunta = $pregunta;
        $this->_respuesta = $respuesta;
        $this->_seccionFaq = $seccion;
    }

    /**
    * Método que interactua con la base de datos con la tabla faqs para obtener todas las faq
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
	public function getAllFaqs()
	{
        $this->db->select('*');
        $this->db->from('faqs');
        $this->db->join('secciones_faq', 'idSeccionFaq = SeccionesFaq_idSeccionFaq');
        $this->db->order_by('nombreSeccion');
        $faqs = $this->db->get();

        /**
        * Condición que verifica si el resultado de la consulta anterior fue diferente a 0, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
        * 
        */
        if ($faqs->num_rows() != 0) {
            return $faqs->result();
        } else {
            return 0;
        }
    }

    /**
    * Método que interactua con la base de datos con la tabla secciones_faq para obtener todas las secciones
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
    public function getSecciones()
    {
        $this->db->select('*');
        $this->db->from('secciones_faq');
        $secciones = $this->db->get();

        /**
        * Condicion que determina el dato a retornar
        * Condición que verifica si el resultado de la consulta anterior trae datos, si se cumple retorna un arreglo con el resultado, si no se cumple retorna un 0
        * 
        */
        if ($secciones->num_rows() != 0) {
            return $secciones->result();
        } else {
            return 0;
        }
    }
}