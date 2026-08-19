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
    if (!isset($section) OR $section == null) {
    	if ($defaultValue=='TODAY') {
    		return date('d/m/Y');	
    	} else {
        	return $defaultValue;
		}
    }
	if (!isset($section->$field)) {
		return $defaultValue;
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

function count_Arr($object) {
     if (!isset($object)) {
     	return 0;
     } 
	 if (is_object($object)) {
	 	return 1;
	 } else if (is_array($object)) {
	 	return(count($object));
	 }
	 return 0;
   }


?>
    
        
<!-- RECORDS -->
<?php 
	if ($concesionesResults!== null) {
?>
		<div class="main_title">
            <h2><span>R</span>esultados</h2>
            <!--<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>-->
        </div>

<?php
//print_r($concesionesResults);
      foreach($concesionesResults as $record) {
      	//var_dump($record);
?>      	
    			<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                   <div class="row">
                    <div class="clearfix visible-xs-block"></div>
                   
                    <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">
<?php
			
			if ($record->ESTADO_CONCESION=='VIGENTE') {
				echo "<div class='ribbon vigente' ></div>";
			} else if ($record->ESTADO_CONCESION=='TERMINADO') {
				echo "<div class='ribbon terminado' ></div>";
			} else if ($record->ESTADO_CONCESION=='EN PROCESO DE PRORROGA') {
				echo "<div class='ribbon prorroga' ></div>";
			} else if ($record->ESTADO_CONCESION=='RENUNCIA') {
				echo "<div class='ribbon renuncia' ></div>";
			} else if ($record->ESTADO_CONCESION=='VENCIDO') {
				echo "<div class='ribbon vencido' ></div>";
			} else if ($record->ESTADO_CONCESION=='NO VIGENTE') {
				echo "<div class='ribbon no-vigente' ></div>";
			} else if ($record->ESTADO_CONCESION=='EXTINGUIDO') {
				echo "<div class='ribbon extinguido' ></div>";
			} else if ($record->ESTADO_CONCESION=='CANCELADO') {
				echo "<div class='ribbon cancelado' ></div>";
			}
			
			
			
?>                    	
                    		
                    		<div class="tour_list_desc">

                            <div class="rating">
                            	<!--<i class="icon-smile voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile  voted"></i><i class="icon-smile"></i><small>(75)</small>-->
                            	</div>

                    		<h3><strong><?php echo getFieldValue($record,'C_FOLIO_ELECTRONICO'); ?></strong> - <?php echo getFieldValue($record,'CONCESIONARIO_NAME'); ?></h3>
                    		<p>
                    		TIPO DE INSCRIPCIÓN: <strong><?php echo getFieldValue($record,'TIPO_INSCRIPCION'); ?></strong> <br>
<?php
	$ncomercial = getFieldValue($record,'NOMBRE_COMERCIAL');
	if ($ncomercial!==null && $ncomercial!=='') {
?>                    		
                    		NOMBRE COMERCIAL: <strong><?php echo getFieldValue($record,'NOMBRE_COMERCIAL'); ?></strong> <br>
<?php
	}
?>                    		
                    		SERVICIO: <strong><?php echo getFieldValue($record,'SERVICIO_RADIOCOM'); ?></strong> <br>
                    		EXPEDIENTE: <strong><?php echo getFieldValue($record,'C_DISTINTIVO_LLAMADA'); ?></strong> <br>
                    		
                            </p>
                            
                            
                            
                            <div class="col-lg-9 col-md-9 col-sm-9">
                            <table style="width: 100%;">
                            	<thead>
                            		<tr>
                            			<th colspan="4">Bandas de frecuencias</th>
                            		</tr>
                            		<tr>
                            		<th>Tipo de estación</th>
                            		<th>Tx (Mhz)</th>
                            		<th>Rx (Mhz)</th>
                            		<th>Estado</th>
                            		</tr>
                            	</thead>
                            	<tbody>
<?php					
					foreach($record->SITIOS as $recG1) {
?>
							<tr>
								<td><?php echo getFieldValue($recG1,'tipoEstacion'); ?></td>
								<td><?php echo getFieldValue($recG1,'rx'); ?></td>
								<td><?php echo getFieldValue($recG1,'tx'); ?></td>
								<td><?php echo getFieldValue($recG1,'estado'); ?></td>
							</tr>
<?php						
					}
?>                            		
                            	</tbody>
                            </table>
                            </div>
                            
                            
                            </div>
                            
                    </div>

<!-- documentos -->                    
			<div class="col-lg-3 col-md-3 col-sm-3">

			
						
    </div> <!-- documentos -->
           
                    </div> <!-- row -->
                    
                    </div><!--End strip -->

<?php 
		} /* foreach */

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
        
        
        
        
