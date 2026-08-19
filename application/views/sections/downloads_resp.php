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
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
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
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
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
                    <h3>Archivos de datos <small> próximamente se habilitarán mas archivos para su descarga</small></h3>
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
                            <p>al 31 de marzo de 2016</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://www.ift.org.mx/sites/default/files/contenidogeneral/industria/cuadroestadisticodedistribuciondeestacionesmarzo2016.xlsx" class="btn_1" target="_blank">Descargar</a>
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
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/infraestructura/InfraestructuraEstacionesRadio_AM_FM_09092019.xlsx" class="btn_1" target="_blank">Descargar</a>
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
                            <p>al 14 de noviembre de 2018</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/infraestructura/InfraestructuraEstacionesRadio_FM_14112018.xlsx" class="btn_1" target="_blank">Descargar</a>
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
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/infraestructura/InfraestructuraEstacionesRadio_TV_09092019.xlsx" class="btn_1" target="_blank">Descargar</a>
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
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/concesiones/Folios_electronicos_RPC.xlsx" class="btn_1" target="_blank">Base de datos</a>
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
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/permisos_radiocomunicacion/permisos_radiocomunicacion.xlsx" class="btn_1" target="_blank">Base de datos</a>
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
                            <p><strong> de tarifas de servicios móviles</strong></p>
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/tarifas_telecom/tarifas_moviles.xlsx" class="btn_1" target="_blank">Base de datos</a>
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
                            <p><strong> de tarifas de servicios fijos</strong></p>
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/tarifas_telecom/tarifas_fijo.xlsx" class="btn_1" target="_blank">Base de datos</a>
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
                            <p><strong> de tarifas de servicios diversos</strong></p>
                            <p>al 09 de septiembre de 2019</p>
                        </div>
                        
                        <div class="pricing-table-sign-up">
                            <a href="http://rpcwebdev.mdx.ift.org.mx/vrpc/assets/publish/tarifas_telecom/tarifas_diversos.xlsx" class="btn_1" target="_blank">Base de datos</a>
                        </div>
                    </div>
                </div>
            	
            </div>

<!-- tarifas -->            
            
            <hr>
	
    
</div><!-- End container -->

<?php
	$this->load->view('footer');
?>

<div id="toTop"></div><!-- Back to top button -->

 <!-- Common scripts -->
<script src="<?php echo URLASSETS?>js/jquery-1.11.2.min.js"></script>
<script src="<?php echo URLASSETS?>js/common_scripts_min.js"></script>
<script src="<?php echo URLASSETS?>js/functions.js"></script>

  </body>
</html>
