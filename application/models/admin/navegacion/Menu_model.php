<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo que utiliza la libreria MY_Model para 
 * la gestión de la tabla menus.
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
class Menu_model extends MY_Model {

    /**
     * Nombre de la tabla gestionada por éste modelo
     * @var string
     */
    public $_table = 'menu';

    /**
     * Reglas de validación para la inserción
     * y actualización de datos en la tabla
     * @var array
     */
    public $validate = array(
        array('field' => 'menu_id', 'label' => 'Padre', 'rules' => 'trim|is_natural_no_zero'),
        array('field' => 'tipo_menu_id', 'label' => 'Tipo menú', 'rules' => 'trim|required|is_natural_no_zero'),
        array('field' => 'etiqueta', 'label' => 'Etiqueta', 'rules' => 'trim|required|max_length[25]'),
        array('field' => 'url', 'label' => 'Url', 'rules' => 'trim|required|max_length[100]'),
        array('field' => 'icono', 'label' => 'Icono', 'rules' => 'trim|max_length[35]')
    );

}