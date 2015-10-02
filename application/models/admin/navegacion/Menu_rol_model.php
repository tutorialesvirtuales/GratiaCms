<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo que utiliza la libreria MY_Model para 
 * la gestión de la tabla menus_rol.
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
 * @since           24/08/2015
 */
class Menu_rol_model extends CI_Model {

    /**
     * Este metodo se utiliza para validar
     * la inserción y actualización de datos
     * de la tabla menu_rol
     * @return boolean TRUE si pasa la validación, FALSE si falla.
     */
    public function validar() {
        $reglas = array(
            array('field' => 'rol_id', 'label' => 'Rol', 'rules' => 'trim|required|is_natural_no_zero'),
            array('field' => 'menu_id', 'label' => 'Menú', 'rules' => 'trim|required|is_natural_no_zero'),
            array('field' => 'estado', 'label' => 'Estado', 'rules' => 'trim|is_natural')
        );
        $this->form_validation->set_rules($reglas);
        if ($this->form_validation->run())
            return TRUE;
        return FALSE;
    }

    /**
     * Retorna un array por cada registro de la tabla menu_rol
     * con el id del menu y el id del rol como claves 
     * y el valor registrado en el campo estado como resultado
     * @return Array
     */
    public function getAll() {
        $query = $this->db
                ->select('MR.*')
                ->from('menu_rol MR')
                ->join('menu M', 'M.id = MR.menu_id')
                ->join('rol R', 'R.id = MR.rol_id')
                ->get()
                ->result();
        $data = array();
        if ($query) {
            foreach ($query as $row) {
                $data[$row->menu_id][$row->rol_id] = $row->estado;
            }
        }
        return $data;
    }

    /**
     * Este método crea o actualiza
     * un registro en la tabla menu_rol
     * de acuerdo al menu y el rol recibidos,
     * si ya existe un registro coincidente
     * con los valores recibidos se actualiza el registro
     * de lo contrario se crea un nuevo registro.
     * @return boolean
     */
    public function crear() {
        $data = array(
            'rol_id' => $this->input->post('rol_id'),
            'menu_id' => $this->input->post('menu_id'),
            'estado' => $this->input->post('estado'),
        );
        /*
         * consulta si ya existe un registro creado para 
         * el menu-rol
         */
        $query = $this->db
                ->where('menu_id', $this->input->post('menu_id'))
                ->where('rol_id', $this->input->post('rol_id'))
                ->get('menu_rol')
                ->row();
        if ($query) {
            //actualiza el registro existente
            return $this->db->where('id', $query->id)->update('menu_rol', beforeUpdate($data));
        } else {
            //crea un nuevo registro.
            return $this->db->insert('menu_rol', beforeInsert($data));
        }
    }

}
