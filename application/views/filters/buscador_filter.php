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
<!-- filter buscador -->
                        <div class="tab-pane" id="buscador">
                        <h3>Búsqueda de <span>documentos</span></h3>
                        
                        	<div class="row">
                            	
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Folio de trámite electrónico</label>
                                        <input type="text" id="buscador-folio" name="buscador-folio" class="form-control">
                                    </div>
                                </div>
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                    	<label><i class=" icon_set_1_icon-95"></i>Tipo de acto</label>
                                        <select id="buscador-id-tipo-tramite" class="form-control">
                                            <option value="">Seleccione una opción...</option>
                                            <option value="1">Registro de Contrato de adhesión</option>
                                            <option value="2">Registro de Nombre comercial</option>
                                            <option value="3">Registro de Tarifas de servicios y espacios de publicidad</option>
                                            <option value="5">Registro de Aviso de domicilio para notificaciones y centros de atención</option>
                                            <option value="8">Registro de Puntos de interconexión</option>
                                            <option value="12">Registro de Estructura accionaria o de partes sociales o aportaciones</option>
                                            <option value="13">Registro de Formalización de enajenación de acciones</option>
                                            <option value="14">Registro de Convenio/contrato celebrado entre concesionarios</option>
                                            <option value="15">Registro de Gravamen impuesto a las concesiones</option>
                                            <option value="16">Registro de Aviso de inicio o terminación de prestación de servicios de telecomunicaciones y/o de ampliación o reducción de áreas geoestadísticas</option>
                                            <option value="17">Registro de Convenio de interconexión internacional</option>
                                            <option value="18">Registro de Contrato de arrendamiento de espectro radioeléctrico, sus modificaciones y terminación</option>
                                            <option value="19">Registro de Formalización de transmisión de derechos de concesiones o autorizaciones</option>
                                            <option value="38">Avisos en materia de integración de socios o asociados</option>
                                        </select>
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
                            <hr>
                            <button class="btn_1 green" onclick="searchBuscador(event);"><i class="icon-search"></i>Iniciar búsqueda</button>
                            <span></span>
                            <button class="btn_1 orange" onclick="cleanBuscador(event);"><i class="icon_set_1_icon-67"></i>Borrar filtros</button>
                        </div>
                        <!-- filter buscador -->
