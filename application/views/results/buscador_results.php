<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014, British Columbia Institute of Technology
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
 * @package CodeIgniter
 * @author  EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright   Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license http://opensource.org/licenses/MIT  MIT License
 * @link    http://codeigniter.com
 * @since   Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getFieldValue')) {
    function getFieldValue($section, $field, $defaultValue = '') {
        if ($section == null) {
            return $defaultValue;
        }
        if (!isset($section->$field) OR $section->$field == null) {
            return $defaultValue;
        }
        return $section->$field;
    }
}

if (!function_exists('count_Arr')) {
    function count_Arr($object) {
        if (!isset($object)) {
            return 0;
        } 
        if (is_object($object)) {
            return 1;
        } else if (is_array($object)) {
            return count($object);
        }
        return 0;
    }
}

?>

<!-- RECORDS -->
<?php 
    if (!empty($buscadorResults)) {
        $numResults = count($buscadorResults);
        $containerMaxWidth = ($numResults > 1) ? '1400px' : '750px';
?>
        <div style="max-width: <?php echo $containerMaxWidth; ?>; margin: 0 auto; padding: 10px;">
            <div class="main_title">
                <h2><span>R</span>esultado</h2>
            </div>

            <div class="row">
                <?php
                foreach ($buscadorResults as $record) {
                    $idTipoTramite = (int) getFieldValue($record, 'id_tipo_tramite', 0);
                    $documentPdf = getFieldValue($record, 'nombre_archivo', '');
                    $columnClass = ($numResults > 1) ? 'col-lg-6 col-md-6 col-sm-12' : 'col-lg-12 col-md-12 col-sm-12';
                ?>          
                    <div class="<?php echo $columnClass; ?>" style="margin-bottom: 20px;">
                        <div class="strip_all_tour_list" style="margin-bottom: 0;">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="background: #ffffff;">
                                    <div class="tour_list_desc" style="height: auto; border-right: none; padding: 20px;">
                                        <div class="rating"></div>
                                        <h3><strong><?php echo getFieldValue($record, 'nombre_tramite'); ?></strong></h3>
                                        <p>
                                            TRÁMITE ELECTRÓNICO: <strong><?php echo getFieldValue($record, 'folio_inscripcion'); ?></strong> <br>
                                            <?php 
                                            $rawTipoDoc = getFieldValue($record, 'tipo_documento');
                                            $tipoDoc = (strtoupper(trim($rawTipoDoc)) === 'CANCELACION') ? 'CANCELACIÓN' : $rawTipoDoc;
                                            ?>
                                            TIPO DE DOCUMENTO: <strong><?php echo $tipoDoc; ?></strong> <br>
                                        </p>

                                        <?php 
                                        $pdfUrl = getTramiteDocumentUrl($idTipoTramite, $documentPdf, false, $rawTipoDoc); 
                                        ?>
                                        <?php if ($documentPdf !== '' && $pdfUrl !== ''): ?>
                                            <?php 
                                            $iframeUrl = $pdfUrl . '#view=FitH';
                                            ?>
                                            <div class="pdf-viewer-container" style="margin-top: 20px;">
                                                <div style="margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                                                    <span style="font-weight: bold; color: #333; font-size: 14px;">
                                                        <i class="icon-doc" style="font-size: 16px; margin-right: 5px; color: #e04f67;"></i> Documento:
                                                    </span>
                                                    <a href="<?php echo $pdfUrl; ?>" target="_blank" class="btn btn-xs btn-default" style="border: 1px solid #ccc; padding: 4px 10px; border-radius: 4px; background: #f9f9f9; text-decoration: none; color: #333;">
                                                        <i class="icon-resize-full"></i> Abrir en pestaña nueva
                                                    </a>
                                                </div>
                                                <div style="position: relative; width: 100%; height: 500px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; background-color: #eee;">
                                                    <iframe src="<?php echo $iframeUrl; ?>" width="100%" height="100%" style="border: none;" allowfullscreen>
                                                        Tu navegador no soporta la visualización de PDFs. Por favor, <a href="<?php echo $pdfUrl; ?>" target="_blank">descarga el archivo aquí</a>.
                                                    </iframe>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div style="margin-top: 20px; padding: 15px; background-color: #f9f9f9; border: 1px dashed #ccc; text-align: center; color: #999; border-radius: 4px; height: 550px; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                                <i class="icon-doc-text" style="font-size: 48px; color: #ccc; margin-bottom: 10px;"></i>
                                                <span>Sin documento adjunto o tipo de trámite no registrado para este folio.</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </div><!--End strip -->
                    </div>
                <?php 
                } /* foreach */
                ?>
            </div>
        </div>
<?php 
    } else {
?>  
        <div class="main_title">
            <h2><span>R</span>esultado</h2>
            <p style="margin-top: 20px;">No se encontraron registros.</p>
        </div>
<?php   
    }
?>               
<!-- RECORDS -->