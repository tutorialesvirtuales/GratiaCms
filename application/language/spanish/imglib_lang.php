<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['imglib_source_image_required'] = 'Debe especificar una imagen de origen en sus preferencias.';
$lang['imglib_gd_required'] = 'Se requiere que la biblioteca de imágenes GD para esta función.';
$lang['imglib_gd_required_for_props'] = 'El servidor debe apoyar la biblioteca de imágenes GD para determinar las propiedades de imagen.';
$lang['imglib_unsupported_imagecreate'] = 'Su servidor no soporta la función GD requerido para procesar este tipo de imagen.';
$lang['imglib_gif_not_supported'] = 'Las imágenes GIF a menudo no son compatibles debido a restricciones de licencia. Puede que tenga que usar JPG o PNG en su lugar.';
$lang['imglib_jpg_not_supported'] = 'Imágenes JPG no son compatibles.';
$lang['imglib_png_not_supported'] = 'Imágenes PNG no son compatibles.';
$lang['imglib_jpg_or_png_required'] = 'El protocolo de cambio de tamaño de imagen especificado en las preferencias sólo funciona con JPEG o PNG tipos de imágenes.';
$lang['imglib_copy_error'] = 'Se ha producido un error al intentar reemplazar el archivo. Por favor, asegúrese de que su directorio de archivos se puede escribir.';
$lang['imglib_rotate_unsupported'] = 'Rotación de la imagen no aparece con el apoyo de su servidor.';
$lang['imglib_libpath_invalid'] = 'El camino a la biblioteca de la imagen no es correcto. Por favor, establecer la ruta correcta en las preferencias de imagen.';
$lang['imglib_image_process_failed'] = 'El procesamiento de imágenes falló. Por favor, compruebe que su servidor soporta el protocolo elegido y que el camino a la biblioteca de la imagen es correcta.';
$lang['imglib_rotation_angle_required'] = 'An angle of rotation is required to rotate the image.';
$lang['imglib_invalid_path'] = 'La ruta de la imagen no es correcta.';
$lang['imglib_copy_failed'] = 'Falló la rutina de copia de la imagen.';
$lang['imglib_missing_font'] = 'Imposible encontrar un tipo de letra a utilizar.';
$lang['imglib_save_failed'] = 'No se puede guardar la imagen. Por favor, asegúrese de que la imagen y el directorio de archivos se pueden escribir.';
