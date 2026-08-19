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

		//$URLASSETSPROGANUAL = 'http://ucsweb.ift.org.mx/tarifasrpc/upload/files/proganualinformes/';
		$URLASSETSPROGANUAL = URLAPPSERT.'upload/files/proganualinformes/';

		//$this->objClient = new SoapClient("http://10.34.144.82:7010/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>10));
		$this->objClient = new SoapClient(URLSEARCHWS."?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
        //$this->load->model('catalogsdb', '', TRUE);
        
        $dataInputProg = array(
            'dummy' => 'dummy'
        );
		
		$programasAnualesResults = null;
		
		try {
		   $objFets =  $this->objClient->vRpcProgramasAnuales($dataInputProg);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		
		foreach ($objFets as $fets) {
			$programasAnualesResults = $fets;			
		}
		if (count($programasAnualesResults)==1) {
			$tmpArray = $programasAnualesResults;
			$programasAnualesResults = array($tmpArray);
		}


?>

<!-- filter cnaf -->
	<div class="tab-pane" id="programas_anuales">
		<div class="row list_tours_tabs">
			<div class="col-md-12 col-sm-12">
            	<h3>Programas <span>Anuales</span> de Trabajo</h3>
					<ul>
						
<!-- RECORDS -->
<?php 
	if ($programasAnualesResults!== null) {
		foreach($programasAnualesResults as $informeItem) {
?>
						
                    	<li><div>
                        	<h3><strong><?php echo getFieldValue($informeItem,'tituloInforme'); ?></strong></h3>
                           	<small>Folio de inscripción: <strong><?php echo getFieldValue($informeItem,'folioInscripcion'); ?></strong></small>
                           	<br/><small>Fecha de inscripción: <strong><?php echo getFieldValue($informeItem,'fechaInscripcion'); ?></strong></small>
                           	<br/><a href="<?php echo $URLASSETSPROGANUAL. getFieldValue($informeItem,'urlFile'); ?>" target="_blank">Ver documento</a>
                           	</div>
						</li>
						

<!-- RECORDS -->
<?php 
		}
	}
?>						
						
                        <li><div>&nbsp;</div></li>
					</ul>
			</div>
		</div>
	</div>
<!-- filter cnaf -->