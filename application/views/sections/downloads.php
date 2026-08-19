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
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

defined('BASEPATH') OR exit('No direct script access allowed');

function getFieldValue($section, $field, $defaultValue = '') {
    if ($section == null) {
    	if ($defaultValue=='TODAY') {
    		return date('d/m/Y');	
    	} else {
        	return $defaultValue;
		}
    }
    if ($section->$field == null) {
        if ($defaultValue=='TODAY') {
    		return date('d/m/Y');
    	} else {
        	return $defaultValue;
		}
    }
    return $section->$field;
}


?>

<?php
$this->load->view('includes_rpc');
?>






<body>

<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a>.</p>
<![endif]-->

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <!-- End Preload -->

    <div class="layer"></div>
    <!-- Mobile menu overlay mask -->

<?php
$this->load->view('header');
?>

     <!-- Header================================================== -->

    
    
<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo URLASSETS?>img/opendata.png" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
        <h1>Datos abiertos</h1>
        <p>Registro Público de Concesiones</p>
        </div>
    </div>
</section><!-- End Section -->
    

<div class="container margin_60">
	<div class="main_title">
		<h2><span>Archivos </span>de datos</h2>
		<p>
			<!--Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.-->
		</p>
	</div>
	<hr>
    
            
            <div class="row">
                <div class="col-md-12">
                    <h3>Archivos de datos <small> próximamente se habilitarán más archivos para su descarga</small></h3>
                </div>
            </div><!-- end row -->
            
            <div class="row" id="pricing_2">
            	
            	<!--
            	<div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Cuadro de distribución</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Infraestructura de Radio y Televisión</p>
                            <p><strong> Estaciones autorizadas</strong></p>
                            <p>al 06 de octubre de 2025</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="https://www.ift.org.mx/sites/default/files/contenidogeneral/industria/cuadroestadisticodedistribuciondeestacionesmarzo2016.xlsx" class="btn_1" target="_blank">Descargar</a>
                        </div>
                    </div>
                </div>
               -->
               
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Estaciones AM y FM</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Infraestructura de estaciones</p>
                            <p><strong> de radio AM y FM</strong></p>
                            <p>al 25 de julio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/infraestructura/01_infraestructura_AM_FM_250726.xlsx" class="btn_1" target="_blank">Descargar</a>
                        </div>
                    </div><!-- End pricing-table-->
                </div><!-- End col-md-3 -->
                
                <!--
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Estaciones FM</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Infraestructura de estaciones</p>
                            <p><strong> de radio FM</strong></p>
                            <p>al 06 de octubre de 2025</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/infraestructura/InfraestructuraEstacionesRadio_FM_06102025.xlsx" class="btn_1" target="_blank">Descargar</a>
                        </div>
                    </div>
                </div>
                -->
                
                
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Estaciones TV</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Infraestructura de estaciones</p>
                            <p><strong> de TV</strong></p>
                            <p>al 25 de julio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/infraestructura/02_infraestructura_TV_250726 1.xlsx" class="btn_1" target="_blank">Descargar</a>
                        </div>
                    </div><!-- End pricing-table-->
                </div><!-- End col-md-3 -->
                    

            </div><!-- end row -->
            
            <div class="row" id="pricing_2">
            	
                
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Concesiones</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Base de datos completa</p>
                            <p><strong> de concesiones, autorizaciones y permisos</strong></p>
                            <p>al 25 de julio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/concesiones/03_concesiones_permisos_autorizaciones_250726 3.xlsx" class="btn_1" target="_blank">Base de datos</a>
                        </div>
                    </div><!-- End pricing-table-->
                </div><!-- End col-md-3 -->
                
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Permisos</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Base de datos completa</p>
                            <p><strong> de permisos de radiocomunicación privada</strong></p>
                            <p>al 25 de junio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/permisos_radiocomunicacion/04_radiocomunicacion_privada_250626.xlsx" class="btn_1" target="_blank">Base de datos</a>
                        </div>
                    </div><!-- End pricing-table-->
                </div><!-- End col-md-3 -->

                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Periodo de solicitud de prórroga</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Base de datos completa con el periodo para solicitar prórroga de vigencia <i class="icon-info-circled" title="Conoce y descarga el reporte especializado que concentra la información sobre el periodo en el que se deberá solicitar la prórroga de vigencia de los Títulos de Concesión y Autorizaciones, con el propósito de facilitar la consulta y análisis de esta información por parte de concesionarios, autorizados y público interesado."></i></strong></p>
                            <p>al <?php echo date('j'); ?> de <?php $meses=array(1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'); echo $meses[(int)date('n')]; ?> de <?php echo date('Y'); ?></p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="<?php echo URLAPP; ?>visor/generarReporteProrroga" class="btn_1 js-prorroga-download" data-download-url="<?php echo URLAPP; ?>visor/generarReporteProrroga">Base de datos</a>
                        </div>
                    </div><!-- End pricing-table-->
                </div><!-- End col-md-3 -->
            	
            </div><!-- end row rates -->

           
<!-- tarifas -->

            <div class="row" id="pricing_2">
            	
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Tarifas</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Base de datos completa</p>
                            <p><strong> de tarifas de servicios móviles</p>
                            <p><strong> de 2015 a 2025</strong></p>
                            <p>al 26 de julio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/tarifas_telecom/05_tarifas_servicios_moviles_260726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                        </div>
                    </div>
                
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Tarifas</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Base de datos completa</p>
                            <p><strong> de tarifas de servicios diversos</p>
                            <p><strong> de 2015 a 2025</strong></p>
                            <p>al 25 de julio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/tarifas_telecom/06_tarifas_servicios_diversos_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                        </div>
                    </div>
                </div>
            	<div class="row" id="pricing_2">
            <div class="col-md-3 col-sm-6">
                    <div class="pricing-table black ">
                        <div class="pricing-table-header">
                            <span class="heading">Tarifas</span>
                            <span class="price-value"><span>Excel</span>
                        </div>
                        <div class="pricing-table-space "></div>
                        <div class="pricing-table-features">
                            <p><strong>Base de datos completa</p>
                            <p><strong> de tarifas de servicios fijos</p>
                            <p><strong> de 2015 a 2025</strong></p>
                            <p>al 25 de junio de 2026</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="/vrpc/assets/publish/uploads/tarifas_telecom/07_tarifas_servicios_fijos_250626.xlsx" class="btn_1" target="_blank">Base de datos</a>
                        </div>
                    </div>
                </div>

            </div>

<!-- tarifas -->            
            

<!-- umca -->
    <div class="row" id="pricing_umca">
        
        
        <div class="col-md-3 col-sm-6">
            <div class="pricing-table black ">
                <div class="pricing-table-header">
                    <span class="heading">Códigos de ética</span>
                    <span class="price-value"><span>Excel</span>
                </div>
                <div class="pricing-table-space "></div>
                <div class="pricing-table-features">
                    <p><strong>Base de datos completa</p>
                    <p><strong> de códigos de ética</strong></p>
                    <p>al 25 de junio de 2026</p>
                </div>
                
                
                <div class="pricing-table-sign-up">
                    <a href="/vrpc/assets/publish/uploads/defensores_codigos/08_codigo_etica_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                </div>
                
            </div><!-- End pricing-table-->
        </div><!-- End col-md-3 -->
        
        <div class="col-md-3 col-sm-6">
            <div class="pricing-table black ">
                <div class="pricing-table-header">
                    <span class="heading">Defensores de audiencias</span>
                    <span class="price-value"><span>Excel</span>
                </div>
                <div class="pricing-table-space "></div>
                <div class="pricing-table-features">
                    <p><strong>Base de datos completa</p>
                    <p><strong> de defensores de audiencias</strong></p>
                    <p>al 25 de julio de 2026</p>
                </div>
                
                <div class="pricing-table-sign-up">
                    <a href="/vrpc/assets/publish/uploads/defensores_codigos/09_defensor_audiencias_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                </div>
                
            </div><!-- End pricing-table-->
        </div><!-- End col-md-3 -->

        <div class="col-md-3 col-sm-6">
            <div class="pricing-table black ">
                <div class="pricing-table-header">
                    <span class="heading">Convenios</span>
                    <span class="price-value"><span>Excel</span>
                </div>
                <div class="pricing-table-space "></div>
                <div class="pricing-table-features">
                    <p><strong>Base de datos completa</p>
                    <p><strong> de convenios</strong></p>
                    <p>al 25 de julio de 2026</p>
                </div>
                
                <div class="pricing-table-sign-up">
                    <a href="/vrpc/assets/publish/uploads/concesiones/10_convenios_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                </div>
                
            </div><!-- End pricing-table-->
        </div><!-- End col-md-3 -->                
        
    </div><!-- end row rates -->
<!-- umca -->

<!-- red_mayorista -->
    <div class="row" id="pricing_red">
        <div class="col-md-3 col-sm-6">
            <div class="pricing-table black ">
                <div class="pricing-table-header">
                    <span class="heading">Tarifas de Red Mayorista</span>
                    <span class="price-value"><span>Excel</span>
                </div>
                <div class="pricing-table-space "></div>
                <div class="pricing-table-features">
                    <p><strong>Base de datos completa</p>
                    <p><strong> de tarifas de red mayorista</strong></p>
                    <p>al 25 de julio de 2026</p>
                </div>
                
                
                <div class="pricing-table-sign-up">
                    <a href="/vrpc/assets/publish/uploads/concesiones/11_tarifas_red_mayorista_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                </div>
                
            </div><!-- End pricing-table-->
        </div><!-- End col-md-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="pricing-table black ">
                <div class="pricing-table-header">
                    <span class="heading">Resoluciones de Interconexion</span>
                    <span class="price-value"><span>Excel</span>
                </div>
                <div class="pricing-table-space "></div>
                <div class="pricing-table-features">
                    <p><strong>Base de datos completa</p>
                    <p><strong> de resoluciones de interconexión</strong></p>
                    <p>al 25 de julio de 2026</p>
                </div>
                
                <div class="pricing-table-sign-up">
                    <a href="/vrpc/assets/publish/uploads/concesiones/12_resoluciones_interconexion_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="pricing-table black ">
                <div class="pricing-table-header">
                    <span class="heading">Radioaficionados</span>
                    <span class="price-value"><span>Excel</span>
                </div>
                <div class="pricing-table-space "></div>
                <div class="pricing-table-features">
                    <p><strong>Base de datos completa</p>
                    <p><strong> de radioaficionados</strong></p>
                    <p>al 25 de julio de 2026</p>
                </div>
                
                <div class="pricing-table-sign-up">
                    <a href="/vrpc/assets/publish/uploads/concesiones/13_radioaficionados_250726.xlsx" class="btn_1" target="_blank">Base de datos</a>
                </div>
            </div>
        </div>
    </div><!-- end row rates -->
<!-- red_mayorista -->

        
    <hr>
	
    
</div><!-- End container -->

<div id="prorroga-download-overlay" class="prorroga-download-overlay" aria-hidden="true">
    <div class="prorroga-download-overlay__dialog" role="status" aria-live="polite">
        <h4>Generando documento</h4>
        <p>Se está generando el documento. Por favor espere mientras preparamos la descarga.</p>
        <div class="prorroga-download-overlay__progress">
            <div id="prorroga-download-progress-bar" class="prorroga-download-overlay__progress-bar"></div>
        </div>
        <div class="prorroga-download-overlay__progress-meta">
            <span id="prorroga-download-progress-text">0%</span>
            <span id="prorroga-download-progress-status">Iniciando solicitud...</span>
        </div>
    </div>
</div>

<style>
.prorroga-download-overlay {
    position: fixed;
    inset: 0;
    display: none;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.6);
    z-index: 9999;
    padding: 20px;
}

.prorroga-download-overlay.is-visible {
    display: flex;
}

.prorroga-download-overlay__dialog {
    width: 100%;
    max-width: 460px;
    background: #fff;
    border-radius: 10px;
    padding: 28px 24px;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
    text-align: center;
}

.prorroga-download-overlay__dialog h4 {
    margin: 0 0 10px;
    font-size: 24px;
    color: #333;
}

.prorroga-download-overlay__dialog p {
    margin: 0 0 18px;
    color: #666;
}

.prorroga-download-overlay__progress {
    width: 100%;
    height: 14px;
    border-radius: 999px;
    background: #e6e6e6;
    overflow: hidden;
}

.prorroga-download-overlay__progress-bar {
    width: 0;
    height: 100%;
    border-radius: 999px;
    background: linear-gradient(90deg, #5d8c84 0%, #78b7a2 100%);
    transition: width 0.25s ease;
}

.prorroga-download-overlay__progress-meta {
    margin-top: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-size: 14px;
    color: #555;
}

.prorroga-download-overlay__progress-meta span:first-child {
    font-weight: 700;
    color: #333;
}

.js-prorroga-download.is-disabled {
    pointer-events: none;
    opacity: 0.7;
}

body.prorroga-download-busy {
    overflow: hidden;
}
</style>

<?php
	$this->load->view('footer');
?>

<div id="toTop"></div><!-- Back to top button -->

 <!-- Common scripts -->
<script src="<?php echo URLASSETS?>js/jquery-1.11.2.min.js"></script>
<script src="<?php echo URLASSETS?>js/common_scripts_min.js"></script>
<script src="<?php echo URLASSETS?>js/functions.js"></script>
<script>
(function ($) {
    var $downloadButton = $('.js-prorroga-download');
    var $overlay = $('#prorroga-download-overlay');
    var $progressBar = $('#prorroga-download-progress-bar');
    var $progressText = $('#prorroga-download-progress-text');
    var $progressStatus = $('#prorroga-download-progress-status');
    var simulatedProgressTimer = null;
    var currentProgress = 0;
    var isDownloading = false;

    function updateProgress(value, statusText) {
        currentProgress = Math.max(0, Math.min(100, value));
        $progressBar.css('width', currentProgress + '%');
        $progressText.text(Math.round(currentProgress) + '%');
        if (statusText) {
            $progressStatus.text(statusText);
        }
    }

    function startLoading() {
        stopSimulation();
        updateProgress(0, 'Iniciando solicitud...');
        $overlay.addClass('is-visible').attr('aria-hidden', 'false');
        $('body').addClass('prorroga-download-busy');
        isDownloading = true;
        $downloadButton.addClass('is-disabled').attr('aria-disabled', 'true').text('Generando...');
        simulatedProgressTimer = window.setInterval(function () {
            if (currentProgress < 90) {
                updateProgress(currentProgress + 5, 'Generando documento...');
            }
        }, 350);
    }

    function stopSimulation() {
        if (simulatedProgressTimer) {
            window.clearInterval(simulatedProgressTimer);
            simulatedProgressTimer = null;
        }
    }

    function finishLoading() {
        stopSimulation();
        updateProgress(100, 'Documento listo. Iniciando descarga...');
        window.setTimeout(function () {
            $overlay.removeClass('is-visible').attr('aria-hidden', 'true');
            $('body').removeClass('prorroga-download-busy');
            $downloadButton.removeClass('is-disabled').removeAttr('aria-disabled').text('Base de datos');
            isDownloading = false;
            updateProgress(0, 'Iniciando solicitud...');
        }, 800);
    }

    function failLoading(message) {
        stopSimulation();
        updateProgress(100, message || 'No fue posible generar el documento.');
        window.setTimeout(function () {
            $overlay.removeClass('is-visible').attr('aria-hidden', 'true');
            $('body').removeClass('prorroga-download-busy');
            $downloadButton.removeClass('is-disabled').removeAttr('aria-disabled').text('Base de datos');
            isDownloading = false;
            window.alert(message || 'No fue posible generar el documento.');
            updateProgress(0, 'Iniciando solicitud...');
        }, 500);
    }

    function downloadBlob(blob, fileName) {
        var link = document.createElement('a');
        var url = window.URL.createObjectURL(blob);
        link.href = url;
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);
    }

    $downloadButton.on('click', function (event) {
        event.preventDefault();

        if (isDownloading) {
            return;
        }

        var downloadUrl = $(this).data('download-url') || $(this).attr('href');
        var request = new XMLHttpRequest();

        startLoading();

        request.open('GET', downloadUrl, true);
        request.responseType = 'blob';
        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        request.onprogress = function (progressEvent) {
            if (progressEvent.lengthComputable && progressEvent.total > 0) {
                updateProgress((progressEvent.loaded / progressEvent.total) * 100, 'Descargando documento...');
            }
        };

        request.onload = function () {
            var contentType = request.getResponseHeader('Content-Type') || '';
            var disposition = request.getResponseHeader('Content-Disposition') || '';
            var fileName = 'Reporte_Prorroga.xlsx';

            if (disposition.indexOf('filename=') !== -1) {
                fileName = disposition.split('filename=')[1].split(';')[0].replace(/['"]/g, '').trim();
            }

            if (request.status >= 200 && request.status < 300 && contentType.indexOf('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') !== -1) {
                downloadBlob(request.response, fileName);
                finishLoading();
                return;
            }

            var reader = new FileReader();
            reader.onload = function () {
                failLoading(reader.result || 'La generación del documento devolvió una respuesta no válida.');
            };
            reader.onerror = function () {
                failLoading('No fue posible leer la respuesta del servidor.');
            };
            reader.readAsText(request.response);
        };

        request.onerror = function () {
            failLoading('Ocurrió un error de red al generar el documento.');
        };

        request.send();
    });
})(jQuery);
</script>

  </body>
</html>
