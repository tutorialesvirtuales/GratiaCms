<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta libreria es la encargada de crear los archivos .json
 * con los permisos para cada rol.
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
 * @since           06/08/2015
 */
class Permiso_gratiacms {

    /**
     * Contiene la Instancia CI
     * @var Instance
     */
    protected $CI;

    /**
     * Esta funcion permite hacer referencia a cualquier recurso CodeIgniter
     * cargado o cargar otras nuevas sin inicializar las clases cada vez.
     *      * @return void
     */
    public function __construct() {
        $this->CI = & get_instance(); // Permite acceder a los recursos nativos de codeigniter.
    }

    /**
     * Consulta los permisos
     * para el rol recibido como parametro
     * Los arma en un array de los mismos
     * y luego apunta al método setArchivo
     * desde donde se crea el archivo Json
     * para el permiso solicitado
     * @param type $rol_id
     * @return boolean True si el rol posee permisos y crea los archivos, de lo contrario False
     */
    public function getPermisosByRol($rol_id) {
        $query = $this->CI->db
                ->select('P.id, P.nombre')
                ->from('permiso P')
                ->join('permiso_rol PR', 'PR.permiso_id = P.id AND PR.estado = 1 AND PR.rol_id=' . $rol_id)
                ->get()
                ->result();
        $permisos = array();
        if ($query) {
            $permisos = array();
            foreach ($query as $row) {
                $permisos[$row->nombre] = $row->id;
            }
        }
        $this->setArchivo($permisos, $rol_id);
    }

    /**
     * Crea el archivo Json con los permisos
     * @param Array $permisos
     * @param String $rol
     * @return boolean
     */
    private function setArchivo($permisos, $rol) {
        $json = json_encode($permisos);
        $file = FCPATH . 'assets/gratiacms/permisos/permiso_' . $rol . '.json';
        file_put_contents($file, $json);
        return TRUE;
    }

}
