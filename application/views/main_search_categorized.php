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


<section id="search_container">
 	<div id="search">
 		<div class="main_title">
            <h2 style="color:#ffffff">Registro Público de Concesiones</h2>
        </div>
<!-- Check http://www.bootply.com/l2ChB4vYmC -->
                    <ul class="nav nav-tabs">
						<li class="active"><a href="#concesiones" data-toggle="tab">Concesiones, permisos y autorizaciones</a></li>
                        <li><a href="#hotels" data-toggle="tab">Convenios</a></li>
                        <li><a href="#hotels" data-toggle="tab">Sanciones y supervisión</a></li>
                        <li><a href="#transfers" data-toggle="tab">Contratos de adhesión</a></li>
                        <li><a href="#restaurants" data-toggle="tab">Estructura accionaria</a></li>                    	
                    </ul>
                    
                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="concesiones">
                        <h3>Búsqueda de <span>concesiones</span></h3>
                        	<div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-94"></i>Concesionario</label>
                                        <div id="concesionario-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Nombre del concesionario" 
						                	id="txtConcesionario" name="txtConcesionario">
						                	<input type="hidden" id="txtBPConcesionario" name="txtBPConcesionario" />
                						</div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-59"></i>Servicios</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-services" multiple="multiple" class="multiselect">
                                        	<optgroup label="Telecomunicaciones">
                                            <option value="1" >Telefonía Local Fija</option>
                                            <option value="2" >Telefonía de Larga Distancia</option>
                                            <option value="3" >Telefonía Celular Móvil</option>
                                            <option value="4" >Televisión de paga</option>
                                            <option value="5" >Internet</option>
                                            <option value="6" >Radiocomunicación Móvil de Flotillas</option>
                                            <option value="20" >Telefonía Pública</option>
                                            </optgroup>
                                            <optgroup label="Radiodifusión">
                                            <option value="16" >Radio AM</option>
                                            <option value="17" >Radio FM</option>
                                            <option value="18" >Televisión Abierta</option>
                                            <option value="19" >Televisión Digital Terrestre</option>
                                            </optgroup>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            </div><!-- End row -->
                            
                            
                            <div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Folio electrónico</label>
                                        <div id="fets-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Folio electrónico" 
						                	id="fet_search" name="fet_search">
                						</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-37"></i>Cobertura (Estado)</label>
                                        <div class="multi-select-full">
                                        <select id="rpc-estados" class="multiselect" multiple="multiple">
												<option value="1">Aguascalientes</option>
												<option value="2">Baja California</option>
												<option value="3">Baja California Sur</option>
												<option value="4">Campeche</option>
												<option value="5">Coahuila de Zaragoza</option>
												<option value="6">Colima</option>
												<option value="7">Chiapas</option>
												<option value="8">Chihuahua</option>
												<option value="9">Ciudad de México</option>
												<option value="10">Durango</option>
												<option value="11">Guanajuato</option>
												<option value="12">Guerrero</option>
												<option value="13">Hidalgo</option>
												<option value="14">Jalisco</option>
												<option value="15">Estado de México</option>
												<option value="16">Michoacán de Ocampo</option>
												<option value="17">Morelos</option>
												<option value="18">Nayarit</option>
												<option value="19">Nuevo León</option>
												<option value="20">Oaxaca</option>
												<option value="21">Puebla</option>
												<option value="22">Querétaro</option>
												<option value="23">Quintana Roo</option>
												<option value="24">San Luis Potosí</option>
												<option value="25">Sinaloa</option>
												<option value="26">Sonora</option>
												<option value="27">Tabasco</option>
												<option value="28">Tamaulipas</option>
												<option value="29">Tlaxcala</option>
												<option value="30">Veracruz de Ignacio de la Llave</option>
												<option value="31">Yucatán</option>
												<option value="32">Zacatecas</option>                                            
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            </div><!-- End row -->
                            
                            <div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-93"></i>Expediente o distintivo</label>
                                        <div id="exp-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Número de expediente o distintivo (radio y TV)" 
						                	id="expediente_search" name="expediente_search">
                						</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-65"></i>Estatus</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-estatus" class="multiselect">
                                        	<option value="ANY" >Cualquier estatus</option>
                                            <option value="VIG" >Solo vigentes</option>
                                            <option value="TER" >Solo terminadas</option>
                                            <option value="INP" >En proceso de prórroga</option>                                            
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            </div><!-- End row -->
                            
                            
                            <div class="row">
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-86"></i> Canal</label>
                        				<input type="text" class="form-control" id="canal_search" name="canal_search" placeholder="Canal ">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Tipo</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-tipo" class="multiselect">
                                        	<option value="ANY" selected="selected" >Cualquier tipo</option>
                                        	<option value="CO" >Concesiones</option>
                                            <option value="PE" >Permisos</option>
                                            <option value="AU" >Autorizaciones</option>
                                            <option value="AS" >Asignaciones</option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                                
                            </div><!-- End row -->
                            
                            
                            <div class="row">
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon-network"></i> Sistema satelital</label>
   
									   <div class="multi-select-full">
                                        <select id="rpc-satelites" class="multiselect" multiple="multiple">
<?php
	if ($satelitesList!==null) {
		foreach ($satelitesList as $satelite) {
    		$fldL01 = getFieldValue($satelite, 'NOM_SATELITE');
?>
									<option value="<?php echo $fldL01;?>"><?php echo $fldL01;?></option>
<?php			
		}
	}
?>
                                        </select>
                                       </div>                                     
                                    </div>
                                </div>
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon-network"></i>Posición orbital</label>
                                    	
									   <div class="multi-select-full">
                                        <select id="rpc-posiciones" class="multiselect" multiple="multiple">
<?php
	if ($posicionesList!==null) {
		foreach ($posicionesList as $posicion) {
    		$fldLP = getFieldValue($posicion, 'POS_ORBITAL');
?>
									<option value="<?php echo $fldLP;?>"><?php echo $fldLP;?></option>
<?php			
		}
	}
?>
                                        </select>
                                       </div>                                    	
                                    	
                                    	
                                    	
                                    </div>
                                </div>
                                
                            </div><!-- End row -->
                            
                            <hr>
                            <button class="btn_1 green" onclick="searchConcesiones();"><i class="icon-search"></i>Iniciar búsqueda</button>
                            <span></span>
                            <button class="btn_1 orange"><i class="icon_set_1_icon-67"></i>Borrar filtros</button>
                        </div><!-- End tab -->
                        
                        <div class="tab-pane" id="hotels">
                        <h3>Búsqueda de <span>convenios</span></h3>
                        
                        	<div class="row">
                            	
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Tipo de convenio</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-tipo-convenio" class="multiselect" multiple="multiple">
                                        	<option value="01" >MARCO</option>
                                            <option value="02" >CONVENIO MARCO</option>
                                            <option value="03" >MODIFICATORIO</option>
                                            <option value="04" >CONVENIO MODIFICATORIO</option>
                                            <option value="05" >CONVENIO TERMINACION</option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-86"></i> Descripción del convenio</label>
                        				<input type="text" class="form-control" id="convenio_desc" name="convenio_desc" placeholder="Nombre del convenio ">
                                    </div>
                                </div>
                                
                                
                                
                            </div><!-- End row -->
                        
                        	<div class="row">
                        		<div class="col-md-6">
                                	<div class="form-group">
                                        <label>Fecha de celebración del convenio</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                        <label>&nbsp;</label>
                                    </div>
                                </div>
                            	<div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Fecha inicial</label>
                        				<input class="date-pick form-control" data-date-format="dd/MM/yyyy" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Fecha final</label>
                        				<input class="date-pick form-control" data-date-format="dd/MM/yyyy" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Expediente</label>
                                        <input type="text" id="c_expediente" class="form-control" name="c_expediente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Folio de inscripción</label>
                                        <input type="text" id="c_folio" class="form-control" name="c_folio">
                                    </div>
                                </div>
                            </div><!-- End row -->
                            
                            <div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label>Hotel name</label>
                                        <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="Optionally type hotel name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                    <label>Preferred city area</label>
                                        <select class="form-control" name="area">
                                            <option value="Centre" selected>Centre</option>
                                            <option value="Gar du Nord Station">Gar du Nord Station</option>
                                            <option value="La Defance">La Defance</option>
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- End row -->
                            <hr>
                            <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                        </div>
                        <div class="tab-pane" id="transfers">
                        <h3>Search Transfers in Paris</h3>
                        	<div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                	<label class="select-label">Pick up location</label>
                                        <select class="form-control">
                                            <option value="orly_airport">Orly airport</option>
                                            <option value="gar_du_nord">Gar du Nord Station</option>
                                            <option value="hotel_rivoli">Hotel Rivoli</option>
                                        </select>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                	<label class="select-label">Drop off location</label>
                                        <select class="form-control">
                                            <option value="orly_airport">Orly airport</option>
                                            <option value="gar_du_nord">Gar du Nord Station</option>
                                            <option value="hotel_rivoli">Hotel Rivoli</option>
                                        </select>
                                        </div>
                                </div>
                            </div><!-- End row -->
                            <div class="row">
                            	<div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Date</label>
                        				<input class="date-pick form-control" data-date-format="M d, D" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class=" icon-clock"></i> Time</label>
                        				<input class="time-pick form-control" value="12:00 AM" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="form-group">
                                        <label>Adults</label>
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-9">
                                    <div class="form-group">
                                    	<div class="radio_fix">
                                        <label class="radio-inline" style="padding-left:0">
                                          <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked> One Way
                                        </label>
                                        </div>
                                        <div class="radio_fix">
                                        <label class="radio-inline">
                                          <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Return
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End row -->
                            <hr>
                            <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                        </div>
                        <div class="tab-pane" id="restaurants">
                        <h3>Search Restaurants in Paris</h3>
                        	<div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label>Search by name</label>
                                        <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" placeholder="Type your search terms">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                    	<label>Food type</label>
                                        <select class="ddslick" name="category_2">
                                            <option value="0" data-imagesrc="<?php echo URLASSETS?>img/icons_search/all_restaurants.png" selected>All restaurants</option>
                                            <option value="1" data-imagesrc="<?php echo URLASSETS?>img/icons_search/fast_food.png">Fast food</option>
                                            <option value="2"  data-imagesrc="<?php echo URLASSETS?>img/icons_search/pizza_italian.png">Pizza / Italian</option>
                                            <option value="3" data-imagesrc="<?php echo URLASSETS?>img/icons_search/international.png">International</option>
                                            <option value="4" data-imagesrc="<?php echo URLASSETS?>img/icons_search/japanese.png">Japanese</option>
                                            <option value="5" data-imagesrc="<?php echo URLASSETS?>img/icons_search/chinese.png">Chinese</option>
                                            <option value="6" data-imagesrc="<?php echo URLASSETS?>img/icons_search/bar.png">Coffee Bar</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- End row -->
                            <div class="row">
                            	<div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Date</label>
                        				<input class="date-pick form-control" data-date-format="M d, D" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class=" icon-clock"></i> Time</label>
                        				<input class="time-pick form-control" value="12:00 AM" type="text">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <label>Adults</label>
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="adults" class="qty2 form-control" name="adults">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <label>Children</label>
                                        <div class="numbers-row">
                                            <input type="text" value="0" id="children" class="qty2 form-control" name="children">
                                        </div>
                                    </div>
                                </div>
                                
                            </div><!-- End row -->
                            <hr>
                            <button class="btn_1 green"><i class="icon-search"></i>Search now</button>
                        </div>
                    </div>
	</div>
</section><!-- End hero -->

<!-- START divResults -->    
<div class="container margin_60 show" id="divResults" name="divResults">

</div><!-- End container -->
<!-- END divResults -->

    
    <div class="white_bg">
        <div class="container margin_60">
            <div class="main_title">
                <h2>Lo <span>más</span> consultado</h2>
                <p>
                    Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
                </p>
            </div>
            <div class="row add_bottom_45">
                <div class="col-md-6 other_tours">
                    <ul>
                        <li><a href="#"><i class="icon_set_2_icon-106"></i>FER042580CO-105499 - MEXICO RADIO, S.A. DE C.V.</a>
                        </li>
                        <li><a href="#"><i class="icon_set_2_icon-106"></i>FER043397CO-105341 - ADMINISTRADORA ARCANGEL, S.A. DE C.V.</a>
                        </li>
                        <li><a href="#"><i class="icon_set_2_icon-106"></i>FER041210CO-107311 - RADIO XHFEM, S. DE R.L. DE C.V.</a>
                        </li>
                        <li><a href="#"><i class="icon_set_2_icon-106"></i>FET007942CO-100418 - MEGA CABLE, S.A. DE C.V.</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 other_tours">
                    <ul>
                        <li><a href="#"><i class="icon_set_1_icon-1"></i>CONVENIO MARCO - OPERBES, S.A. DE C.V. / OPERADORA DE COMUNICACIONES, S.A. DE C.V.</a>
                        </li>
                        <li><a href="#"><i class="icon_set_1_icon-1"></i>CONVENIO MODIFICATORIO - OPERBES, S.A. DE C.V. / ALESTRA, S. DE R.L. DE C.V.</a>
                        </li>
                    </ul>
                </div>
            </div><!-- End row -->
            
            <div class="banner colored add_bottom_30">
                <h4>Datos <span>abiertos</span></h4>
                <p>
                    Descargue las bases de datos que conforman el Registro Público de Telecomunicaciones.
                </p>
                <a href="single_tour.html" class="btn_1 white">Área de descargas</a>
            </div>
            
            
            
            
            
        </div><!-- End container -->
    </div><!-- End white_bg -->
    
    <section class="promo_full">
    <div class="promo_full_wp magnific">
        <div>
            <h3>Tutorial</h3>
            <p>
                Explore el video tutorial sobre el funcionamiento del Registro Público de Concesiones.
            </p>
            <a href="https://www.youtube.com/watch?v=5tbJNJDuGMs" class="video"><i class="icon-play-circled2-1"></i></a>
        </div>
    </div>
    </section><!-- End section -->


<?php
$this->load->view('faqs');
?>

<!--    
    <div class="container margin_60">
    
        <div class="main_title">
            <h2>Some <span>good</span> reasons</h2>
            <p>
                Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
            </p>
        </div>
        
        <div class="row">
        
            <div class="col-md-4 wow zoomIn" data-wow-delay="0.2s">
                <div class="feature_home">
                    <i class="icon_set_1_icon-41"></i>
                    <h3><span>+120</span> Premium tours</h3>
                    <p>
                         Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                    </p>
                    <a href="about.html" class="btn_1 outline">Read more</a>
                </div>
            </div>
            
            <div class="col-md-4 wow zoomIn" data-wow-delay="0.4s">
                <div class="feature_home">
                    <i class="icon_set_1_icon-30"></i>
                    <h3><span>+1000</span> Customers</h3>
                    <p>
                         Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                    </p>
                    <a href="about.html" class="btn_1 outline">Read more</a>
                </div>
            </div>
            
            <div class="col-md-4 wow zoomIn" data-wow-delay="0.6s">
                <div class="feature_home">
                    <i class="icon_set_1_icon-57"></i>
                    <h3><span>H24 </span> Support</h3>
                    <p>
                         Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                    </p>
                    <a href="about.html" class="btn_1 outline">Read more</a>
                </div>
            </div>
            
        </div>
        
        <hr>
        
        
    </div>
-->    


<?php
	$this->load->view('footer');
?>

<div id="toTop"></div><!-- Back to top button -->



 <!-- Specific scripts -->
<script src="<?php echo URLASSETS?>js/icheck.js"></script>
<script>
$('input').iCheck({
   checkboxClass: 'icheckbox_square-grey',
   radioClass: 'iradio_square-grey'
 });
 </script>
 <script src="<?php echo URLASSETS?>js/bootstrap-datepicker.js"></script>
 <script src="<?php echo URLASSETS?>js/bootstrap-timepicker.js"></script>
 
 <script src="<?php echo URLASSETS?>js/bootstrap-table.js"></script>
 <link rel="stylesheet" href="<?php echo URLASSETS?>css/bootstrap-table.css">
 
 <script type="text/javascript" src="<?php echo URLASSETS?>js/plugins/forms/styling/uniform.min.js"></script>
 <script src="<?php echo URLASSETS?>js/bootstrap_multiselect.js"></script>
 <script type="text/javascript" src="<?php echo URLASSETS ?>js/plugins/forms/inputs/typeahead/typeahead.bundle-0.11.1.js"></script>
 
 <script type="text/javascript" src="<?php echo URLASSETS ?>/js/plugins/tables/datatables/datatables.min.js"></script>
 
 <script>
 
 $.fn.datepicker.dates['en'] = {
    days: ["Domingo", "Lunes", "martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Hoy",
    clear: "Limpiar",
    format: "dd/mm/yyyy",
    titleFormat: "dd/mm/yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};
 
  $('input.date-pick').datepicker('setDate', 'today');
  $('input.time-pick').timepicker({
    minuteStep: 15,
    showInpunts: false
})
  </script>
  <script src="<?php echo URLASSETS?>js/jquery.ddslick.js"></script>
   <script>
   $("select.ddslick").each(function(){
            $(this).ddslick({
                showSelectedHTML: true 
            });
        });
        </script>
        
   <script>
    /*
    $('.multiselect').multiselect({
    	nonSelectedText: "Ningún servicios seleccionado",
        onChange: function() {
            $.uniform.update();
        }
    });
    */
    
    // Full width
    $('.multiselect-full').multiselect({
        buttonWidth: '100%'
    });
    
    //$('#rpc-services').multiselect();
    
    $('#rpc-services').multiselect({
        nonSelectedText: "Ningún servicio seleccionado",
        numberDisplayed: 2,
        nSelectedText: "servicios seleccionados",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    $('#rpc-estatus').multiselect({
        nonSelectedText: "Ningún estatus seleccionado",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    
    $('#rpc-satelites').multiselect({
        nonSelectedText: "",
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        filterPlaceholder: "Buscar",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    $('#rpc-posiciones').multiselect({
        nonSelectedText: "",
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        filterPlaceholder: "Buscar",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    $('#rpc-tipo').multiselect({
        nonSelectedText: "Ningún tipo seleccionado",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    
    $('#rpc-tipo-convenio').multiselect({
    	allSelectedText: "Todos los tipos",
    	selectAllText:"Todos los tipos",
        nonSelectedText: "Ningún tipo seleccionado",
        numberDisplayed: 2,
        nSelectedText: "tipos seleccionados",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    $('#rpc-estados').multiselect({
    	includeSelectAllOption: true,
    	allSelectedText: "Todo México",
    	selectAllText:"Todo México",
        nonSelectedText: "Ningún Estado seleccionado",
        numberDisplayed: 2,
        nSelectedText: "Estados seleccionados",
        onChange: function() {
            $.uniform.update();
        }
    });
    
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice'});
    
    
  var bestBps = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('CONCESIONARIO'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
  	cache : false,
    url: 'https://rpc.ift.org.mx/vrpc/index.php/RpcServicesController/searchBP?query=%QUERY',
    wildcard: '%QUERY'
  }
});

$('#concesionario-remote-search .typeahead').typeahead({minLength: 3,
  highlight: true}, {
  name: 'best-cedentes',
  display: 'CONCESIONARIO',
  source: bestBps,
  templates: {
    empty: [
      '<div class="empty-message">',
        'Concesionario inexistente',
      '</div>'
    ].join('\n')
  }
});

$('#concesionario-remote-search .typeahead').bind('typeahead:select', function(ev, suggestion) {
  console.log('Selection: ' + suggestion.CONCESIONARIO);
   $("#txtBPConcesionario").val(suggestion.ID_BP);
   //fillFetsCombo(suggestion.ID_BP);
});

var bestFets = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('FOLIO_ELECTRONICO'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
  	cache : false,
    url: 'https://rpc.ift.org.mx/vrpc/index.php/RpcServicesController/searchFET?query=%QUERY',
    wildcard: '%QUERY'
  }
});

$('#fets-remote-search .typeahead').typeahead({minLength: 4,
  highlight: true}, {
  name: 'best-fets',
  display: 'FOLIO_ELECTRONICO',
  source: bestFets,
  templates: {
    empty: [
      '<div class="empty-message">',
        'FET inexistente',
      '</div>'
    ].join('\n')
  }
});

$('#fets-remote-search .typeahead').bind('typeahead:select', function(ev, suggestion) {
  console.log('Selection: ' + suggestion.FOLIO_ELECTRONICO);
   //$("#txtBPConcesionario").val(suggestion.ID_BP);
   //fillFetsCombo(suggestion.ID_BP);
});


var bestExpedientes = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('EXPEDIENTE'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: {
  	cache : false,
    url: 'https://rpc.ift.org.mx/vrpc/index.php/RpcServicesController/searchExpedientes?query=%QUERY',
    wildcard: '%QUERY'
  }
});

$('#exp-remote-search .typeahead').typeahead({minLength: 4,
  highlight: true}, {
  name: 'best-expedientes',
  display: 'EXPEDIENTE',
  source: bestExpedientes,
  templates: {
    empty: [
      '<div class="empty-message">',
        'Expediente o distintivo inexistente',
      '</div>'
    ].join('\n')
  }
});

$('#exp-remote-search .typeahead').bind('typeahead:select', function(ev, suggestion) {
  console.log('Selection: ' + suggestion.EXPEDIENTE);
});
    
    
   </script>     
  </body>
</html>
