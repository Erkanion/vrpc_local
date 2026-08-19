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


/*
 * Posteriormente, se implementará la consulta a BD  
 */
/*
		ini_set('default_socket_timeout', 300);	
		$this->objClient = new SoapClient("http://172.17.42.113:9001/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
        
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
		*/

?>

<!-- filter cnaf -->
<div class="tab-pane" id="donacion_equipos">


			<div class="row list_tours_tabs">
                        	<div class="col-md-12 col-sm-12">
                            <h3>Resoluciones/Contratos de <span>donación de equipos </span> </h3>
							<ul>
								
								<li><div>
                           	    <small>Folio de inscripción: <strong>39796</strong></small> 
                           	    <br/><small>Fecha de inscripción: <strong>21/01/2020</strong></small> 
                           	    <br/><small>Número de Resolución del Pleno: <strong>P/IFT/131119/639</strong></small> 
                           	    <br/><small>Donatario: <strong>RCBC COMUNICACIÓN, A.C.</strong></small>  
                           	    <br/><small>Resolución/Contrato: <strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A RCBC COMUNICACIÓN, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHRCB-FM, EN TAXCO DE ALARCÓN, IGUALA Y BUENAVISTA DE CUÉLLAR EN EL ESTADO DE GUERRERO</strong></small> 
                           	    <br/><a href="<?php echo URLASSETSDONACIONES.'39796_200310221509_7931.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a>
                           	    </div></li>
                           	    
                           	    <li><div> 
                           	    	<small>Folio de inscripción: <strong>39795</strong></small> 
                           	    	<br/><small>Fecha de inscripción: <strong>21/01/2020</strong></small> 
                           	    	<br/><small>Número de Resolución del Pleno: <strong>P/IFT/131119/638</strong></small> 
                           	    	<br/><small>Donatario: <strong>DIGITAL CON SENTIDO SOCIAL 106.3, A.C.</strong></small> 
                           	    	<br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A DIGITAL CON SENTIDO SOCIAL 106.3, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHCAS-FM, EN CHILPANCINGO DE LOS BRAVO, EN EL ESTADO DE GUERRERO</strong></small>
                           	    	<br/><a href="<?php echo URLASSETSDONACIONES.'39795_200310221455_6534.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                           	    	</div></li>
                           	    	
                           	    	<li><div> 
                           	    <small>Folio de inscripción: <strong>39143</strong></small> 
                           	    <br/><small>Fecha de inscripción: <strong>13/12/2019</strong></small> 
                           	    <br/><small>Número de Resolución del Pleno: <strong>P/IFT/180919/454</strong></small> 
                           	    <br/><small>Donatario: <strong>IKE SIIDI VIAA, A.C.</strong></small> 
                           	    <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A IKE SIIDI VIAA, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHIKE-FM, EN SALINA CRUZ, EN EL ESTADO DE OAXACA</strong></small>
                           	    <br/><a href="<?php echo URLASSETSDONACIONES.'39143_200310221441_2146.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                           	    </div></li> 		
                           	    	 
                           	    	 
                           	    	<li><div> 
                           	    	<small>Folio de inscripción: <strong>39142</strong></small> 
                           	    	<br/><small>Fecha de inscripción: <strong>13/12/2019</strong></small> 
                           	    	<br/><small>Número de Resolución del Pleno: <strong>P/IFT/210819/392</strong></small> 
                           	    	<br/><small>Donatario: <strong>GUNA CAA YUNI XHIÑA, A.C.</strong></small> 
                           	    	<br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A GUNA CAA YUNI XHIÑA, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHGCY-FM, EN JUCHITÁN DE ZARAGOZA, EN EL ESTADO DE OAXACA</strong></small>
                           	    	<br/><a href="<?php echo URLASSETSDONACIONES.'39142_200310221426_9259.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                           	    	</div></li>  	
                                
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>39141</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>13/12/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/180919/455</strong></small> 
                                 <br/><small>Donatario: <strong>VOZ DE TRANSFORMACIÓN, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A VOZ DE TRANSFORMACIÓN, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHCSBI-FM, EN CHILPANCINGO DE LOS BRAVO, EN EL ESTADO DE GUERRERO</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'39141_200310221414_1231.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li> 
                                 
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>39140</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>13/12/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/341</strong></small> 
                                 <br/><small>Donatario: <strong>LA MEXICANITA SAPICHU, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A LA MEXICANITA SAPICHU, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHMXS-FM, EN CHERATO, CHERATILLO, 18 DE MARZO Y SICUICHO, EN EL ESTADO DE MICHOACÁN</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'39140_200310221402_6864.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li>
                                 
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>39139</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>13/12/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/337</strong></small> 
                                 <br/><small>Donatario: <strong>KAHAL SEMBRADORES DE FUTURO, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A KAHAL SEMBRADORES DE FUTURO, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHSCBI-FM, EN VILLAHERMOSA, EN EL ESTADO DE TABASCO</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'39139_200310221343_5464.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li> 
                                 
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>37165</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>02/09/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/340</strong></small> 
                                 <br/><small>Donatario: <strong>VOZ DE TRANSFORMACIÓN, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A VOZ DE TRANSFORMACIÓN, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHCSAP-FM, EN LA PAZ, EN EL ESTADO DE BAJA CALIFORNIA SUR</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'37165_200310221329_8963.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li> 
                                 
                                 <li><div> 
                                <small>Folio de inscripción: <strong>37164</strong></small> 
                                <br/><small>Fecha de inscripción: <strong>02/09/2019</strong></small> 
                                <br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/339</strong></small> 
                                <br/><small>Donatario: <strong>VOZ DE TRANSFORMACIÓN, A.C.</strong></small> 
                                <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A  VOZ DE TRANSFORMACIÓN, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHCSAO-FM, EN SAN FELIPE, EN EL ESTADO DE BAJA CALIFORNIA</strong></small>
                                <br/><a href="<?php echo URLASSETSDONACIONES.'37164_200310221317_8969.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                </div></li>
                                
                                <li><div> 
                                	<small>Folio de inscripción: <strong>37161</strong></small> 
                                	<br/><small>Fecha de inscripción: <strong>02/09/2019</strong></small> 
                                	<br/><small>Número de Resolución del Pleno: <strong>P/IFT/050619/286</strong></small> 
                                	<br/><small>Donatario: <strong>LA VOZ DEL CANARIO, A.C.</strong></small> 
                                	<br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A LA VOZ DEL CANARIO, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHSCAZ-FM, EN TIQUICHEO, MICHOACÁN</strong></small>
                                	<br/><a href="<?php echo URLASSETSDONACIONES.'37161_200310221302_8645.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                	</div></li> 
                                	
                                	<li><div> 
                                	<small>Folio de inscripción: <strong>37151</strong></small> 
                                	<br/><small>Fecha de inscripción: <strong>30/08/2019</strong></small> 
                                	<br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/338</strong></small> 
                                	<br/><small>Donatario: <strong>ABRAZANDO A LOS PUEBLOS, JUXTLAHUACA, A.C.</strong></small> 
                                	<br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A ABRAZANDO A LOS PUEBLOS, JUXTLAHUACA, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHSCBX-FM, EN SANTIAGO JUXTLAHUACA, EN EL ESTADO DE  OAXACA</strong></small>
                                	<br/><a href="<?php echo URLASSETSDONACIONES.'37151_200310221246_6910.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a>
								</div></li>
								
								<li><div> 
								<small>Folio de inscripción: <strong>37150</strong></small> 
								<br/><small>Fecha de inscripción: <strong>30/08/2019</strong></small> 
								<br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/336</strong></small> 
								<br/><small>Donatario: <strong>ORGANIZACIÓN DE RADIOS COMUNITARIAS DE OCCIDENTE, A.C.</strong></small> 
								<br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A ORGANIZACIÓN DE RADIOS COMUNITARIAS DE OCCIDENTE, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHSCAT-FM, EN VILLA DE ÁLVAREZ, EN EL ESTADO DE COLIMA</strong></small>
								<br/><a href="<?php echo URLASSETSDONACIONES.'37150_200310221227_7833.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
								</div></li> 	 	
                                	  		
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>37149</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>30/08/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/335</strong></small> 
                                 <br/><small>Donatario: <strong>XIMAI COMUNICACIONES, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO  TRANSMISOR A XIMAI COMUNICACIONES, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE  LLAMADA XHSCBZ-FM, EN SANTIAGO DE ANAYA Y EL ÁGUILA EN EL ESTADO DE HIDALGO</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'37149_200310221213_1199.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li>
                                 
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>37148</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>30/08/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/030719/334</strong></small> 
                                 <br/><small>Donatario: <strong>RADIAL HUMANAMENTE POSITIVA, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A RADIAL HUMANAMENTE POSITIVA A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHSCCG-FM, EN CIUDAD NEZAHUALCÓYOTL EN EL ESTADO DE MÉXICO</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'37148_200310221154_4406.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li>
                                 
                                 <li><div> 
                                 <small>Folio de inscripción: <strong>37142</strong></small> 
                                 <br/><small>Fecha de inscripción: <strong>30/08/2019</strong></small> 
                                 <br/><small>Número de Resolución del Pleno: <strong>P/IFT/050619/285</strong></small> 
                                 <br/><small>Donatario: <strong>SOMOS UNO RADIO LA VOZ DE LA COMUNIDAD, A.C.</strong></small> 
                                 <br/><small>Resolución/Contrato :<strong>RESOLUCIÓN MEDIANTE LA CUAL EL PLENO DEL INSTITUTO FEDERAL DE TELECOMUNICACIONES AUTORIZA LA DONACIÓN DE UN EQUIPO TRANSMISOR A SOMOS UNO RADIO LA VOZ DE LA COMUNIDAD, A.C., EN RELACIÓN CON LA ESTACIÓN CON DISTINTIVO DE LLAMADA XHSOM-FM, EN TLACOLULA DE MATAMOROS, OAXACA</strong></small>
                                 <br/><a href="<?php echo URLASSETSDONACIONES.'37142_200310221032_1697.pdf'; ?>" target="_blank"><small><strong>Ver documento</strong></small></a> 
                                 </div></li>  
                                  		 	
                                
                            </ul>
                            </div>
                        </div>

                        
</div>
<!-- filter donacion de equipos -->