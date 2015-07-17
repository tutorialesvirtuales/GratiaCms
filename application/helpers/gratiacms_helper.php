<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * GratiaCms Helper
 *
 * @package         GRATICMS
 * @subpackage      Helpers
 * @category        Helpers
 * @author          tutorialesvirtuales.com
 * @author          Roosevelt Guinand
 * @link            http://tutorialesvirtuales.com
 * @version         Current v1.0.0 
 * @copyright       Copyright (c) 2010 - 2015 tutorialesvirtuales
 * @license         MIT
 * @since           13/07/2015
 */

/**
 * Controlador
 * Retorna el nombre del controlador desde
 * el cual se hace la petición
 * @return String Nombre del controlador
 */
function controlador() {
    $CI = & get_instance();
    return $CI->router->class;
}

/**
 * Modelo
 * Retorna el nombre del modelo
 * asumiendo que el nombre del mismo 
 * corresponde al mismo nombre del
 * controlador desde el cual se hace
 * la petición. Se agrega al nombre 
 * del controlador el sufijo "_model".
 * @return String Nombre del modelo
 */
function modelo() {
    return ucfirst(controlador()) . '_model';
}

/**
 * Este método retorna un mensaje informativo
 * o de alerta al usuario, informandole si la acción
 * ejecuta fue realizada o se generó algún error.
 * a la última acción ejecutada
 * @param String $tipo Tipo de mensaje: "hecho" o "error"
 * @param string $accion Acción a informar: "crear", "actualizar" o "eliminar"
 * @return String Mensaje
 */
function mensaje_alerta($tipo, $accion) {
    $CI = & get_instance();
    switch ($tipo) {
        case 'hecho' :
            return $CI->session->set_flashdata('mensaje', '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                            . $CI->lang->line('mensaje_' . $tipo . '_' . $accion)
                            . '</div>'
            );
        case 'error' :
            return $CI->session->set_flashdata('mensaje', '<div class="alert alert-danger alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                            . $CI->lang->line('mensaje_' . $tipo . '_' . $accion)
                            . '</div>'
            );
    }
}

/**
 * Este método consulta si un menú
 * tiene menús hijos asociados
 * @param int $id Id del menú padre
 * @return Array Resultado de la consulta
 */
function getMenuHijos($id) {
    $CI = & get_instance();
    return $CI->db->where('menu_id', $id)->order_by('posicion', 'asc')->get('menu')->result();
}

/**
 * Metodo para agregar los campos de auditoria 
 * antes de crear un nuevo campo.
 * Este método se debe invocar asi:
 * Ej. $this->db->insert('permiso', beforeInsert($permiso));
 * @param String $dato array del input->post() a modificar.
 * @param String $eliminar_campo_nulo Se debe enviar falso si no se desea elminar de la variable $dato los campos cuyo valor sea 0 o Nulos
 * @return String Array del input->post() con los campos de auditoria añadidos.
 */
function beforeInsert($dato, $eliminar_campo_nulo = TRUE) {
    $CI = & get_instance();
    $dato['created_at'] = date('Y-m-d H:i:s', time());
    $dato['created_by'] = $CI->session->userdata('usuario_id');
    if ($eliminar_campo_nulo) {
        return nullData($dato);
    } else {
        return $dato;
    }
}

/**
 * Metodo para agregar los campos de auditoria 
 * antes de actualizar un registro.
 * Este método se debe invocar asi:
 * Ej. $this->db->insert('permiso', beforeUpdate($permiso));
 * @param String $dato Array del input->post() a modificar.
 * @param String $eliminar_campo_nulo Se debe enviar falso si no se desea elminar de la variable $dato los campos cuyo valor sea 0 o Nulos
 * @return String Array del input->post() con los campos de auditoria añadidos.
 */
function beforeUpdate($dato, $eliminar_campo_nulo = TRUE) {
    $CI = & get_instance();
    $dato['updated_at'] = date('Y-m-d H:i:s', time());
    $dato['updated_by'] = $CI->session->userdata('usuario_id');
    if ($eliminar_campo_nulo) {
        return nullData($dato);
    } else {
        return $dato;
    }
}

/**
 * Metodo para verificar los campos vacios que llegan por los
 * métodos create y update cambiandolos a NULL,
 * con esto se resuelve el problema de los campos relacionales 
 * que pueden llegar nulos.
 * @param $data
 * @return String Array con toda la data y los campos vacios convertidos a NULL
 */
function nullData($data) {
    if (is_array($data)) {
        $temporal = $data;
        $data = array();
        foreach ($temporal as $key => $value) {
            $data[$key] = !empty($value) ? $value : NULL;
        }
    }
    return $data;
}

/**
 * Crea la cache para la tabla 
 * desde la cual se solicita ejecutar esta función
 * hacer el cacheo de la tabla y método.
 * @param String $data Array del input->post() recibido.
 * @return Array Retorna la misma data que recibe sin modificar
 */
function activarCache($data) {
    $CI = & get_instance();
    $CI->db->cache_on();
    return $data;
}

/**
 * Borra la cache para la tabla 
 * desde la cual se solicita ejecutar esta función
 * borra el cacheo de la tabla y método.
 * @param String $data Array del input->post() recibido.
 * @return Array Retorna la misma data que recibe sin modificar
 */
function desactivarCache($data) {
    $CI = & get_instance();
    $CI->db->cache_off();
    return $data;
}

/**
 * Método para redimensionar una imagen
 * de acuerdo a los parametros recibidos.
 * @param string $pathO Path de origen de la imagen a redimensionar
 * @param string $pathD Path de destino de la imagen a redimensionar
 * @param int $width ancho de la imagen
 * @param int $height alto de la imagen
 * @return boolean
 */
function redimensionarImagen($pathO, $pathD, $width, $height) {
    $CI = & get_instance();
    $CI->load->library('image_lib');
    $config['source_image'] = $pathO;
    $config['new_image'] = $pathD;
    $config['maintain_ratio'] = TRUE;
    $config['width'] = $width;
    $config['height'] = $height;
    $CI->image_lib->clear();
    $CI->image_lib->initialize($config);
    if (!$CI->image_lib->resize()) {
        return FALSE;
    }
    return TRUE;
}

/**
 * Permite generar una cadena aleatoria del tamaño que venga como parametro
 * @param int $length
 * @return String
 */
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}