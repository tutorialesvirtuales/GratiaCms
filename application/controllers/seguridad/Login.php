<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Método que consulta a los usuarios sus datos de acceso.
     * @return Mixed
     *          - Muestra una página para que el usuario ingrese su usuario y contraseña.
     *          - Si el usuario accede se le crea la session y se redirecciona al dashboard.
     *          - Si los datos no son validados le devuelve mensaje de error al usuario
     */
    public function index() {
        $this->load->view(THEME . TEMPLATELOGIN, array('contenido' => 'seguridad/login/index'));
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
