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
<!-- filter convenios -->
                        <div class="tab-pane" id="convenios">
                        <h3>Búsqueda de <span>convenios</span></h3>
                        
                        	<div class="row">
                            	
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Tipo de convenio</label>
                                    	<div class="multi-select-full">
                                        <select id="rpc-tipo-convenio" class="multiselect" multiple="multiple">
                                        	<option value="2" >ACCESO Y USO COMPARTIDO DE INFRAESTRUCTURA PASIVA</option>
                                            <option value="3" >COMERCIALIZACIÓN O REVENTA DEL SERVICIO</option>
                                            <option value="10" >CONTRATO DE PRESTACIÓN DE SERVICIOS (RED MAYORISTA)</option>
                                            <option value="8" >DESAGREGACIÓN DEL BUCLE LOCAL</option>
                                            <option value="7" >INTERCAMBIO ELECTRÓNICO DE MENSAJES CORTOS</option>
                                            <option value="1" >INTERCONEXION</option>
                                            <option value="9" >ROAMING NACIONAL</option>
                                            <option value="4" >SERVICIO MAYORISTA </option>
                                            <option value="5" >SERVICIO MAYORISTA DE USUARIO VISITANTE</option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                            	
                            	<!--
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Descripción del convenio</label>
                                        <div id="convenio_desc-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Descripción del convenio" 
						                	id="convenio_desc_search" name="convenio_desc_search">						                	
                						</div>
                                 	</div>
                                </div>
                               -->
                                
                                
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
                        				<input id="txtConvFecIni" name="txtConvFecIni" class="date-pick form-control" data-date-format="dd/mm/yyyy" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                	<div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Fecha final</label>
                        				<input id="txtConvFecFin" name="txtConvFecFin" class="date-pick form-control" data-date-format="dd/mm/yyyy" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Folio de inscripción</label>
                                        <input type="text" id="conv_folio" name="conv_folio" class="form-control">
                                    </div>
                                </div>
                            </div><!-- End row -->
                            
                            <div class="row">
                            	<div class="col-md-6">
                            		
                            		<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Convenio entre el operador</label>
                                        <div id="conv-source1-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Operador" 
						                	id="conv_operador1_search" name="conv_operador1_search">
						                	<input type="hidden" id="conv-source1-bp" name="conv-source1-bp" />
                						</div>
                                    </div>
                            		
                                </div>
                                <div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>y el operador</label>
                                        <div id="conv-source2-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Operador" 
						                	id="conv_operador2_search" name="conv_operador2_search">
						                	<input type="hidden" id="conv-source2-bp" name="conv-source2-bp" />
                						</div>
                                    </div>
                                </div>
                            </div> <!-- End row -->
                            <hr>
                            <button class="btn_1 green" onclick="searchConvenios(event);"><i class="icon-search"></i>Iniciar búsqueda</button>
                            <span></span>
                            <button class="btn_1 orange" onclick="cleanConvenios(event);"><i class="icon_set_1_icon-67"></i>Borrar filtros</button>
                        </div>
                        <!-- filter convenios -->
