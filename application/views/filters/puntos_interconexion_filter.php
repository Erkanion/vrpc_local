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
                        <div class="tab-pane" id="puntosinterconexion">
                        <h3>Búsqueda de puntos de <span>interconexión</span></h3>
                        
                        	<div class="row">
                            	
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Operador</label>
                                        <div id="puntos-bp-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Operador" 
						                	id="puntos_operador1_search" name="puntos_operador1_search">
						                	<input type="hidden" id="puntos-source1-bp" name="puntos-source1-bp" />
                						</div>
                                    </div>
                                </div>
                            	
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class=" icon_set_1_icon-7"></i>Descripción de los servicios</label>
                                        <div id="puntos-desc1-remote-search">
						                	<input type="text" class="form-control typeahead" placeholder="Descripción del convenio" 
						                	id="convenio_desc1_search" name="convenio_desc1_search">						                	
                						</div>
                                 	</div>
                                </div>
                                
                                
                            </div><!-- End row -->
                        
                        	<div class="row">
                            	<div class="col-md-6">
                                	<div class="form-group">
                                        <label><i class="icon-calendar-7"></i> Fecha de inscripcion</label>
                        				<input id="txtPuntosFecInsc" name="txtPuntosFecInsc" class="date-pick form-control" data-date-format="dd/mm/yyyy" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Folio de inscripción</label>
                                        <input type="text" id="puntosFolioInsc" name="puntosFolioInsc" class="form-control">
                                    </div>
                                </div>
                            </div><!-- End row -->
                            
                            <hr>
                            <button class="btn_1 green" onclick="searchPuntosInt(event);"><i class="icon-search"></i>Iniciar búsqueda</button>
                        </div>
                        <!-- filter convenios -->