<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta clase extiende la libreria de validación de codeigniter.
 *
 * @package         GRATIACMS
 * @subpackage      Libraries
 * @category        Libreria
 * @author          tutorialesvirtuales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 tutorialesvirtuales
 * @license         MIT
 * @since           13/07/2015
 */
class MY_Form_validation extends CI_Form_validation {

    /**
     * Contiene la Instancia CI
     * @var Instance
     */
    protected $CI;

    /**
     * Crea y retorna el marco html para mostrar las validaciones
     * Esta funcion permite hacer referencia a cualquier recurso CodeIgniter
     * cargado o cargar otras nuevas sin inicializar las clases cada vez.
     * @return void
     */
    public function __construct($rules = array()) {
        parent::__construct($rules);
        $this->CI = & get_instance(); // Permite acceder a los recursos nativos de codeigniter.
        $this->_error_prefix = '<div class="alert alert-danger">'
                . '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $this->_error_suffix = '</div>';
    }

    /**
     * Este metodo valida un campo único en una tabla
     * tanto para adición como actualización
     * de registros. 
     * Se crea debido a que la validación de 
     * codeigniter solo funciona en la adición.
     * @param type $value Valor que se desea validar
     * @param type $params Nombres de tabla y campo a validar separados por un "."
     * @return boolean Retorna TRUE Si pasa la validación, FALSE si falla.
     */
    public function unique($value, $params) {
        list($table, $field) = explode(".", $params, 2); //Se separan el nombre de la tabla y el del campo
        $this->CI->form_validation->set_message('unique', 'El Registro ' . $value . ' ya existe');
        if (!empty($table) && !empty($field)) {
            if ($this->CI->input->post('id')) {
                $this->CI->db->where('id !=', $this->CI->input->post('id'));
            }
            $this->CI->db->where($field, $value);
            $query = $this->CI->db->get($table)->row();
            if ($query)
                return FALSE;
            return TRUE;
        } else {
            show_error('Call to Form_validation::unique() failed, parameter not in "table.column" notation');
        }
    }

    /**
     * Este metodo valida varios campos únicos
     * en una misma tabla tanto para adición 
     * como para la actualización de registros. 
     * Se crea debido a que la validación de 
     * codeigniter a demas de funcionar solo 
     * para la adición de registros lo hace
     * para un solo campo.
     * @param array $params Nombre de tabla y campos separados por "."
     * @return boolean Retorna TRUE Si pasa la validación, FALSE si falla.
     */
    public function unique_varios($value, $params) {
        //El primer punto procede al nombre de la tabla.
        //La variable $table toma el nombre de la tabla.
        //La variable $field toma el nombre de los campos.
        $data = explode("*", $params, 2);
        $array = FALSE;
        if (count($data) > 1) {
            list($array, $params) = explode("*", $params, 2);
        }
        list($table, $field) = explode(".", $params, 2);
        $fields = explode(".", $field); //Se crea un array con los nombres de los campos a validar
        $this->CI->form_validation->set_message('unique_varios', 'Los datos ya existen en la base de datos'); //Mensaje de validación
        if (!empty($table) && !empty($field)) {
            if ($this->CI->input->post('id')) {
                $this->CI->db->where('id !=', $this->CI->input->post('id'));
            }
            foreach ($fields as $fieldF) {//Se asigna la variable $fieldF para cada campo.
                //Se hace un where para cada campo recibido como parametro
                if ($array) {
                    //Si el campo viene dentro de un array se toma el valor del campo de dentro de dicho array
                    $this->CI->db->where($fieldF, $this->CI->input->post($array[$fieldF]));
                } else {
                    //Si el campo no viene dentro de un array se toma el valor del campo recibido como parametro
                    $this->CI->db->where($fieldF, $this->CI->input->post($fieldF));
                }
            }
            $query = $this->CI->db->get($table);
            if ($query->row())
                return FALSE;
            return TRUE;
        } else {
            show_error('Call to Form_validation::unique_varios() failed, parameter not in "table.column" notation');
        }
    }

    /**
     * Este método extiende la libreria de validacion de codigniter
     * reemplazando la forma como se muestran los errores 
     * el sistema, en este caso se mostraran todos en la cabecera
     * en una ventana tipo alerta que se puede cerrar.
     * @return String Retorna un <li>Error de validación</li>
     */
    public function error_string($prefix = '', $suffix = '') {
        // No errrors, validation passes!
        if (count($this->_error_array) === 0) {
            return '';
        }

        if ($prefix == '') {
            $prefix = $this->_error_prefix;
        }

        if ($suffix == '') {
            $suffix = $this->_error_suffix;
        }

        // Genera el string del error
        $str = $prefix;
        foreach ($this->_error_array as $val) {
            if ($val != '') {
                $str .= '<li>' . $val . "</li>";
            }
        }

        return $str .=$suffix;
    }

}
