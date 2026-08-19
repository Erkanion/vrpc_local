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
	if ($interconexionInternacionalResults!== null) {

?>
		<div class="main_title">
            <h2><span>R</span>esultados C</h2>
        </div>

<?php
      foreach($interconexionInternacionalResults as $record) {
      	//var_dump($record);
?>      	
    			<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                   <div class="row">
                    <div class="clearfix visible-xs-block"></div>
                   
                    <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">
<?php
			/*echo "<div class='ribbon vigente' ></div>";*/
?>                    	
                    		
                    		<div class="tour_list_desc">

                            <div class="rating">
                            	</div>

                    		<h3><strong><?php echo getFieldValue($record,'concesionario'); ?></strong></h3>
                    		<p>
                    			OPERADOR EXTRANJERO: <strong><?php echo getFieldValue($record,'externo'); ?></strong> <br>
                    			FOLIO DE INSCRIPCIÓN: <strong><?php echo getFieldValue($record,'folioInscripcion'); ?></strong> <br>
                    			FECHA DE INSCRIPCIÓN: <strong><?php echo getFieldValue($record,'fechaInscripcion'); ?></strong> <br>
                    			FECHA DE CELEBRACIÓN: <strong><?php echo getFieldValue($record,'fechaCelebracion'); ?></strong> <br>
                            </p>

                           
                            <div class="col-lg-12 col-md-12 col-sm-12">
                            <table style="width: 100%;">
                            	<thead>
                            		<tr>
                            		<th>Folio(s) electrónico(s)</th>
                            		</tr>
                            	</thead>
                            	<tbody>
<?php					
					
					if (isset($record->folios) AND count_Arr($record->folios)==1) {
						$tmpSArray = $record->folios;
						$record->folios = array($tmpSArray);
					}
					
					foreach($record->folios as $recG1) {
						//var_dump($recG1);
?>
							<tr>
								<td><a href="#" onclick="displayDetail(event, <?php echo getFieldValue($recG1,'idConcesion'); ?>);"><?php echo getFieldValue($recG1,'fet'); ?></a></td>
							</tr>
<?php						
					}
?>                            		
                            	</tbody>
                            </table>
                            <br/>
                            </div>
                            
                            
                            </div>
                            
                    </div>




<!-- documentos -->                    
			<div class="col-lg-3 col-md-3 col-sm-3">

		<strong></strong>
	<table class="table table_documents">
		<tbody>
		<?php
		$listDoc = $record->listDoc ?? [];

		// Formalizar listDoc a array para pintar correctamente uno o varios documentos.
		if (is_object($listDoc)) {
		    $listDoc = [$listDoc];
		} elseif (!is_array($listDoc)) {
		    $listDoc = [];
		}
		?>

		<?php if (!empty($listDoc)): ?>

		    <?php foreach ($listDoc as $doc): ?>
		        <tr>
 		            <td>
 		                <i class="icon-doc"></i>
		                <?php
		                $enlaceDoc = (isset($doc->enlaceDoc) && !empty($doc->enlaceDoc)) ? $doc->enlaceDoc : '';
						if ($enlaceDoc !== '' && substr($enlaceDoc, -1) === '/') {
							$enlaceDoc .= $doc->nombreDocumento;
						}
						$href = ($enlaceDoc !== '') ? $enlaceDoc : URLASSETSINTERNACIONAL . $doc->nombreDocumento;
		                ?>
 		                <a href="<?php echo $href; ?>" target="_blank">
 		                    Ver documento (<?= str_replace('_', ' ', $doc->tipoDocumento); ?>)
 		                </a>
 		            </td>
 		        </tr>
		    <?php endforeach; ?>

		<?php else: ?>

		    <tr>
		        <td>No hay documentos disponibles</td>
		    </tr>

		<?php endif; ?>

		</tbody>
		</table>			
						
    		</div> 
<!-- documentos -->
           
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
        
        
        
        
