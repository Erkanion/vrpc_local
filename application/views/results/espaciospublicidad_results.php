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
    if (!isset($section) || $section == null) {

        if ($defaultValue == 'TODAY') {

            return date('d/m/Y');

        } else {

            return $defaultValue;
        }
    }

    if (!isset($section->$field)) {

        return $defaultValue;
    }

    if ($section->$field == null) {

        if ($defaultValue == 'TODAY') {

            return date('d/m/Y');

        } else {

            return $defaultValue;
        }
    }

    return $section->$field;
}
?>

<!-- RECORDS -->
<?php
if ($espaciosPublicidadResults !== null) {
?>

    <div class="main_title">

        <h2>
            <span> R</span>esultados
            (<?php echo count($espaciosPublicidadResults); ?>)
        </h2>

    </div>

<?php
    foreach ($espaciosPublicidadResults as $record) {

        //print_r($record);
?>

        <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">

            <div class="row">

                <div class="clearfix visible-xs-block"></div>

                <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">

<?php
                    /* echo "<div class='ribbon vigente'></div>"; */
?>

                    <div class="tour_list_desc">

                        <div class="rating"></div>

                        <h3>
                            <strong>
                                <?php echo getFieldValue($record, 'concesionario'); ?>
                            </strong>
                        </h3>

                        <p>

                            DENOMINACIÓN:
                            <strong>
                                <?php echo getFieldValue($record, 'denominacion'); ?>
                            </strong>
                            <br>

                            FOLIO DE INSCRIPCIÓN:
                            <strong>
                                <?php echo getFieldValue($record, 'folioInscripcion'); ?>
                            </strong>
                            <br>

                            FECHA DE INSCRIPCIÓN:
                            <strong>
                                <?php echo getFieldValue($record, 'fechaInscripcion'); ?>
                            </strong>
                            <br>

                            VIGENCIA:
                            <strong>
                                <?php echo getFieldValue($record, 'vigencia'); ?>
                            </strong>
                            <br>

                        </p>

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <table style="width: 100%;">

                                <thead>

                                    <tr>
                                        <th>Folio(s) electrónico(s)</th>
                                    </tr>

                                </thead>

                                <tbody>

<?php
                                    if (
                                        isset($record->folios)
                                        && !is_array($record->folios)
                                    ) {

                                        $tmpSArray = $record->folios;
                                        $record->folios = array($tmpSArray);
                                    }

                                    foreach ($record->folios as $recG1) {
?>

                                        <tr>

                                            <td>

                                                <a href="#"
                                                   onclick="displayDetail(
                                                       event,
                                                       <?php echo getFieldValue($recG1, 'idConcesion'); ?>
                                                   );">

                                                    <?php echo getFieldValue($recG1, 'fet'); ?>

                                                </a>

                                            </td>

                                        </tr>

<?php
                                    }
?>

                                </tbody>

                            </table>

                            <br/>

                        </div>

                    </div>

                </div>

                <!-- documentos -->
                <div class="col-lg-3 col-md-3 col-sm-3">

                    <strong></strong>

                    <table class="table table_documents">

					    <tbody>

<?php
					        $listDoc = $record->listDoc ?? [];

					        // Formalizar listDoc a array para pintar correctamente uno o varios documentos.
					        if (is_object($listDoc)) {
					            $listDoc = [$listDoc];
					        } elseif (!is_array($listDoc)) {
					            $listDoc = [];
					        }

					        if (!empty($listDoc)) {

					            foreach ($listDoc as $documento) {

					                $urlDocumento = '';

					                if (
					                    isset($documento->enlaceDoc)
					                    && trim($documento->enlaceDoc) !== ''
					                ) {

					                    $urlDocumento = $documento->enlaceDoc;

					                } else if (
					                    isset($documento->nombreDocumento)
					                    && trim($documento->nombreDocumento) !== ''
					                ) {

					                    $urlDocumento =
					                        URLASSETSESPACIOS .
					                        $documento->nombreDocumento;
					                }

					                if ($urlDocumento !== '') {

					                    $nombreDocumento = 'Documento';

					                    if (
					                        isset($documento->tipoDocumento)
					                        && $documento->tipoDocumento == 'CANCELACION'
					                    ) {

					                        $nombreDocumento =
					                            'Ver Documento (CANCELACION)';

					                    } else if (
					                        isset($documento->tipoDocumento)
					                        && $documento->tipoDocumento == 'CONSTANCIA'
					                    ) {

					                        $nombreDocumento =
					                            'Ver Constancia';

					                    } else if (
					                        isset($documento->tipoDocumento)
					                        && trim($documento->tipoDocumento) !== ''
					                    ) {

					                        $nombreDocumento =
					                            $documento->tipoDocumento;
					                    }
?>

					                    <tr>

					                        <td>

					                            <i class="icon-doc"></i>

					                            <a href="<?php echo $urlDocumento; ?>"
					                               target="_blank">

					                                <?php echo $nombreDocumento; ?>

					                            </a>

					                        </td>

					                    </tr>

<?php
					                }
					            }
					        }
?>

					    </tbody>

					</table>

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