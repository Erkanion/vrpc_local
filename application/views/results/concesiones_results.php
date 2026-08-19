<?php
/**
* CodeIgniter
*
* An open source application development framework for PHP 5.2.4 or newer
*/
defined('BASEPATH') OR exit('No direct script access allowed');
function getFieldValue($section, $field, $defaultValue = '')
{
if ($section == null) {
if ($defaultValue == 'TODAY') {
return date('d/m/Y');
} else {
return $defaultValue;
}
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
<?php if ($concesionesResults !== null) { ?>
<div class="main_title">
    <h2>
    <span> R</span>esultados
    (<?php echo count($concesionesResults); ?>)
    </h2>
</div>
<?php
foreach ($concesionesResults as $record) {
?>
<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
    <div class="row">
        <div class="clearfix visible-xs-block"></div>
        <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">
            <?php
            if ($record->ESTADO_CONCESION == 'VIGENTE') {
            echo "<div class='ribbon vigente'></div>";
            } else if ($record->ESTADO_CONCESION == 'TERMINADO') {
            echo "<div class='ribbon terminado'></div>";
            } else if ($record->ESTADO_CONCESION == 'EN PROCESO DE PRORROGA') {
            echo "<div class='ribbon prorroga'></div>";
            } else if ($record->ESTADO_CONCESION == 'EN PROCESO DE PRÓRROGA') {
            echo "<div class='ribbon prorroga'></div>";
            } else if ($record->ESTADO_CONCESION == 'RENUNCIA') {
            echo "<div class='ribbon renuncia'></div>";
            } else if ($record->ESTADO_CONCESION == 'VENCIDO') {
            echo "<div class='ribbon vencido'></div>";
            } else if ($record->ESTADO_CONCESION == 'NO VIGENTE') {
            echo "<div class='ribbon no-vigente'></div>";
            } else if ($record->ESTADO_CONCESION == 'EXTINGUIDO') {
            echo "<div class='ribbon extinguido'></div>";
            } else if ($record->ESTADO_CONCESION == 'EXTINTO') {
            echo "<div class='ribbon extinto'></div>";
            } else if ($record->ESTADO_CONCESION == 'CANCELADO') {
            echo "<div class='ribbon cancelado'></div>";
            } else if ($record->ESTADO_CONCESION == 'TERMINADO POR RESCATE') {
            echo "<div class='ribbon terminado-por-rescate'></div>";
            } else if ($record->ESTADO_CONCESION == 'NO VIGENTE – PRÓXIMO INICIO DE VIGENCIA') {
            echo "<div class='ribbon nov-proximo-inicio-vigencia'></div>";
            } else if ($record->ESTADO_CONCESION == 'NO VIGENTE - PRÓXIMO INICIO DE VIGENCIA') {
            echo "<div class='ribbon nov-proximo-inicio-vigencia'></div>";
            } else if ($record->ESTADO_CONCESION == 'TERMINADO POR RENUNCIA') {
            echo "<div class='ribbon terminado-por-renuncia'></div>";
            } else if ($record->ESTADO_CONCESION == 'CANCELADO POR TERMINACIÓN ANTICIPADA') {
            echo "<div class='ribbon cancelado-por-terminacion-anticipada'></div>";
            } else if ($record->ESTADO_CONCESION == 'CANCELADO – SIN SOLICITUD DE TRANSICIÓN') {
            echo "<div class='ribbon cancelado-sin-solicitud-transicion'></div>";
            } else if ($record->ESTADO_CONCESION == 'TERMINADO POR NEGATIVA DE PRÓRROGA') {
            echo "<div class='ribbon terminado-por-negativa-de-prorroga'></div>";
            } else if ($record->ESTADO_CONCESION == 'TERMINADO POR VENCIMIENTO') {
            echo "<div class='ribbon terminado-por-vencimiento'></div>";
            } else if ($record->ESTADO_CONCESION == 'TERMINADO POR REVOCACIÓN') {
            echo "<div class='ribbon terminado-por-revocacion'></div>";
            } else if ($record->ESTADO_CONCESION == 'EXTINGUIDO POR CONSOLIDACIÓN') {
            echo "<div class='ribbon extinguido-por-consolidacion'></div>";
            }
            ?>
            <?php
            $entraProrroga = strtoupper(
            trim(getFieldValue($record, 'ENTRA_PRORROGA', 'NO'))
            );
            if ($entraProrroga === 'SI') {
            echo "
            <div id='estado_prorroga'
                style='background:#f6efb3;color:#000;
                padding:10px 15px;
                font-weight:600;
                text-transform:uppercase;
                float:right;'>
                EN PERIODO PARA SOLICITAR PRÓRROGA
            </div>";
            } else {
            echo "
            <div id='estado_prorroga'
                style='background:#f2f2f2;color:#333;
                padding:10px 15px;
                font-weight:600;
                text-transform:uppercase;
                float:right;'>
                NO SE ENCUENTRA EN PERIODO PARA SOLICITAR PRORROGA
            </div>";
            }
            ?>
            <div class="tour_list_desc" style="margin-top:40px;">
                <div class="rating"></div>
                <h3>
                <strong>
                <?php echo getFieldValue($record, 'C_FOLIO_ELECTRONICO'); ?>
                </strong>
                -
                <?php echo getFieldValue($record, 'CONCESIONARIO_NAME'); ?>
                </h3>
                <p>
                    <?php
                    if ($record->TIPO_REGISTRO == 'CO') {
                    echo "TIPO: <strong>CONCESIÓN</strong>";
                    } else if ($record->TIPO_REGISTRO == 'PE') {
                    echo "TIPO: <strong>PERMISO</strong>";
                    } else if ($record->TIPO_REGISTRO == 'AS') {
                    echo "TIPO: <strong>ASIGNACIÓN</strong>";
                    } else if ($record->TIPO_REGISTRO == 'AU') {
                    echo "TIPO: <strong>AUTORIZACIÓN</strong>";
                    }
                    if ($record->COMERCIALIZADORA == 'SI') {
                    echo " - <strong>COMERCIALIZADORA</strong><br>";
                    }
                    echo "<br>";
                    $isRadio = false;
                    $tipoFE = substr(
                    getFieldValue($record, 'C_FOLIO_ELECTRONICO'),
                    0,
                    3
                    );
                    if ($tipoFE == 'FER') {
                    $isRadio = false;
                    }
                    ?>
                    MATERIA:
                    <strong>
                    <?php echo getFieldValue($record, 'TIPO'); ?>
                    </strong>
                    <br>
                    NOMBRE COMERCIAL:
                    <strong>
                    <?php echo getFieldValue($record, 'NOMBRE_COMERCIAL'); ?>
                    </strong>
                    <br>
                    <?php echo getFieldValue($record, 'TIPO_INSCRIPCION'); ?>
                    <br>
                    <?php
                    if ($record->UNICA == 'SI') {
                    echo "<strong>CONCESIÓN ÚNICA</strong><br>";
                    }
                    $fechaInicioProrroga = trim(
                    getFieldValue($record, 'FECHA_INICIO_PRORROGA', '')
                    );
                    $fechaFinProrroga = trim(
                    getFieldValue($record, 'FECHA_FIN_PRORROGA', '')
                    );
                    if (
                    $fechaInicioProrroga !== ''
                    && $fechaFinProrroga !== ''
                    ) {
                    ?>
                    <span id="fechas_prorroga">
                        PERIODO PARA SOLICITAR LA PRÓRROGA DE VIGENCIA:
                        <span style="font-weight:bold;">
                            <?php echo $fechaInicioProrroga; ?>
                            –
                            <?php echo $fechaFinProrroga; ?>
                        </span>
                    </span>
                    <?php
                    } else {
                    ?>
                    <span id="fechas_prorroga">
                        PERIODO PARA SOLICITAR LA PRÓRROGA DE VIGENCIA:
                        NO APLICA
                    </span>
                    <?php
                    }
                    ?>
                </p>
                <ul class="add_info">
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
                            <div class="tooltip-content"><h4>Vigencia - <?php echo getFieldValue($record,'SARCNUMEROVIGENCIA'); ?> años</h4>
                                <strong>Fecha de vencimiento:</strong><?php echo getFieldValue($record,'SARCFECHAVENCIMIENTO'); ?><br>
                                <strong>Inicio de vigencia:</strong> <?php echo getFieldValue($record,'SARCINICIOVIGENCIA'); ?><br>
                                <strong>Fecha de prórroga:</strong><?php echo getFieldValue($record,'SARCFECHAPRORROGA'); ?><br>
                                <strong>Fecha de otorgamiento:</strong><?php echo getFieldValue($record,'FOTORGAMIENTO'); ?>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="icon_set_1_icon-87"></i></span>
                            <div class="tooltip-content"><h4>Servicios</h4>
                                <?php
                                $servicios = $record->SERVICIOS;
                                if (isset($servicios) && $servicios!=null) {
                                if(!is_array($servicios)) {
                                $serviciosTmp = array ($servicios);
                                $servicios = $serviciosTmp;
                                }
                                foreach($servicios as $servicio) {
                                /*echo $servicio->DESCRIPCION."<br>";*/
                                echo $servicio."<br>";
                                }
                                }
                                ?>
                                
                                
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>
                            <div class="tooltip-content"><h4>Cobertura</h4>
                                <?php
                                $estados = $record->COBERTURA;
                                
                                if ($estados!=null) {
                                foreach($estados as $estado) {
                                //print_r($estado);
                                if (isset($estado->estado)) {
                                echo $estado->estado."<br>";
                                }
                                }
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
                
                <!-- verificar estilo de este nuevo div -->
                <div style="padding-top: 5px;">
                    <a href="single_tour.html" class="btn_1" onclick="displayDetail(event,<?php echo getFieldValue($record,'ID_CONCESION'); ?>);">Más información</a>
                </div>
                
                
            </div>
        </div>
        <!-- documentos -->
        <div class="col-lg-3 col-md-3 col-sm-3">
            <?php
            $documents = $record->DOCUMENTS;
            if (!is_array($documents)) {
            $documents = ($documents !== null)
            ? array($documents)
            : array();
            }
            if (count($documents) >= 1 && !$isRadio) {
            ?>
            <table class="table table_documents">
                <tbody>
                    <?php
                    $lastTitle = '';
                    if (
                    isset($documents)
                    && count($documents) >= 1
                    && is_array($documents)
                    ) {
                    foreach ($documents as $document) {
                    if (isset($document->dctm_doctype)) {
                    if ($lastTitle !== $document->dctm_doctype) {
                    ?>
                    <tr>
                        <td>
                            <strong>
                            <?php echo $document->dctm_doctype; ?>
                            </strong>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td>
                            <i class="icon-doc"></i>
                            
                            <a href="<?php
                                if (!empty($document->enlaceDoc)) {
                                // Validar si termina con extensión
                                if (preg_match('/\.[a-zA-Z0-9]+$/', $document->enlaceDoc)) {
                                echo $document->enlaceDoc;
                                } else {
                                echo rtrim($document->enlaceDoc, '/') . '/' . $document->dctm_docname;
                                }
                                } else {
                                echo URLAPPPUBLISHVRPC . '/' . $document->dctm_docname;
                                }
                                ?>" target="_blank">
                                <?php echo $document->dctm_doctitle; ?>
                            </a>
                        </td>
                    </tr>
                    <?php
                    $lastTitle = $document->dctm_doctype;
                    }
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