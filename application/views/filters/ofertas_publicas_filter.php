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


function count_Arr($object) {
     if (!isset($object)) {
     	return 0;
     } 
	 if (is_object($object)) {
	 	return 1;
	 } else {
	 	return(count($object));
	 }
	 return 0;
   }

/*
function checkStringEmpty($cadena) {
	   	if($cadena!==null && trim($cadena)!=="" ) {
	   		return trim($cadena);
	   	} else {
	   		return "-";
	   	}
   }
 */

		ini_set('default_socket_timeout', 300);	
		//$this->objClient = new SoapClient("http://10.34.144.82:7010/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>10));
		//$this->objClient = new SoapClient("http://172.17.42.113:9001/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
                $this->objClient = new SoapClient(URLSEARCHWS."?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
        //$this->load->model('catalogsdb', '', TRUE);
        
        $dataInput = array(
            'dummy' => 'dummy'
        );
		
		$ofertasPublicasResults = null;
		
		try {
		   $objOfertaP =  $this->objClient->vRpcOfertasPublicas($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		
		foreach ($objOfertaP as $ofertas) {
			$ofertasPublicasResults = $ofertas;			
		}
		if (count_Arr($ofertasPublicasResults)==1) {
			$tmpArray = $ofertasPublicasResults;
			$ofertasPublicasResults = array($tmpArray);
		}

?>

<!-- filter cnaf -->
                        <div class="tab-pane" id="ofertas_publicas">


			<div class="row list_tours_tabs">
                        	<div class="col-md-12 col-sm-12">
                            <h3>Ofertas <span>Públicas</span> de Referencia</h3>
							<ul>

<!-- RECORDS -->
<?php 
	if ($ofertasPublicasResults!== null) {
		foreach($ofertasPublicasResults as $ofertaItem) {
?>
                            	<li><div>
                           	    <h3><strong><?php echo getFieldValue($ofertaItem,'tituloOferta'); ?></strong></h3>
                           	    <small>Folio de inscripción: <strong><?php echo getFieldValue($ofertaItem,'folioInscripcion'); ?></strong></small>
                           	    <br/><small>Concesionario(s): <strong><?php echo getFieldValue($ofertaItem,'concesionario'); ?></strong></small>
                           	    <br/><small>Fecha de inscripción: <strong><?php echo getFieldValue($ofertaItem,'fechaInscripcion'); ?></strong></small>
                           	    <br/><small>Resolución de Pleno: <strong><?php echo getFieldValue($ofertaItem,'resolucion'); ?></strong></small>
                           	    <br/><small>Fecha de resolución: <strong><?php echo getFieldValue($ofertaItem,'fechaResolucion'); ?></strong></small>
                           	    <table>
                           	    		<tr><th>Folios electrónicos</th></tr>
                           	    		<tbody>
<?php
		if (isset($ofertaItem->folios)) {
			$folios = $ofertaItem->folios;
			if (count_Arr($folios)==1) {
				$tmpArray = $folios;
				$folios = array($tmpArray);
			}
			foreach($folios as $foliosItem) {
?>
					<tr><td><a href="#" onclick="displayDetail(event, <?php echo getFieldValue($foliosItem,'idConcesion'); ?>);"><?php echo getFieldValue($foliosItem,'fet'); ?></a></td></tr>
					
<?php				
				
				
			}
		}
?>                           	    			
                           	    		</tbody>
                           	    	</table>
                           	    <br/><a href="<?php echo URLASSETSOFERTAP.getFieldValue($ofertaItem,'urlFile'); ?>" target="_blank"><small><strong>Ver documento</strong></small></a>
                           	    </div>
                                </li>
<!-- RECORDS -->
<?php 
		}
	}
?>
                                
                                
                            </ul>
                            </div>
                        </div>

                        
                        </div>
                        <!-- filter cnaf -->
