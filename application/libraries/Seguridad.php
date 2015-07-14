<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta libreria es la encargada de la seguridad del sistema
 *
 * @package         GRATIACMS
 * @subpackage      Libraries
 * @category        Libreria
 * @author          tutorialesvrituales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 Tutorialesvirtuales
 * @license         MIT
 * @since           13/07/2015
 */
class Seguridad {

    /**
     * Contiene la Instancia CI
     * @var Instance
     */
    protected $CI;

    /**
     * Obliga al usuario a iniciar sesión si no lo ha hecho,
     * exepto que intente ingresar a los controladores migrations o login.
     * Si el usuario ya iniciado sesión y no intenta salir pero por url ingresa
     * al controlador login se retorna al dashboard.
     */
    public function __construct() {
        $this->CI = & get_instance(); // Permite acceder a los recursos nativos de codeigniter.
        $controller = $this->CI->router->class;
        $method = $this->CI->router->method;
        $is_login = $this->CI->session->userdata('user_login');
        if ($controller !== 'login' && $controller !== 'migrations' && $controller !== 'inicio' && !$is_login) {
            $this->CI->session->set_userdata('peticion_url', current_url());
            redirect('seguridad/login');
        } else if ($controller === 'login' && $is_login && $method != 'salir') {
            redirect('/');
        }
        $this->checkPermisos($controller, $method, $this->CI->session->userdata('rol_id'));
    }

    /**
     * Consulta si los datos recibidos como usuario
     * y contraseña son validos y si es así apunta
     * al método privado setSession donde se crea
     * la sessión con el resultado de la consulta.
     * @return boolean
     */
    public function crearSession() {
        $passwordF = hash('sha256', sha1($this->CI->input->post('password')));
        $query = $this->CI->db
                        ->select('U.* , UR.rol_id, R.descripcion rol')
                        ->from('usuario U')
                        ->join('usuario_rol UR', 'UR.usuario_id = U.id')
                        ->join('rol R', 'R.id = UR.rol_id')
                        ->where('U.usuario', $this->CI->input->post('usuario'))
                        ->where('U.password', $passwordF)
                        ->where('U.estado', 1)
                        ->get()->row();
        if ($query && $this->SetSession($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Crea la sessión a partir del array recibido.
     * @param Array $query Valores a insertar en la variable de sesión
     * @return boolean
     */
    private function SetSession($query) {
        $data = array(
            'user_login' => TRUE,
            'usuario_id' => $query->id,
            'usuario' => $query->usuario,
            'rol_id' => $query->rol_id,
            'rol' => $query->rol,
        );
        $this->CI->session->set_userdata($data);
        return TRUE;
    }

    /**
     * Este metodo verifica si el rol del usuario logueado
     * tiene los permisos para acceder al controlador y metodo
     * recibidos como parametro, exepto que:::
     *  a. La petición sea hecha por ajax
     *  b. El rol del usuario sea super_administrador 
     *  c. Los controladores: home, login y migrations.
     * @param String $controlador Nombre del controlador
     * @param String $metodo Nombre del Método
     * @param Int $rol_id Id del rol.
     * @return Mixed
     *              - Boolean TRUE si tiene los permisos
     *              - Redirect si no tiene los permisos lo redirecciona al home
     */
    private function checkPermisos($controlador, $metodo, $rol_id) {
        if ($rol_id === '1' OR $this->CI->input->is_ajax_request() OR $controlador === 'inicio' OR $controlador === 'login' OR $controlador === 'migrations') {
            return TRUE;
        }
        if ($rol_id !== '1' AND $this->CI->uri->segment(1) !== 'admin') {
            $permiso = $controlador . '@' . $metodo;
            $file = FCPATH . 'assets/gratiacms/permisos/permiso_' . $this->CI->session->userdata('rol_id') . '.json';
            $permisos = json_decode(file_get_contents($file), true);
            if (isset($permisos[$permiso])) {
                return TRUE;
            } else {
                redirect('/');
            }
        } else {
            redirect('/');
        }
    }

}
