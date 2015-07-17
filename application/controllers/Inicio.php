<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $data = array(
                'titulo' => 'Inicio ',
                'contenido' => 'welcome_message',
            );
        $this->load->view(THEME . TEMPLATE, $data);
    }

}
