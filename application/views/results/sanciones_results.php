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
    
        
<!-- RECORDS -->
<?php 
	if ($sancionesResults!== null) {
?>
		<div class="main_title">
            <h2><span>R</span>esultados</h2>
            <!--<p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>-->
        </div>

<?php
      foreach($sancionesResults as $record) {
      	//var_dump($record);
?>      	
    			<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                   <div class="row">
                    <div class="clearfix visible-xs-block"></div>
                   
                    <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">
                    		
                    		<div class="tour_list_desc">

                            <div class="rating">
                            </div>

                    		<h3><strong><?php echo getFieldValue($record,'TIPO_INFORME'); ?></strong></h3>
                    		<p>
                    		FOLIO DE INSCRIPCIÓN: <strong><?php echo getFieldValue($record,'ID_INSCRIPCION'); ?></strong> <br>
                    		PERIODO: <strong><?php echo getFieldValue($record,'PERIODO'); ?></strong> <br>                    		
                    		OPERADOR: <strong><?php echo getFieldValue($record,'AEP'); ?></strong> <br>
                            </p>
                            <!-- verificar estilo de este nuevo div -->
                            
                            </div>
                            
                    </div>

<!-- documentos -->                    
			<div class="col-lg-3 col-md-3 col-sm-3">

<?php
	$documentPdf = $record->DOCUMENT;
	if ($documentPdf!==null && $documentPdf!=="") {
?>
	<table class="table table_documents">
		<tbody>
			<tr>
				<tr>
					<td>
						<strong>Documentos</strong>
					</td>
				</tr>
				<td>
					<i class=" icon-doc"></i><a href="<?php echo URLAPPPUBLISH;?>publish/pdfs/informes/<?php echo $documentPdf;?>" target="_blank">Ver documento</a>
				</td>
			</tr>
		</tbody>
	</table>
<?php
	}	
?>
			
						
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
