<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extender el Core de Codeigniter, para crear un Master Controller
 *
 * @package         GRATICMS
 * @subpackage      CORE
 * @category        Controlador
 * @author          tutorialesvirtuales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 tutorialesvirtuales
 * @license         MIT
 * @since           13/07/2015
 */
class MY_Controller extends CI_Controller {

    public $controlador;
    public $titulo;
    public $url;
    public $vista;

    public function __construct() {
        parent::__construct();
        $this->controlador = controlador();
        $this->titulo = humanize($this->controlador);
    }

}
