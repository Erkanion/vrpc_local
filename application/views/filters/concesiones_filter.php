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

?>

<!-- filter concesiones -->
                        <div class="tab-pane" id="concesiones">
                        <h3>Búsqueda de <span>concesiones, permisos y autorizaciones</span></h3>
                        	<div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-94"></i>Nombre o denominación social</label>
                                        <div id="concesionario-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Nombre o denominación social" 
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
                                            <optgroup label="Más servicios">
                                            	<option value="7" >Radiolocalización de Vehículos</option>
                                            	<option value="8" >Radiolocalización Móvil de Personas</option>
                                            	<option value="9" >Provisión de Capacidad / enlaces</option>
                                            	<option value="10" >Servicios Satelitales</option>
                                            	<option value="11" >Conducción de Señales</option>
                                            	<option value="12" >Mensajería Digital</option>
                                            	<option value="14" >Radiocomunicación Móvil Terrestre</option>
                                            	<option value="15" >Radiocomunicación Móvil Aeronáutica</option>
                                            	<option value="20" >Telefonía Pública</option>
                                            	<option value="21" >Estaciones Terrenas</option>
                                            	<option value="22" >Transmisión de datos</option>
                                            	<option value="23" >Transmisión Bidireccional de datos</option>
                                            	<option value="24" >Transporte de Señales del Servicio Local</option>
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
                                
                                
<!--
	<select id="rpc-estatus" class="multiselect">
                                        	<option value="ANY" >Cualquier estatus</option>
                                            <option value="VIG" >Solo vigentes</option>
                                            <option value="TER" >Solo terminadas</option>
                                            <option value="INP" >En proceso de prórroga</option>                                            
                                        </select>
-->                                
                                
                                <div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-65"></i>Estatus</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-estatus" class="multiselect">
                                        	<option value="ANY" >Cualquier estatus</option>
                                            <option value="VIG" >Solo vigentes</option>
                                            <option value="CAN" >Cancelados</option>
                                            <option value="EXT" >Extinguidos</option>
                                            <option value="INP" >En proceso de prórroga</option>
                                            <option value="NOV" >No vigentes</option>
                                            <option value="REN" >Renuncias</option>
                                            <option value="TER" >Terminados</option>
                                            <option value="VEN" >Vencidos</option>                                            
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
/*print_r($satelitesList);*/
	if ($satelitesList!==null) {
		foreach ($satelitesList as $satelite) {
    		/*$fldL01 = getFieldValue($satelite, 'NOM_SATELITE');*/
			$fldL01 = getFieldValue($satelite, 'nomSatelite');
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
    		$fldLP = getFieldValue($posicion, 'pos_orbital');
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
                            
                            <div class="row">
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Tipo</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-tipo" class="multiselect">
                                        	<option value="ANY" selected="selected" >Cualquier tipo</option>
                                        	<option value="CO" >Concesiones</option>
                                        	<option value="UN" >Única o de red pública de telecomunicaciones</option>
                                        	<option value="BE" >Bandas del espectro radioeléctrico</option>
                                        	<option value="RM" >Red mayorista</option>
                                        	<option value="RO" >Recursos orbitales</option>
                                            <option value="PE" >Permisos</option>
                                            <option value="AU" >Autorizaciones</option>
                                            <option value="AS" >Asignaciones</option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Tipo de uso</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-tipo-uso" class="multiselect">
                                        	<option value="ANY" selected="selected" >Cualquier tipo de uso</option>
                                        	<option value="1" >Comercial</option>
                                        	<option value="2" >Público</option>
                                        	<option value="3" >Privado comunicación privada</option>
                                        	<option value="4" >Privado experimental</option>
                                        	<option value="5" >Radioaficionados</option>
                                            <option value="6" >Social</option>
                                            <option value="7" >Social comunitaria</option>
                                            <option value="8" >Social indígena</option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            	
                            	<!--
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-86"></i> Canal TV</label>
                        				<input type="text" class="form-control" id="canal_search" name="canal_search" placeholder="Canal ">
                                    </div>
                                </div>
                               -->
                                
                                
                            </div><!-- End row -->
                            
                            <!-- OMV -->
                            <div class="row">
                            	
                            	<div class="col-md-1">
                            		<p>&nbsp;</p>
                            	</div>
                            	<div class="col-md-9">
                            		
                            		<div class="filter_type">
										<ul>
											<li><label><input type="checkbox" id="cbOMV" name="cbOMV" value="1">Operadores Móviles Virtuales</label></li>
										</ul>
									</div>
                            		
                                </div>
                            	
                            </div>
                            <!-- OMV -->
                            
                            <!--
                            <div class="row">
                            	
                            	<div class="col-md-1">
                            		<p>&nbsp;</p>
                            	</div>
                            	<div class="col-md-9">
                            		
                            		<div class="filter_type">
										<ul>
											<li><label><input type="checkbox" id="cbComercializadora" name="cbComercializadora" value="1">Comercializadoras</label></li>
										</ul>
									</div>
                            		
                                </div>
                            	
                            </div>
                            -->
                            
                            <div class="row">
                            	
                            	<div class="col-md-1">
                            		<p>&nbsp;</p>
                            	</div>
                            	<div class="col-md-9">
                            		
                            		<div class="filter_type">
										<ul>
											<li><label><input type="checkbox" id="cbRangoFrecuencias" name="cbRangoFrecuencias" value="1">Utilizar rango de frecuencias <small>* No aplica para permisos de radiocomunicación privada</small></label></li>
										</ul>
									</div>
                            		
                                	<div class="form-group" id="filter_rango_frecuencias" name="filter_rango_frecuencias">
                                        <label><i class=" icon_set_1_icon-7"></i>Rango de frecuencias - Telecomunicaciones</label>
                                        
						                <input type="text" id="rangeFrecuenciaCon" name="rangeFrecuenciaCon" value="">
                                    </div>
                                </div>
                            	
                            </div><!-- End row -->
                            
                            <div class="row">
                            	
                            	<div class="col-md-1">
                            		<p>&nbsp;</p>
                            	</div>
                            	<div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Frecuencia - Telecomunicaciones</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-frecuencia" class="multiselect">
                                        	<option value="ANY" selected="selected" >Cualquier frecuencia</option>
                                        	<option value="1" >150 MHZ</option>
                                        	<option value="2" >170 MHZ</option>
                                        	<option value="3" >200 MHZ</option>
                                        	<option value="4" >400 MHZ</option>
                                        	<option value="5" >600 MHZ</option>
                                            <option value="6" >800 MHZ</option>
                                            <option value="7" >900 MHZ</option>
                                            <option value="8" >1.7/2.1 GHZ</option>
                                            <option value="9" >1.9 GHZ</option>
                                            <option value="10" >2.5 GHZ</option>
                                            <option value="11" >3.4 GHZ</option>
                                            <option value="12" >7 GHZ</option>
                                            <option value="13" >10 GHZ</option>
                                            <option value="14" >15 GHZ</option>
                                            <option value="15" >23 GHZ</option>
                                            <option value="16" >37/38 GHZ</option>
                                            
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            	
                            </div><!-- End row -->
                            
                            <hr>
                            <button class="btn_1 green" onclick="searchConcesiones(event);"><i class="icon-search"></i>Iniciar búsqueda</button>
                            <span></span>
                            <button class="btn_1 orange" onclick="location.reload();"><i class="icon_set_1_icon-67"></i>Borrar filtros</button>
                        </div>
                        <!-- End tab concesiones-->