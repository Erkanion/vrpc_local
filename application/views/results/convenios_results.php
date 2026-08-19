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
    if (!isset($section->$field) OR $section->$field == null) {
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
	if ($conveniosResults!== null) {
?>
		<div class="main_title">
            <h2><span> R</span>esultados (<?php echo count_Arr($conveniosResults); ?>) </h2>
        </div>

<?php
      foreach($conveniosResults as $record) {
?>      	
    			<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                   <div class="row">
                    <div class="clearfix visible-xs-block"></div>
                   
                    <div class="col-lg-9 col-md-9 col-sm-9" style="background: #ffffff;">
<?php
			if ($record->ESTATUS=='VIGENTE') {
				echo "<div class='ribbon vigente' ></div>";
			} else if ($record->ESTATUS=='TERMINADO') {
				echo "<div class='ribbon terminado' ></div>";
			} else if ($record->ESTATUS=='EN PROCESO DE PRORROGA') {
				echo "<div class='ribbon prorroga' ></div>";
			} 
?>                    	
                    		
                    		<div class="tour_list_desc">

                            <div class="rating">
                            </div>

                    		<h3><strong><?php echo getFieldValue($record,'DESCRIPCION_TIPO'); ?></strong></h3>
                    		<p>
                    		EXPEDIENTE: <strong><?php echo getFieldValue($record,'EXPEDIENTE'); ?></strong> <br>
                    		FOLIO DE INSCRIPCIÓN: <strong><?php echo getFieldValue($record,'FOLIO_INSCRIPCION'); ?></strong> <br>
                    		MODALIDAD DE CONVENIO: <strong><?php echo getFieldValue($record,'CI_TIPO_INSCRIPCION'); ?></strong> <br>
                    		<!-- <strong><?php echo getFieldValue($record,'DESCRIPCION'); ?></strong> <br> -->
                    		FECHA DE CELEBRACIÓN: <strong><?php echo getFieldValue($record,'FECHA_CELEBRACION'); ?></strong> <br>
                            </p>
                            <!-- verificar estilo de este nuevo div -->
                            
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <table>
                            	<thead>
                            		<tr>
                            			<th colspan="2">Operadores 1</th>
                            		</tr>
                            		<tr>
                            		<th>Folio electrónico</th>
                            		<th>Operador</th>
                            		</tr>
                            	</thead>
                            	<tbody>
<?php					
					foreach($record->FETS_G1 as $recG1) {
						//$sIdConcesion = substr($recG1->CI_FET,3,6);
						//$sIdConcesion = $recG1->idConcesion;
						$sIdConcesion = getFieldValue($recG1,'idConcesion','');
						$idConcesion = (int)$sIdConcesion;
?>
							<tr>
								<td><a href="#" onclick="displayDetail(event, <?php echo $idConcesion ?>);"><?php echo getFieldValue($recG1,'fet'); ?></a></td>
								<td><?php echo getFieldValue($recG1,'concesionario'); ?></td>
							</tr>
<?php						
					}
?>                            		
                            	</tbody>
                            </table>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <table>
                            	<thead>
                            		<tr>
                            			<th colspan="2">Operadores 2</th>
                            		</tr>
                            		<tr>
                            		<th>Folio electrónico</th>
                            		<th>Operador</th>
                            		</tr>
                            	</thead>
                            	<tbody>
<?php				
					foreach($record->FETS_G2 as $recG2) {
						if (isset($recG2->idConcesion)) {
							//$sIdConcesion = $recG2->idConcesion;
							$sIdConcesion = getFieldValue($recG2,'idConcesion','');
							$idConcesion = (int)$sIdConcesion;
?>
							<tr>
								<td><a href="#" onclick="displayDetail(event, <?php echo $idConcesion ?>);"><?php echo getFieldValue($recG2,'fet'); ?></a></td>
								<td><?php echo getFieldValue($recG2,'concesionario'); ?></td>
							</tr>
<?						
						} else {
?>
							<tr>
								<td>&nbsp;</td>
								<td><?php echo getFieldValue($recG2,'concesionario'); ?></td>
							</tr>
<?php							
						}
					}
?>                            		
                            	</tbody>
                            </table>
                            </div>                            
                            
                            </div>
                            
                    </div>

<!-- documentos -->                    
			<div class="col-lg-3 col-md-3 col-sm-3">


	<table class="table table_documents">
		<tbody>
			<tr>
				<tr>
					<td>
						<strong>Documentos</strong>
					</td>
				</tr>
				<?php
				$listDoc = $record->LISTDOC ?? [];

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
							<?php
							$enlaceDoc = (isset($doc->enlaceDoc) && !empty($doc->enlaceDoc)) ? $doc->enlaceDoc : '';
							if ($enlaceDoc !== '' && substr($enlaceDoc, -1) === '/') {
								$enlaceDoc .= $doc->nombreDocumento;
							}
							$href = ($enlaceDoc !== '') ? $enlaceDoc : URLAPPPUBLISHVRPC . "assets/publish/convenios/" . $doc->nombreDocumento;
							?>
							<i class=" icon-doc"></i><a href="<?php echo $href; ?>" target="_blank">Ver documento del convenio (<?= $doc->tipoDocumento;?>)</a>
						</td>
					</tr>
				    <?php endforeach; ?>

				<?php else: ?>

		    <tr>
		        <td>No hay documentos disponibles</td>
		    </tr>

			<?php endif; ?>
				
			</tr>
		</tbody>
	</table>
	

			
						
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
        
        
        
<!--        
        
        <p class="text-center nopadding">
            <a href="#" class="btn_1 medium"><i class="icon-eye-7"></i>Más resultados </a>
        </p>
-->        
