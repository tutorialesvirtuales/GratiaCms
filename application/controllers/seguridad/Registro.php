<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los registro de usuarios del sistema
 *
 * @package         GRATIACMS
 * @subpackage      Seguridad
 * @category        Controlador
 * @author          tutorialesvrituales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 Tutorialesvirtuales
 * @license         MIT
 * @since           14/07/2015
 */
class Registro extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->vista = 'seguridad/' . $this->controlador . '/';
    }

    /**
     * Método que consulta a los usuarios sus datos de acceso.
     * @return Mixed
     *          - Muestra una página para que el usuario se registre.
     */
    public function index() {
        
    }


}
