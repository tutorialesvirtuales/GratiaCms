<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extender el Core de Codeigniter, para crear un Master Controller
 *
 * @package         GRATICMS
 * @subpackage      Controller
 * @category        Controlador
 * @author          tutorialesvirtuales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 tutorialesvirtuales
 * @license         MIT
 * @since           13/07/2015
 */

class Migrations extends CI_Controller {

    /**
     * Carga de la libreria migration para toda la clase
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    /**
     * Éste método ejecuta la función up de las migraciones, a partir
     * de la última que se haya generado,
     * en caso de ser la primera vez que se ejecuta crea la tabla migrations
     * y corre la función UP en todas las versiones de la migración
     * @return boolean Informa si la migración fue exitosa o no.
     */
    public function index() {
        if ($this->migration->latest()) {
            $this->output->set_output('Migracion Completa');
        }
    }

    /**
     * Éste método ejecuta la función down para una
     * versión de la migración, lo anterior en caso de recibir
     * el número de la versión como parametro,
     * de lo contrario ejecuta la función down de todas las 
     * versiones de la migración
     * @return boolean Informa si el back de la migración fue exitoso o no.
     */
    public function back($id = NULL) {
        if ($this->migration->version($id)) {
            $this->output->set_output('Migracion Completa');
        }
    }

}
