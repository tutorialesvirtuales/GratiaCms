<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Permisos por rol del sistema
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
 * @since           06/08/2015
 */
class Permiso_rol extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/seguridad/' . modelo(), 'Modelo');
        $this->load->model(array('admin/seguridad/Rol_model', 'admin/seguridad/Permiso_model'));
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'admin/seguridad/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'admin/seguridad/' . $this->controlador . '/';
        /* END VARIABLES */
    }


    /**
     * Este método lista todos los permisos y al lado de cada uno
     * un CheckBox para cada rol.
     * En caso de que un rol tenga acceso a un menú
     * el CheckBox debe estar activado en la columna de dicho rol.
     * Los roles asignados permitirán al usuario acceder a los métodos
     * de los distintos permisos.
     * @return      String vista
     */
    public function index() {
        $data = array(
            'titulo' => $this->titulo,
            'contenido' => $this->vista . 'index',
            'rols' => $this->Rol_model->get_all(),
            'permisos' => $this->Permiso_model->order_by('nombre','asc')->get_all(),
            'permiso_rol' => $this->Modelo->getAll(),
            'breads' => array(array('ruta' => 'javascript:;', 'titulo' => $this->titulo))
        );
        $this->load->view(THEME . TEMPLATE, $data);
    }

    
    /**
     * Método ajax que permite al usuario 
     * asignar un permiso al rol deseado.
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
