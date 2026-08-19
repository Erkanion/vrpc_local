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
 * @package    CodeIgniter
 * @author     EllisLab Dev Team
 * @copyright  Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright  Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT MIT License
 * @link       http://codeigniter.com
 * @since      Version 1.0.0
 * @filesource
 */

defined('BASEPATH') OR exit('No direct script access allowed');

function getFieldValue($section, $field, $defaultValue = '')
{
    if (!is_object($section)) {

        if ($defaultValue == 'TODAY') {

            return date('d/m/Y');

        } else {

            return $defaultValue;
        }
    }

    if (!isset($section->$field) || $section->$field == null) {

        if ($defaultValue == 'TODAY') {

            return date('d/m/Y');

        } else {

            return $defaultValue;
        }
    }

    return $section->$field;
}

function count_Arr($object)
{
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
?>

<!-- RECORDS -->
<?php
if ($puntosResults !== null) {
?>

    <div class="main_title">

        <h2>
            <span>R</span>esultados
        </h2>

    </div>

<?php
    foreach ($puntosResults as $record) {
?>

        <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">

            <div class="row">

                <div class="clearfix visible-xs-block"></div>

                <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">

                    <div class="tour_list_desc">

                        <div class="rating"></div>

                        <h3>
                            <strong>
                                <?php echo getFieldValue($record, 'concesionario'); ?>
                            </strong>
                        </h3>

                        <p>

                            FOLIO DE INSCRIPCIÓN:
                            <strong>
                                <?php echo getFieldValue($record, 'folio_inscripcion'); ?>
                            </strong>
                            <br>

                            FECHA DE INSCRIPCIÓN:
                            <strong>
                                <?php echo getFieldValue($record, 'fecha_inscripcion'); ?>
                            </strong>
                            <br>

                            FOLIO DE INSCRIPCIÓN ANTERIOR:
                            <strong>
                                <?php echo getFieldValue($record, 'fol_inscrip_ant'); ?>
                            </strong>
                            <br>

                            PERIODO:
                            <strong>
                                <?php echo getFieldValue($record, 'periodo'); ?>
                            </strong>
                            <br>

                            SERVICIOS DE INTERCONEXIÓN:
                            <br>

                            <strong>
                                <?php echo getFieldValue($record, 'servicios_interconexion'); ?>
                            </strong>
                            <br>

                            OBSERVACIONES:
                            <br>

                            <strong>
                                <?php echo getFieldValue($record, 'observaciones'); ?>
                            </strong>
                            <br>

                        </p>

                        <!-- verificar estilo de este nuevo div -->

                        <div class="col-lg-6 col-md-6 col-sm-6">

                            <table>

                                <thead>

                                    <tr>
                                        <th>Folio electrónico</th>
                                    </tr>

                                </thead>

                                <tbody>

<?php
                                    $listFets = $record->fets ?? [];

                                    // Normalizar a array
                                    if (is_object($listFets)) {

                                        $listFets = [$listFets];
                                    }
?>

<?php if (!empty($listFets)): ?>

<?php foreach ($listFets as $fet): ?>

                                        <tr>

                                            <td>

                                                <a href="#"
                                                   onclick="displayDetail(
                                                       event,
                                                       <?= $fet->idConcesion ?>
                                                   );">

                                                    <?= $fet->fet; ?>

                                                </a>

                                            </td>

                                        </tr>

<?php endforeach; ?>

<?php else: ?>

                                        <tr>

                                            <td>
                                                No hay documentos disponibles
                                            </td>

                                        </tr>

<?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- documentos -->
                <div class="col-lg-3 col-md-3 col-sm-3">

<?php
    $listDoc = $record->listDoc ?? [];

    // Formalizar listDoc a array para pintar correctamente uno o varios documentos.
    if (is_object($listDoc)) {

        $listDoc = [$listDoc];
    } elseif (!is_array($listDoc)) {

        $listDoc = [];
    }

    if (count($listDoc) > 0) {
?>

    <table class="table table_documents">

        <tbody>

            <tr>

                <td>
                    <strong>Documentos</strong>
                </td>

            </tr>

<?php
            foreach ($listDoc as $documento) {

                $href = '';

                if (
                    isset($documento->enlaceDoc)
                    && trim($documento->enlaceDoc) !== ''
                ) {

                    $href = $documento->enlaceDoc;

                } else if (
                    isset($documento->nombreDocumento)
                    && trim($documento->nombreDocumento) !== ''
                ) {

                    $href =
                        URLAPPPUBLISHVRPC .'assets/publish/puntosinterconexion/'.       
                        $documento->nombreDocumento;
                }

                if ($href !== '') {
?>

                <tr>

                    <td>

                        <i class="icon-doc"></i>

                        <a href="<?php echo $href; ?>" target="_blank">

						<?php
						    if (
						        !isset($documento->tipoDocumento)
						        || trim($documento->tipoDocumento) === ''
						    ) {

						        echo 'Ver Constancia de Puntos';

						    } else if ($documento->tipoDocumento == 'CANCELACION') {

						        echo 'Ver Documento (CANCELACION)';

						    } else {

						        echo $documento->tipoDocumento;
						    }
						?>

						</a>

                    </td>

                </tr>

<?php
                }
            }
?>

        </tbody>

    </table>

<?php
    }
?>

                </div>
                <!-- documentos -->

            </div>
            <!-- row -->

        </div>
        <!-- End strip -->

<?php
    } /* foreach */

} else {
?>

    <div class="main_title">

        <h2><span>R</span>esultados</h2>

        <p>No se encontraron registros.</p>

    </div>

<?php
}
?>
<!-- RECORDS -->

<!--
<p class="text-center nopadding">
    <a href="#" class="btn_1 medium">
        <i class="icon-eye-7"></i>Más resultados
    </a>
</p>
-->