<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Permisos del sistema
 *
 * @package         GRATIACMS
 * @subpackage      PUBLICACION
 * @category        Controlador
 * @author          tutorialesvrituales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 Tutorialesvirtuales
 * @license         MIT
 * @since           06/08/2015
 */
class Nueva extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'publicacion/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'publicacion/' . $this->controlador . '/';
        /* END VARIABLES */
    }

    /**
     * Lista todos los permisos registrados en la DB.
     * @return      String vista
     */
    public function index() {
        $data = array(
            'titulo' => $this->titulo,
            'contenido' => $this->vista . 'index'
        );
        $this->load->view(THEME . TEMPLATE, $data);
    }

}
