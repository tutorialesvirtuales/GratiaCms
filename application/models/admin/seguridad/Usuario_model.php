<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo que utiliza la libreria MY_Model para 
 * la gestión de la tabla usuario.
 * Es utilizada para crear los usuarios del sistema
 *
 * @package         GRATIACMS
 * @subpackage      Admin
 * @category        Modelo
 * @author          tutorialesvirtuales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 tutorialesvirtuales
 * @license         MIT
 * @since           14/07/2015
 */
class Usuario_model extends MY_Model {

    /**
     * Nombre de la tabla gestionada por éste modelo
     * @var string
     */
    public $_table = 'usuario';

    /**
     * Reglas de validación utilizadas
     * por la libreria MY_Model
     * para la inserción de datos en la tabla.
     * @var array
     */
    public $validate = array(
        array('field' => 'usuario', 'label' => 'Usuario', 'rules' => 'trim|required|max_length[20]|unique[usuario.usuario]'),
        array('field' => 'password', 'label' => 'Contraseña', 'rules' => 'trim|required|min_length[5]|max_length[20]'),
        array('field' => 're_password', 'label' => 'Verifique Contraseña', 'rules' => 'trim|required|matches[password]'),
        array('field' => 'estado', 'label' => 'Estado', 'rules' => 'trim|required|is_natural'),
        array('field' => 'rol_id', 'label' => 'Rol', 'rules' => 'trim|required'),
    );

    /**
     * Reglas de validación utilizadas
     * por la libreria MY_Model
     * para la actualización de datos en la tabla.
     * @var array
     */
    public $validate_update = array(
        array('field' => 'usuario', 'label' => 'Usuario', 'rules' => 'trim|required|unique[usuario.usuario]'),
        array('field' => 'password', 'label' => 'Contraseña', 'rules' => 'trim|min_length[5]|max_length[10]'),
        array('field' => 're_password', 'label' => 'Verifique Contraseña', 'rules' => 'trim|min_length[5]|matches[password]'),
        array('field' => 'estado', 'label' => 'Estado', 'rules' => 'trim|required|is_natural'),
        array('field' => 'rol_id', 'label' => 'Rol', 'rules' => 'trim|required')
    );

    /**
     * Este método consulta todos los usuarios
     * y su relación con la tabla usuario_rol
     * @return array Todos los grados
     */
    public function getAll() {
        return $this->db
                        ->select('U.*, UR.rol_id, R.descripcion')
                        ->from($this->_table . ' U')
                        ->join('usuario_rol UR', 'UR.usuario_id = U.id')
                        ->join('Rol R', 'R.id = UR.rol_id')
                        ->get()
                        ->result();
    }

    /**
     * Retorna el registro del usuario solicitado,
     * @param Int $id id del usuario
     * @return String Array
     */
    public function getDato($id) {
        return $this->db
                        ->select('U.*, UR.rol_id')
                        ->from($this->_table . ' U')
                        ->join('usuario_rol UR', 'UR.usuario_id = U.id AND U.id= '.$id)
                        ->get()
                        ->row();
    }

    /**
     * Se crea el usuario en la tabla usuario,
     * y su respectiva relación en las tablas:
     *  - usuario_rol
     * @return Boolean
     */
    public function crear() {
        $data = array(
            'usuario' => $this->input->post('usuario'),
            'email' => $this->input->post('email'),
            'password' => hash('sha256', sha1($this->input->post('password'))),
            'estado' => $this->input->post('estado')
        );
        $this->db->insert('usuario', beforeInsert($data));
        $usuario_id = $this->db->insert_id();
        /*
         * Se crea el rol para la persona
         */

        $this->db->insert('usuario_rol', beforeInsert(array('usuario_id' => $usuario_id, 'rol_id' => $this->input->post('rol_id'))));
        return TRUE;
    }

    /**
     * Método para actualizar el registro del
     * usuario y reasignar.
     * @param Int $id
     * @return Boolean
     */
    public function actualizar($id) {
        $data = array(
            'usuario' => $this->input->post('usuario'),
            'email' => $this->input->post('email'),
            'estado' => $this->input->post('estado')
        );
        if ($this->input->post('password'))
            $data['password'] = hash('sha256', sha1($this->input->post('password')));
        $this->db->where('id', $id)->update('usuario', beforeUpdate($data));
        $this->db->where('usuario_id', $id)->update('usuario_rol', beforeUpdate(array('rol_id' => $this->input->post('rol_id')))); //se actualiza el rol
        return TRUE;
    }

}
