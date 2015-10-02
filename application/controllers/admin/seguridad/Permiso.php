<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Permisos del sistema
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
class Permiso extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/seguridad/' . modelo(), 'Modelo');
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'admin/seguridad/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'admin/seguridad/' . $this->controlador . '/';
        /* END VARIABLES */
    }

    /**
     * Lista todos los permisos registrados en la DB.
     * @return      String vista
     */
    public function index() {
        $data = array(
            'titulo' => $this->titulo,
            'contenido' => $this->vista . 'index',
        );
        $this->load->view(THEME . TEMPLATE, $data);
    }

    /**
     * Este método primero consulta si esta recibiendo datos via POST,
     * y si es así valida y guarda el registro del nuevo permiso en la tabla,
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
     * Este método primero consulta si esta recibiendo datos via POST,
     * y si es así valida y actualiza el registro del permiso en la tabla,
     * de lo contrario carga el formulario para que el usuario 
     * edite el registro cuyo id se recibe como parametro.
     * @param   integer $id id del registro
     * @return  Mixed si recibe y valida los datos via POST
     *          redirecciona hacia el método Index
     *          de lo contrario carga la vista del formulario
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
                'data' =>  $dato ? $dato : show_404()
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }
    
    /**
     * Éste método permite eliminar un permiso
     * Devuelve mensaje de error o exito en el borrado
     * @param       integer $id id del registro
     * @return      Redirect to index
     */
    public function eliminar($id = FALSE) {
        if ($this->Modelo->delete($id)) {
            mensaje_alerta('hecho', 'eliminar');
        } else {
            mensaje_alerta('error', 'eliminar');
        }
        redirect($this->url);
    }
    
    
    /**
     * Este metodo crea los archivos json
     * que almacenan los permisos para cada rol.
     * Esto para que posteriormente al ingresar
     * los usuarios al sistema puedan acceder a los menus
     * de acuerdo a los permisos de su rol.
     * @return Redirect hacia el index
     */
    public function crear_archivos(){
        $this->load->model('admin/seguridad/Rol_model');
        $roles = $this->Rol_model->get_all();
        $this->load->library('Permiso_gratiacms');
        foreach ($roles as $rol){
            $this->permiso_gratiacms->getPermisosByRol($rol->id);
        }
        mensaje_alerta('hecho', 'archivo_permiso');
        redirect('/');
    }

}
