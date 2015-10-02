<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los tipos de Menús del sistema
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
 * @since           24/08/2015
 */
class Tipo_menu extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/navegacion/' . modelo(), 'Modelo');
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'admin/navegacion/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'admin/navegacion/' . $this->controlador . '/';
        /* END VARIABLES */
    }

    /**
     * Lista todas los registros de la tabla consultada
     * utilizando la libreria datatable de Jquery
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
     * y si es así valida y crea el nuevo registro en la DB,
     * de lo contrario carga el formulario para crear un nuevo registro
     * @return  Mixed si recibe y valida los datos via POST
     *          redirecciona hacia el método Index
     *          de lo contrario carga la vista del formulario
     */
    public function crear() {
        if ($this->input->post() && $this->Modelo->insert($this->input->post())) {
            mensaje_alerta('hecho', 'crear');
            redirect($this->url);
        } else {
            $data = array(
                'titulo' => 'Crear ' . $this->titulo,
                'contenido' => $this->vista . 'crear'
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }

    /**
     * Este método primero consulta si estan recibiendo datos via POST,
     * y si es así valida y actualiza el registro en la DB,
     * de lo contrario carga el formulario para que el usuario edite el
     * registro cuyo id es recibido como parametro
     * @param   integer $id id del registro
     * @return  Mixed si recibe y valida los datos via POST
     *          redirecciona hacia el método Index
     *          de lo contrario carga la vista
     */
    public function actualizar($id = FALSE) {
        if ($this->input->post() && $this->Modelo->update($id, $this->input->post())) {
            mensaje_alerta('hecho', 'actualizar');
            redirect($this->url);
        } else {
            $dato = $this->Modelo->get($id);
            $data = array(
                'titulo' => 'Actualizar ' . $this->titulo,
                'contenido' => $this->vista . 'crear',
                'data' => $dato ? $dato : show_404()
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }

    /**
     * Éste método permite eliminar un registro
     * de la tabla gestionada en la DB
     * Devuelve mensaje de error o éxito en el borrado
     * @param       integer $id id del registro
     * @return      Redirect 
     */
    public function eliminar($id = FALSE) {
        if ($this->Modelo->delete($id)) {
            mensaje_alerta('hecho', 'eliminar');
        } else {
            mensaje_alerta('error', 'eliminar');
        }
        redirect($this->url);
    }

}
