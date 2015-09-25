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

$lang['upload_userfile_not_set'] = 'Imposible encontrar una variable post llamada userfile.';//Unable to find a post variable called userfile.
$lang['upload_file_exceeds_limit'] = 'El archivo subido excede el tamaño máximo permitido en el archivo de configuración de PHP.';//The uploaded file exceeds the maximum allowed size in your PHP configuration file.
$lang['upload_file_exceeds_form_limit'] = 'El archivo subido excede el tamaño máximo permitido por el formulario de envío.';//The uploaded file exceeds the maximum size allowed by the submission form.
$lang['upload_file_partial'] = 'El archivo no fue subido correctamente.';//The file was only partially uploaded.
$lang['upload_no_temp_directory'] = 'La carpeta temp no se encuentra.';//The temporary folder is missing
$lang['upload_unable_to_write_file'] = 'El archivo no se pudó escribir en el disco.';//The file could not be written to disk.
$lang['upload_stopped_by_extension'] = 'Extención de archivo no permitida.';//The file upload was stopped by extension
$lang['upload_no_file_selected'] = 'Usted no ha seleccionado un archivo para subir.';//You did not select a file to upload.
$lang['upload_invalid_filetype'] = 'El tipo de archivo que está intentando subir no es permitido.';//The filetype you are attempting to upload is not allowed
$lang['upload_invalid_filesize'] = 'El archivo que está intentando cargar es más grande de lo permitido.';//The file you are attempting to upload is larger than the permitted size.
$lang['upload_invalid_dimensions'] = 'La imagen que está intentando cargar no encaja en las dimensiones permitidas.';//The image you are attempting to upload doesn\'t fit into the allowed dimensions.
$lang['upload_destination_error'] = 'Se encontró un problema al intentar mover el archivo subido al destino final.';//A problem was encountered while attempting to move the uploaded file to the final destination
$lang['upload_no_filepath'] = 'La ruta para guardar el archivo no es valida.';//The upload path does not appear to be valid
$lang['upload_no_file_types'] = 'No ha especificado ningún tipo de archivo permitido.';//You have not specified any allowed file types
$lang['upload_bad_filename'] = 'El nombre de archivo ya existe en el servidor.';//The file name you submitted already exists on the server
$lang['upload_not_writable'] = 'La carpeta  de destino no parece tener permisos de escritura.';//The upload destination folder does not appear to be writable
