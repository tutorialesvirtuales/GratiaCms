<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Usuarios del sistema
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
 * @since           14/07/2015
 */
class Usuario extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/seguridad/' . modelo(), 'Modelo');
        $this->load->model('admin/seguridad/Rol_model');
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'admin/seguridad/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'admin/seguridad/' . $this->controlador . '/';
        /* END VARIABLES */
    }

    /**
     * Lista todos las usuarios de rol super-administrador
     * registrados en la DB.
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
     * Este método primero consulta si esta recibiendo datos via POST,
     * y si es así valida y guarda el registro del nuevo usuario super-administrador
     * en la tabla, de lo contrario carga el formulario para crear un nuevo registro
     * @return  Mixed 
     *          - Si recibe y valida los datos via POST redirecciona hacia el método Index
     *          - Si no carga la vista del formulario
     */
    public function crear() {
        $this->form_validation->set_rules($this->Modelo->validate);
        if ($this->form_validation->run() === TRUE) {
            $this->Modelo->crear(); //No utiliza el método insert de my_model
            mensaje_alerta('hecho', 'crear');
            redirect($this->url);
        } else {
            $data = array(
                'titulo' => 'Crear ' . $this->titulo,
                'contenido' => $this->vista . 'crear',
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }

    /**
     * Este método primero consulta si esta recibiendo datos via POST,
     * y si es así valida y actualiza el registro del usuario en la tabla,
     * de lo contrario carga el formulario para que el usuario 
     * edite el registro cuyo id se recibe como parametro.
     * @param   integer $id id del registro
     * @return  Mixed si recibe y valida los datos via POST
     *          redirecciona hacia el método Index
     *          de lo contrario carga la vista del formulario
     */
    public function actualizar($id = FALSE) {
        $this->form_validation->set_rules($this->Modelo->validate_update);
        if ($this->form_validation->run() === TRUE) {
            $this->Modelo->actualizar($id); //No utiliza el método update de my_model
            mensaje_alerta('hecho', 'actualizar');
            redirect($this->url);
        } else {
            $dato = $this->Modelo->getDato($id);
            $data = array(
                'titulo' => 'Actualizar ' . $this->titulo,
                'contenido' => $this->vista . 'crear',
                'data' => $dato ? $dato : show_404()
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }

    /**
     * Cambia un usuario de estado de acuerdo al estado recibido como parametro
     * @param Int $id
     * @param Int $estado
     * @return Redirect to Index
     */
    public function cambiar_estado($id = FALSE, $estado = NULL) {
        if ($id && $estado !== NULL) {
            $this->Modelo->update($id, array('estado' => $estado), TRUE);
            $estado === '0' ? mensaje_alerta('hecho', 'desactivar') : mensaje_alerta('hecho', 'activar');
            redirect($this->url);
        } else {
            show_404();
        }
    }

}
