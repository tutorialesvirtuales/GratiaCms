<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Esta libreria es la encargada de crear los archivos .json
 * con los menus para cada rol.
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
 * @since           24/08/2015
 */
class Menu_gratiacms {

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
     * Metodo invocado desde el controlador menu
     * que se encarga de hacer la consulta en la tabla menu_rol y posteriormente
     * hacer todo el proceso para crear el archivo con los menus
     * @param int $rol_id Id del rol al cual se le desea crear el archivo con los menus
     * @return boolean Retorna TRUE si crea el archivo correctamente, FALSE si falla.
     */
    public function getMenuByRol($rol_id, $tipo) {
        $query = $this->CI->db
                ->select('M.id,M.menu_id,M.etiqueta,M.url,M.posicion,M.icono')
                ->from('menu M')
                ->join('menu_rol MR', 'MR.menu_id = M.id')
                ->where('MR.estado', 1)
                ->where('MR.rol_id', $rol_id)
                ->where('M.tipo_menu_id', $tipo)//Tipo menu principal
                ->group_by('M.id')
                ->order_by('M.posicion', 'asc')
                ->order_by('M.etiqueta', 'asc')
                ->get()
                ->result();
        if ($query) {
            $menu = $this->setMenu($query);
            $this->setArchivo($menu, $rol_id, $tipo);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Metodo privado que crea el array con los menus originales
     * y los menus de los predecesores
     * @param type array menús que se desean armar en JSON.
     * @return array Json con los menús asignados al rol
     */
    private function setMenu($query) {
        $menu = array();
        foreach ($query as $row) {
            $menu['predecesor'][$row->menu_id][] = array(
                'id' => $row->id,
                'etiqueta' => $row->etiqueta,
                'url' => $row->url,
                'icono' => $row->icono
            );
            $menu['original'][$row->id] = array(
                'id' => $row->id,
                'menu_id' => $row->menu_id,
                'etiqueta' => $row->etiqueta,
                'url' => $row->url,
                'icono' => $row->icono,
            );
        }
        return $menu;
    }

    /**
     * Metodo privado que se encarga de crear el archivo con
     * la correspondiente informacion
     * @param array $menu Menús armados en un array json y listos para almacenarse en el archivo.
     * @param int $rol Id del rol al cual se le desea crear el archivo con los menus
     * @return boolean TRUE
     */
    private function setArchivo($menu, $rol, $tipo) {
        if (!file_exists(FCPATH . 'assets/gratiacms/menus/' . $tipo)) {
            mkdir(FCPATH . 'assets/gratiacms/menus/' . $tipo, 0755, true);
        }
        $json = json_encode($menu);
        $file = FCPATH . 'assets/gratiacms/menus/' . $tipo . '/menu_' . $rol . '.json';
        file_put_contents($file, $json);
        return TRUE;
    }

}
