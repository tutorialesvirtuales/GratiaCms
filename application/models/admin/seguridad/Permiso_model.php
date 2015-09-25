<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Modelo que utiliza la libreria MY_Model para 
 * la gestión de la tabla permiso.
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
 * @since           06/08/2015
 */
class Permiso_model extends MY_Model {

    /**
     * Nombre de la tabla gestionada por éste modelo
     * @var string
     */
    public $_table = 'permiso';

    /**
     * Reglas de validación utilizadas
     * por la libreria MY_Model
     * para la inserción y actualización
     * de datos en la tabla.
     * @var array
     */
    public $validate = array(
        array('field' => 'nombre', 'label' => 'Nombre', 'rules' => 'trim|required|max_length[50]|unique[permiso.nombre]'),
        array('field' => 'nombre_a_mostrar', 'label' => 'Nombre a mostrar', 'rules' => 'trim|required|max_length[45]|unique[permiso.nombre_a_mostrar]'),
        array('field' => 'observacion', 'label' => 'Observación', 'rules' => 'trim|required|max_length[200]'),
    );
}