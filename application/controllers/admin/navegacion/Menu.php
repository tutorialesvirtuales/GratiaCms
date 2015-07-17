<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controlador que permite gestionar los Menús del sistema
 *
 * @package         GRATIACMS
 * @subpackage      Admin
 * @category        Controlador
 * @author          tutorialesvrituales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 Tutorialesvirtuales
 * @license         MIT
 * @since           13/07/2015
 */
class Menu extends MY_Controller {

    /**
     * Permite la carga de los Modelos a ser usuados, en los diferentes metodos de la clase 
     * e inicializar las variables que permiten dinamizar el desarrollo
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('admin/navegacion/' . modelo(), 'Modelo');
        $this->load->model('admin/navegacion/Tipo_menu_model');
        /* VARIABLES PARA DINAMIZAR */
        $this->url = base_url() . 'admin/navegacion/' . str_replace('_', '-', $this->controlador) . '/';
        $this->vista = 'admin/navegacion/' . $this->controlador . '/';
        /* END VARIABLES */
    }

    /**
     * Lista todos los menús registrados en la DB
     * utilizando la libreria nestable de Jquery
     * @return      String vista
     */
    public function index($tipo_menu) {
        $data = array(
            'titulo' => $this->titulo,
            'contenido' => $this->vista . 'index',
            'datas' => $this->Modelo->order_by('posicion', 'asc')->get_many_by(array('tipo_menu_id' => $tipo_menu, 'menu_id IS NULL')),
            'tipo_menu' => $tipo_menu,
        );
        $this->load->view(THEME . TEMPLATE, $data);
    }

    /**
     * Este método primero consulta si esta recibiendo datos via POST,
     * si es así valida y guarda los datos en la DB,
     * de lo contrario carga el formulario para crear un nuevo registro
     * @return  Mixed de acuerdo al caso, 
     *          si recibe y valida los datos via POST
     *          redirecciona hacia el método Index
     *          de lo contrario carga la vista
     */
    public function crear($tipo_menu) {
        if ($this->input->post() && $this->Modelo->insert($this->input->post())) {
            mensaje_alerta('hecho', 'crear');
            redirect($this->url.$tipo_menu);
        } else {
            $data = array(
                'titulo' => 'Crear ' . $this->titulo,
                'contenido' => $this->vista . 'crear',
                'tipo_menu' => $tipo_menu,
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }

    /**
     * Este método primero consulta si esta recibiendo datos via POST,
     * si es así valida y actualiza el registro en la DB,
     * de lo contrario carga el formulario para que el usuario edite el
     * registro cuyo id es recibido por parametro
     * @param   integer $id id del registro
     * @return  Mixed de acuerdo al caso, 
     *          si recibe y valida los datos via POST
     *          redirecciona hacia el método Index
     *          de lo contrario carga la vista
     */
    public function actualizar($id = FALSE, $tipo_menu = FALSE) {
        if ($this->input->post() && $this->Modelo->update($id, $this->input->post())) {
            mensaje_alerta('hecho', 'actualizar');
            redirect($this->url.$tipo_menu);
        } else {
            $dato = $this->Modelo->get($id);
            $data = array(
                'titulo' => 'Actualizar ' . $this->titulo,
                'contenido' => $this->vista . 'crear',
                'data' => $dato ? $dato : show_404(),
                'tipo_menu' => $tipo_menu,
            );
            $this->load->view(THEME . TEMPLATE, $data);
        }
    }

    /**
     * Éste método permite eliminar el registro de un menu
     * Devuelve mensaje de error o exito en el borrado
     * @param       integer $id id del registro
     * @return      Redirect to index
     */
    public function eliminar($id = FALSE) {
        if ($this->Modelo->delete($id)) {
            mensaje_alerta('hecho', 'eliminar');
        } else {
            mensaje_alerta('error', 'eliminar');
        }
        redirect($this->url);
    }

    /**
     * Metodo llamado via ajax
     * Éste método permite al usuario utilizando
     * la libreria nestable de Jquery cambiar la posición
     * de un menú, ademas de poder asignarle, cambiar, 
     * o quitar un menú padre en caso de ser necesario.
     * @return void
     */
    public function guardar() {
        if ($this->input->is_ajax_request()) {
            $json = $this->input->post('menu');
            $menus = json_decode($json);
            foreach ($menus as $var => $value) {
                $this->db->where('id', $value->id)->update('menu', array('menu_id' => NULL, 'posicion' => $var + 1));
                if (!empty($value->children)) {
                    foreach ($value->children as $key => $vchild) {
                        $update_id = $vchild->id;
                        $parent_id = $value->id;
                        $this->db->where('id', $update_id)->update('menu', array('menu_id' => $parent_id, 'posicion' => $key + 1));

                        if (!empty($vchild->children)) {
                            foreach ($vchild->children as $key => $vchild1) {
                                $update_id = $vchild1->id;
                                $parent_id = $vchild->id;
                                $this->db->where('id', $update_id)->update('menu', array('menu_id' => $parent_id, 'posicion' => $key + 1));

                                if (!empty($vchild1->children)) {
                                    foreach ($vchild1->children as $key => $vchild2) {
                                        $update_id = $vchild2->id;
                                        $parent_id = $vchild1->id;
                                        $this->db->where('id', $update_id)->update('menu', array('menu_id' => $parent_id, 'posicion' => $key + 1));

                                        if (!empty($vchild2->children)) {
                                            foreach ($vchild2->children as $key => $vchild3) {
                                                $update_id = $vchild3->id;
                                                $parent_id = $vchild2->id;
                                                $this->db->where('id', $update_id)->update('menu', array('menu_id' => $parent_id, 'posicion' => $key + 1));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Este metodo crea los archivos json
     * que almacenan los menus para cada rol.
     * Esto para que posteriormente al ingresar
     * los usuarios al sistema visualicen los menus
     * del archivo correspondiente a su rol.
     * @return Redirect hacia el index
     */
    public function crear_archivos() {
        $this->load->model('admin/seguridad/Rol_model');
        $roles = $this->Rol_model->get_all();
        $this->load->library('Menu_sih');
        $tipos = $this->Tipo_menu_model->get_all();
        foreach ($tipos as $tipo) {
            $archivos = glob(FCPATH . 'assets/gratiacms/menus/' . $tipo->id . '/*.json');
            foreach ($archivos as $archivo) {
                unlink($archivo);
            }
            foreach ($roles as $rol) {
                $this->menu_sih->getMenuByRol($rol->id, $tipo->id);
            }
        }
        mensaje_alerta('hecho', 'archivo_menu');
        redirect('/');
    }

}
