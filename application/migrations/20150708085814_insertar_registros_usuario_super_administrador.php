<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Insertar_registros_usuario_super_administrador extends CI_Migration {

    /**
     * Corre la migración.
     * Inserta los usuarios y contraseñas
     * de los super_administradores
     * en la tabla usuario
     * @return void
     */
    public function up() {
        $pass = 'pass123|'; //Clave para acceder a la administración del software
        $password = sha1($pass);
        $passwordF = hash('sha256', $password);
        //Registros para insertar en la tabla usuario
        $datos = array(
            array('id' => '1', 'usuario' => 'gratia', 'password' => $passwordF),
        );
        foreach ($datos as $dato) {
            $array[] = array('id' => $dato['id'], 'usuario' => $dato['usuario'], 'password' => $dato['password'], 'estado' => 1, 'updated_at' => '0000-00-00 00:00:00', 'created_by' => '1', 'updated_by' => '0');
        }
        $this->db->insert_batch('usuario', $array);
        
        //Registros para insertar en la tabla Usuario_Rol
        $datos_usuario_rol = array(
            array('id' => '1', 'usuario_id' => 1, 'rol_id' => 1)
        );
        foreach ($datos_usuario_rol as $dato) {
            $new_array[] = array('id' => $dato['id'], 'usuario_id' => $dato['usuario_id'], 'rol_id' => $dato['rol_id'], 'updated_at' => '0000-00-00 00:00:00', 'created_by' => '1', 'updated_by' => '0');
        }
        $this->db->insert_batch('usuario_rol', $new_array);
    }

    /**
     * Revierte la migración.
     * Borra los registros de la tabla usuario. 
     * @return void
     */
    public function down() {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');//se desactiva la verificación de llaves foraneas
        $this->db->truncate('usuario_rol');// se borran los registros de la tabla
        $this->db->truncate('usuario');// se borran los registros de la tabla
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');//se activa nuevamente la verificación de llaves foraneas
    }

}
