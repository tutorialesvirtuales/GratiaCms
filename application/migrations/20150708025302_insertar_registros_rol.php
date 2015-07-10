<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insertar_registros_rol extends CI_Migration {

    /**
     * Corre la migración.
     * Inserta los roles básicos del sistema
     * en la tabla rol
     * @return void
     */
    public function up() {
        $roles = array(
            array('descripcion' => 'SuperAdministrador', 'observacion' => 'Rol con todos los privilegios de la plataforma y admin/*.'),
            array('descripcion' => 'Registrado', 'observacion' => 'Permite a los usuarios loguearse en el sistema, y comentar, votar, etc'),
            array('descripcion' => 'Publicador', 'observacion' => 'Permite a un usuario poder publicar articulos en la plataforma'),
            array('descripcion' => 'Invitado', 'observacion' => 'Usuario general del sistema'),
        );
        foreach ($roles as $rol) {
            $array[] = array('descripcion' => $rol['descripcion'], 'observacion' => $rol['observacion'], 'updated_at'=> '0000-00-00 00:00:00', 'created_by' => '1', 'updated_by' => '0');
        }
        $this->db->insert_batch('rol',$array);
    }

    /**
     * Revierte la migración.
     * Borra los registros de la tabla rol. 
     * @return void
     */
    public function down() {
       $this->db->query('SET FOREIGN_KEY_CHECKS = 0');//se desactiva la verificación de llaves foraneas
        $this->db->truncate('rol');// se borran los registros de la tabla
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');//se activa nuevamente la verificación de llaves foraneas
    }

}
