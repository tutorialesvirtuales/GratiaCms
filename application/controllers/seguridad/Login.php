<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Menús del sistema
 *
 * @package         GRATIACMS
 * @subpackage      Seguridad
 * @category        Controlador
 * @author          tutorialesvrituales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 Tutorialesvirtuales
 * @license         MIT
 * @since           14/07/2015
 */
class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->vista = 'seguridad/' . $this->controlador . '/';
    }

    /**
     * Método que consulta a los usuarios sus datos de acceso.
     * @return Mixed
     *          - Muestra una página para que el usuario ingrese su usuario y contraseña.
     *          - Si el usuario accede se le crea la session y se redirecciona al dashboard.
     *          - Si los datos no son validados le devuelve mensaje de error al usuario
     */
    public function index() {
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|callback__verificar_usuario');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required');
        $this->form_validation->set_message('_verificar_usuario', 'Usuario o Contraseña incorrecta');
        if ($this->form_validation->run()) {
            if ($this->seguridad->crearSession()) {
                redirect($this->session->userdata('peticion_url'));
            }
        } else {
            $this->load->view(THEME . TEMPLATELOGIN, array('contenido' => $this->vista . 'index'));
        }
    }

    /**
     * Método para validar si el usuario y
     * contraseña recibidos coinciden en la DB
     * @return boolean
     */
    public function _verificar_usuario() {
        $passwordF = hash('sha256', sha1($this->input->post('password')));
        $query = $this->db
                ->where('usuario', $this->input->post('usuario'))
                ->where('password', $passwordF)
                ->where('estado', 1)
                ->get('usuario');
        if ($query->num_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /**
     * Método para Cerrar Sesión
     * Destruye la sesión actual del usuario
     * @return Redirect al index
     */
    public function salir() {
        $this->session->sess_destroy();
        redirect('seguridad/login');
    }

}
