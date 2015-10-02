<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Roles de los menus
 *
 * @package         GRATIACMS
 * @subpackage      Admin
 * @category        Controlador
 * @author          tutorialesvrituales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 Tutorialesvirtuales
 * @license         MIT
 * @since           25/08/2015
 */
class Menu_rol extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/navegacion/' . modelo(), 'Modelo');
        $this->load->model(array('admin/seguridad/Rol_model', 'admin/navegacion/Menu_model'));
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'admin/navegacion/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'admin/navegacion/' . $this->controlador . '/';
        /* END VARIABLES */
    }

    /**
     * Este método lista todos los menús y al lado de cada uno
     * un CheckBox para cada rol.
     * En caso de que un rol tenga acceso a un menú
     * el CheckBox debe estar activado en la columna de dicho rol.
     * Los menús asignados le apareceran al usuario al Iniciar sesion
     * de acuerdo a su rol.
     * @return      String vista
     */
    public function index() {
        $data = array(
            'titulo' => $this->titulo,
            'contenido' => $this->vista . 'index'
        );
        $this->load->view(THEME . TEMPLATE, $data);
    }

    /**
     * Método ajax que permite al usuario 
     * asignar un menú al rol deseado.
     * @return      void
     */
    public function crear() {
        if ($this->input->is_ajax_request()) {
            if ($this->Modelo->validar()) {
                $this->Modelo->crear();
            }
        } else {
            show_404();
        }
    }

}
