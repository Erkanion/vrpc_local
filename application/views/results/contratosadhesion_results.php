<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * This content is released under the MIT License (MIT)
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
<?php if ($contratosadhesionResults !== null) { ?>

    <div class="main_title">

        <h2>
            <span> R</span>esultados
            (<?php echo count_Arr($contratosadhesionResults); ?>)
        </h2>

    </div>

<?php
    foreach ($contratosadhesionResults as $record) {
?>

    <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">

        <div class="row">

            <div class="clearfix visible-xs-block"></div>

            <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">

<?php
                $status = getFieldValue($record, 'STATUS');

                // Validar si existe documento de cancelación
                $tieneCancelacion = false;

                $inscripciones = $record->INSCRIPCIONES ?? [];

                if (is_object($inscripciones)) {

                    $inscripciones = [$inscripciones];
                }

                if (is_array($inscripciones)) {

                    foreach ($inscripciones as $inscripcion) {

                        $documentos = $inscripcion->documentos ?? [];

                        // Normalizar a array para pintar correctamente cuando solo llega un documento.
                        if (is_object($documentos)) {

                            $documentos = [$documentos];
                        }

                        if (is_array($documentos)) {

                            foreach ($documentos as $documento) {

                                if (
                                    isset($documento->dctm_doctype)
                                    && strtoupper(trim($documento->dctm_doctype)) == 'CANCELACION'
                                ) {

                                    $tieneCancelacion = true;
                                    break 2;
                                }
                            }
                        }
                    }
                }

                if ($status == 'VIGENTE' && !$tieneCancelacion) {

                    echo "<div class='ribbon vigente'></div>";

                } else if ($status == 'TERMINADO' && !$tieneCancelacion) {

                    echo "<div class='ribbon terminado'></div>";

                } else if ($status == 'EN PROCESO DE PRORROGA' && !$tieneCancelacion) {

                    echo "<div class='ribbon prorroga'></div>";

                } else if ($status == 'NO-VIGENTE' && !$tieneCancelacion) {

                    echo "<div class='ribbon no-vigente'></div>";
                } else if ($status == 'VIGENTE' && $tieneCancelacion) {

                    echo "<div class='ribbon cancelado'></div>";
                }
?>

                <div class="tour_list_desc">

                    <div class="rating"></div>

<?php
                    $nActual   = getFieldValue($record, 'CONCESIONARIO');
                    $nAnterior = getFieldValue($record, 'CONCESIONARIOOLD');

                    if ($nActual == $nAnterior) {
?>

                        <h3>
                            Operador:
                            <strong><?php echo $nActual; ?></strong>
                        </h3>

<?php
                    } else {
?>

                        <h3>
                            Actual:
                            <strong><?php echo $nActual; ?></strong>
                        </h3>

                        <h3>
                            Anterior:
                            <strong><?php echo $nAnterior; ?></strong>
                        </h3>

<?php
                    }

                    $ncomercial = getFieldValue($record, 'COMERCIAL');

                    if ($ncomercial !== null && $ncomercial !== '') {
?>

                        <h3>
                            NOMBRE COMERCIAL:
                            <strong>
                                <?php echo getFieldValue($record, 'COMERCIAL'); ?>
                            </strong>
                        </h3>

<?php
                    }
?>

                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <table style="width: 100%;">

                            <thead>

                                <tr>
                                    <th colspan="4">Inscripciones</th>
                                </tr>

                                <tr>
                                    <th>Folio de inscripción</th>
                                    <th>Servicios</th>
                                    <th>Autorización PROFECO</th>
                                    <th>Fecha de autorización PROFECO</th>
                                    <th>Autorización CRT</th>
                                    <th>Fecha de autorización CRT</th>
                                    <th>Fecha de inscripción</th>
                                </tr>

                            </thead>

                            <tbody>

<?php
                                foreach ($inscripciones as $recG1) {
?>

                                    <tr>

                                        <td>
                                            <?php echo getFieldValue($recG1, 'idContrato'); ?>
                                        </td>

                                        <td style="padding-bottom: 7px;">

                                            <table>

                                                <tbody>

<?php
                                                    $ServiciosArray = null;

                                                    if (isset($recG1->servicios)) {

                                                        $ServiciosArray = $recG1->servicios;

                                                        if (
                                                            isset($recG1->servicios)
                                                            && count_Arr($recG1->servicios) == 1
                                                        ) {

                                                            $tmpArray       = $recG1->servicios;
                                                            $ServiciosArray = array($tmpArray);
                                                        }

                                                        foreach ($ServiciosArray as $recServicio) {
?>

                                                            <tr>
                                                                <td>
                                                                    [
                                                                    <?php echo getFieldValue($recServicio, 'nombreServicio'); ?>
                                                                    ];
                                                                    &nbsp;
                                                                </td>
                                                            </tr>

<?php
                                                        }
                                                    }
?>

                                                </tbody>

                                            </table>

                                        </td>

                                        <td>
                                            <?php echo getFieldValue($recG1, 'autorizacionProfeco'); ?>
                                        </td>

                                        <td>
                                            <?php echo getFieldValue($recG1, 'fechaAutorizacionProfeco'); ?>
                                        </td>

                                        <td>
                                            <?php echo getFieldValue($recG1, 'autorizacionIft'); ?>
                                        </td>

                                        <td>
                                            <?php echo getFieldValue($recG1, 'fechaAutorizacionIft'); ?>
                                        </td>

                                        <td>
                                            <?php echo getFieldValue($recG1, 'fechainscripcion'); ?>
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
				    if (is_array($inscripciones)) {

				        foreach ($inscripciones as $inscripcion) {

				            $documentos = $inscripcion->documentos ?? [];

				            // Normalizar a array para pintar correctamente cuando solo llega un documento.
				            if (is_object($documentos)) {

				                $documentos = [$documentos];
				            }

				            if (is_array($documentos)) {

				                foreach ($documentos as $documento) {

				                    $url = '';

				                    if (
				                        isset($documento->enlaceDoc)
				                        && trim($documento->enlaceDoc) !== ''
				                    ) {

				                        $url = $documento->enlaceDoc;

				                    } else if (
				                        isset($documento->dctm_docname)
				                        && trim($documento->dctm_docname) !== ''
				                    ) {

				                        $url =
				                            URLAPPSERT .
				                            "/upload/files/contratoadhesion/" .
				                            $documento->dctm_docname;
				                    }

				                    if ($url !== '') {
?>

				                        <tr>

				                            <td>

				                                <i class="icon-doc"></i>

				                                <a href="<?php echo $url; ?>" target="_blank">

<?php
												    if (
												        isset($documento->dctm_doctype)
												        && $documento->dctm_doctype == '3'
												    ) {

												        echo 'Ver Contrato';

												    } else if (
												        isset($documento->dctm_doctype)
												        && $documento->dctm_doctype == 'CANCELACION'
												    ) {

												        echo 'Ver Documento (CANCELACION)';

												    } else {

												        echo isset($documento->dctm_doctype)
												            ? $documento->dctm_doctype
												            : 'Documento';
												    }
?>

				                                </a>

				                            </td>

				                        </tr>

<?php
				                    }
				                }
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
    } // foreach

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