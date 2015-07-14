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
                . '<button type="button" class="close" data-dismiss="alert"></button>';
        $this->_error_suffix = '</div>';
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
