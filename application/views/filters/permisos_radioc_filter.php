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
                        <div class="tab-pane" id="permisosrc">
                        <h3>Búsqueda de <span>permisos</span> de radiocomunicación privada</h3>
                        
                        <div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-94"></i>Permisionario/autorizado</label>
                                        <div id="concesionario-remote-searchPRP">
						                	<input type="text" class="form-control typeahead" placeholder="Nombre del concesionario" 
						                	id="txtConcesionarioPRP" name="txtConcesionarioPRP">
						                	<input type="hidden" id="txtBPConcesionarioPRP" name="txtBPConcesionarioPRP" />
                						</div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-59"></i>Servicios</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-servicesPRP" multiple="multiple" class="multiselect">
                                            <option value="RADIOCOMUNICACION DE SERVICIO PRIVADO" >RADIOCOMUNICACION DE SERVICIO PRIVADO</option>
                                            <option value="RADIOTELEFONICO DE SERVICIO PRIVADO" >RADIOTELEFONICO DE SERVICIO PRIVADO</option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            </div><!-- End row -->
                        
                        <div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Folio electrónico</label>
                                        <div id="fets-remote-searchPRP">
						                	<input type="text" class="form-control typeahead" placeholder="Folio electrónico" 
						                	id="fet_searchPRP" name="fet_searchPRP">
                						</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-37"></i>Cobertura (Estado)</label>
                                        <div class="multi-select-full">
                                        <select id="rpc-estadosPRP" class="multiselect" multiple="multiple">
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
                                        <label><i class=" icon_set_1_icon-93"></i>Expediente</label>
                                        <div id="exp-remote-searchPRP">
						                	<input type="text" class="form-control typeahead" placeholder="Número de expediente" 
						                	id="expediente_searchPRP" name="expediente_searchPRP">
                						</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Rango de segmentos</label>
						                <input type="text" id="rangePRP" name="rangePRP" value="">
                                    </div>
                                </div>
                                
                            </div><!-- End row -->
                            
                            
                            <hr>
                            <button class="btn_1 green" onclick="searchPermisosRadiodifusion(event);"><i class="icon-search"></i>Iniciar búsqueda</button>
                            <span></span>
                            <button class="btn_1 orange" onclick="cleanPermisosRadiodifusion(event);"><i class="icon_set_1_icon-67"></i>Borrar filtros</button>
                        
                        
                        </div>
                        <!-- End tab concesiones-->