<?php
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
    return trim($section->$field);
}

   function checkStringEmpty($cadena) {
   	if($cadena!==null && trim($cadena)!=="" ) {
   		return trim($cadena);
   	} else {
   		return "-";
   	}
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
   
    //$objClient = new SoapClient("http://rpc.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true));
	//$objClient = new SoapClient("http://10.34.144.82:7010/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true));
	
	//$objClient = new SoapClient("http://172.17.42.113:9001/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true));
	$objClient = new SoapClient("http://172.17.41.204:9001/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true));
	
	$this->load->view('includes_rpc');
	
	if ($idConcesion !== null) {
		$arrParameters_Search = array('baseId' => '', 'concesionId' => $idConcesion, 'folio' => '', 'includeRates' => false);
		$objConcesion =  $objClient->findExpediente($arrParameters_Search);
		
		if ($objConcesion!==null && is_object($objConcesion)) {
			$tmpArray = $objConcesion;
			$objConcesion = array($tmpArray);
		}
		foreach ($objConcesion as $concesion) {
			if (isset($concesion) && isset($concesion->folio)) {
				$tipoDeConcesion = substr($concesion->folio, 0, 3);
				$titExpediente = 'Expediente';
				
				$isRadio = false;
				$tipoFE = substr($concesion->folio, 0,3);
				if ($tipoFE=='FER') {
					$isRadio = false;
				}
				
				$notUpdated = FALSE;
				
				$vigencia = getFieldValue($concesion,'vigencia','').' años';
				$fechaDeVencimiento = getFieldValue($concesion,'fechaVencimiento','');
				$fechaDeinicioDeVigencia = getFieldValue($concesion,'fechaInstalacion','');
				$fechaDeProrroga = getFieldValue($concesion,'fechaRegistro','');
				$fechaDeOtorgamiento = getFieldValue($concesion,'fechaOtorgamiento','');
				$fechaDeRegistro = getFieldValue($concesion,'fechaRegistro','');
				
				$sarcFechaProrroga = getFieldValue($concesion,'sarcFechaProrroga','');
				$sarcNumeroVigencia = getFieldValue($concesion,'sarcNumeroVigencia','');
				$sarcInicioVigencia = getFieldValue($concesion,'sarcInicioVigencia','');
				$sarcFechaVencimiento = getFieldValue($concesion,'sarcFechaVencimiento','');
				
				if ( !isset($sarcInicioVigencia) || $sarcInicioVigencia==null ) {
					$notUpdated=TRUE;
				}
				
				$fechaDeRegistroAntecedente = getFieldValue($concesion,'fechaDictamen','');
				
				$banda = getFieldValue($concesion,'banda','');
				$comercializadora  = getFieldValue($concesion,'comercializadora','');
				$concesionUnica = getFieldValue($concesion,'concesionUnica','');
				$tipoRegistro = getFieldValue($concesion,'tipoRegistro','');
				
				$isBanda = false;
				$isComercializadora = false;
				$isEstacionesTerrenas = false; 
				$hasPrincipalRyTV = false;
				$hasAdicionalRyTV = false;
				$gridRadioHeader = 'FRECUENCIA (MHz)';
				$gridRadioLbl = 'FRECUENCIA PRINCIPAL';
				$gridRadioAdicionalLbl = 'FRECUENCIA ADICIONAL';
				
				$hasCoberturas = false;
				$hasServiciosAuxiliares = false;
				$hasServiciosAutorizados = false;
				
				$hasConvenios = false;
				$hasSanciones = false;
				
				$hasSatelites = false;
				
				$hasBandasDeFrecuencia = false;
				
				/* business rules */
				
				if (isset($concesion->coberturas) AND count_Arr($concesion->coberturas)>=1) {
					$hasBandasDeFrecuencia = true;
				}
				
				if (isset($concesion->informesaep) AND count_Arr($concesion->informesaep)>=1) {
					$hasSanciones = true;
				}
				
				$hasConvenios = $concesion->hasConvenios;
				
				if (isset($concesion->coberturasEstructuradas)) {
					$hasCoberturas = true;
				}
				
				if (isset($concesion->serviciosAuxiliares)) {
					$hasServiciosAutorizados = true;
				}
				
				if (isset($concesion->satelites) AND count_Arr($concesion->satelites)>=1 ) {
					$hasSatelites = true;
				}
				
				if ($banda !== null AND $banda!=='' AND $concesionUnica=='N') {
					$isBanda = true;
					if ($banda == 'AM') {
						$gridRadioHeader = 'FRECUENCIA (kHz)';
					}
					if ($tipoRegistro=='PE' AND ($banda=='AM' OR $banda='FM')) {
						$gridRadioAdicionalLbl = 'CAMBIO DE FRECUENCIA (DE AM A FM)';
					}
					if (isset($concesion->principalRyTV)) {
						$hasPrincipalRyTV = true;
					}
					if (isset($concesion->adicionalRyTV)) {
						$hasAdicionalRyTV = true;
					}
					$hasServiciosAutorizados = false;
					$fechaDeOtorgamiento = '';
					$fechaDeProrroga = '';
					$hasCoberturas = false;
				}
				
				if ($banda !== null AND $banda!=='' AND $concesionUnica=='X') {
					$fechaDeOtorgamiento = '';
					$fechaDeProrroga = '';
				}
				
				
				if (isset($concesion->serviciosAuxiliares)) {
					$hasServiciosAuxiliares = true;
				}
				
				if ($comercializadora !== null AND $comercializadora=='SI') {
					$isComercializadora = true;
				}
				
				/* Checar tema de estaciones terrenas */
				if (isset($concesion->serviceAliasExp) AND $concesion->serviceAliasExp !== null) {
					if (count_Arr($concesion->serviceAliasExp)==1) {
						$descripcionAE = $concesion->serviceAliasExp->descripcion;
						if ($descripcionAE!==null AND $descripcionAE=='ESTACIONES TERRENAS') {
							$isEstacionesTerrenas = true;
						}
					} else {
						foreach ($concesion->serviceAliasExp as $serviceA) {
							$descripcionAE = $serviceA->descripcion;
							if ($descripcionAE!==null AND $descripcionAE=='ESTACIONES TERRENAS') {
								$isEstacionesTerrenas = true;
							}
						}
					}
				}
				
				if ($tipoRegistro=='PE') {
					if ($isComercializadora) {
						if ($fechaDeRegistro==null OR $fechaDeRegistro=='') {
							$fechaDeProrroga = '';
							$fechaDeinicioDeVigencia = '';
						} else {
							$fechaDeProrroga = getFieldValue($concesion,'fechaRegistro','');
							$fechaDeinicioDeVigencia = getFieldValue($concesion,'fechaInstalacion','');
						}
					}
					if ($isEstacionesTerrenas) {
						$fechaDeRegistro = getFieldValue($concesion,'fechaDictamen','');
						$vigencia = 'Indefinida';
						$fechaDeVencimiento = 'indefinida';
						$fechaDeProrroga = '';
						$fechaDeinicioDeVigencia = '';
					}
					if ($isBanda) {
						if ($fechaDeRegistro!==null AND $fechaDeRegistro!=='') {
							$fechaDeinicioDeVigencia = getFieldValue($concesion,'fechaRegistro','');
							$fechaDeVencimiento = getFieldValue($concesion,'fechaVencimiento','');
						} else {
							$fechaDeinicioDeVigencia = getFieldValue($concesion,'fechaOtorgamiento','');
							$fechaDeVencimiento = getFieldValue($concesion,'fechaVencimiento','');
							if ($fechaDeVencimiento==null OR $fechaDeVencimiento=='') {
								$fechaDeVencimiento = 'indefinida';
								$vigencia = 'Indefinida';
							} else {
								$vigencia = getFieldValue($concesion,'vigencia','').' años';
							}
						}
						$fechaDeProrroga = '';
						$fechaDeOtorgamiento='';
					}
				}
			    
				if ($notUpdated) {
					$sarcFechaProrroga = $fechaDeProrroga;
					$sarcNumeroVigencia = $vigencia;
					$sarcInicioVigencia = $fechaDeinicioDeVigencia;
					$sarcFechaVencimiento = $fechaDeVencimiento;
				}
				
				if ($isEstacionesTerrenas) {
					$hasCoberturas = false;
				}
				
				if ($tipoDeConcesion == 'FER') {
					$titExpediente = 'Distintivo';
				}
				
			}
		}
	}
	
?>

<div class="container margin_60">
	<div class="row">
		<div class="col-md-8" id="single_tour_desc">
        
			<div id="single_tour_feat">
				<ul>
					<li><i class="icon_set_1_icon-4"></i>Museum</li>
					<li><i class="icon_set_1_icon-83"></i>3 Hours</li>
					<li><i class="icon_set_1_icon-13"></i>Accessibiliy</li>
					<li><i class="icon_set_1_icon-82"></i>144 Likes</li>
					<li><i class="icon_set_1_icon-22"></i>Pet allowed</li>
					<li><i class="icon_set_1_icon-97"></i>Audio guide</li>
					<li><i class="icon_set_1_icon-29"></i>Tour guide</li>
				</ul>
			</div>
            
            <p class="visible-sm visible-xs"><a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a></p><!-- Map button for tablets/mobiles -->
            
			<div class="row">
				<div class="col-md-3">
					<h3>Description</h3>
				</div>
				<div class="col-md-9">
					<h4>Paris in love</h4>
					<p>
						Lorem ipsum dolor sit amet, at omnes deseruisse pri. Quo aeterno legimus insolens ad. Sit cu detraxit constituam, an mel iudico constituto efficiendi. Eu ponderum mediocrem has, vitae adolescens in pro. Mea liber ridens inermis ei, mei legendos vulputate an, labitur tibique te qui.
					</p>
					<h4>What's include</h4>
					<p>
						Lorem ipsum dolor sit amet, at omnes deseruisse pri. Quo aeterno legimus insolens ad. Sit cu detraxit constituam, an mel iudico constituto efficiendi.
					</p>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<ul class="list_ok">
								<li>Lorem ipsum dolor sit amet</li>
								<li>No scripta electram necessitatibus sit</li>
								<li>Quidam percipitur instructior an eum</li>
								<li>Ut est saepe munere ceteros</li>
								<li>No scripta electram necessitatibus sit</li>
								<li>Quidam percipitur instructior an eum</li>
							</ul>
						</div>
						<div class="col-md-6 col-sm-6">
							<ul class="list_ok">
								<li>Lorem ipsum dolor sit amet</li>
								<li>No scripta electram necessitatibus sit</li>
								<li>Quidam percipitur instructior an eum</li>
								<li>No scripta electram necessitatibus sit</li>
							</ul>
						</div>
					</div><!-- End row  -->
				</div>
			</div>
            
			<hr>
            
			<div class="row">
				<div class="col-md-3">
					<h3>Schedule</h3>
				</div>
				<div class="col-md-9">
					<div class=" table-responsive">
						<table class="table table-striped">
						<thead>
						<tr>
							<th colspan="2">
								 1st March to 31st October
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								Monday
							</td>
							<td>
								10.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Tuesday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Wednesday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Thursday
							</td>
							<td>
								<span class="label label-danger">Closed</span>
							</td>
						</tr>
						<tr>
							<td>
								Friday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Saturday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Sunday
							</td>
							<td>
								10.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								<strong><em>Last Admission</em></strong>
							</td>
							<td>
								<strong>17.00</strong>
							</td>
						</tr>
						</tbody>
						</table>
					</div>
					<div class=" table-responsive">
						<table class="table table-striped">
						<thead>
						<tr>
							<th colspan="2">
								 1st November to 28th February
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								Monday
							</td>
							<td>
								10.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Tuesday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Wednesday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Thursday
							</td>
							<td>
								<span class="label label-danger">Closed</span>
							</td>
						</tr>
						<tr>
							<td>
								Friday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Saturday
							</td>
							<td>
								09.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								Sunday
							</td>
							<td>
								10.00 - 17.30
							</td>
						</tr>
						<tr>
							<td>
								<strong><em>Last Admission</em></strong>
							</td>
							<td>
								<strong>17.00</strong>
							</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
            
			<hr>
            
			<div class="row">
				<div class="col-md-3">
					<h3>Reviews </h3>
                    <a href="#" class="btn_1 add_bottom_30" data-toggle="modal" data-target="#myReview">Leave a review</a>
				</div>
				<div class="col-md-9">
                	<div id="general_rating">11 Reviews 
                    <div class="rating">
							<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
						</div>
                    </div><!-- End general_rating -->
                    <div class="row" id="rating_summary">
                    	<div class="col-md-6">
                        	<ul>
                            	<li>Position
                                    <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
                                    </div>
                                </li>
                                <li>Tourist guide
                                <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                        	<ul>
                            	<li>Price
                                <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
                                    </div>
                                </li>
                                <li>Quality
                                <div class="rating">
                                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End row -->
                    <hr>
					<div class="review_strip_single">
						<img src="<?php echo URLASSETS?>img/avatar1.jpg" alt="" class="img-circle">
						<small> - 10 March 2015 -</small>
						<h4>Jhon Doe</h4>
						<p>
							 "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus."
						</p>
						<div class="rating">
							<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
						</div>
					</div><!-- End review strip -->
                    
					<div class="review_strip_single">
						<img src="<?php echo URLASSETS?>img/avatar3.jpg" alt="" class="img-circle">
						<small> - 10 March 2015 -</small>
						<h4>Jhon Doe</h4>
						<p>
							 "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus."
						</p>
						<div class="rating">
							<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
						</div>
					</div><!-- End review strip -->
                    
					<div class="review_strip_single last">
						<img src="<?php echo URLASSETS?>img/avatar2.jpg" alt="" class="img-circle">
						<small> - 10 March 2015 -</small>
						<h4>Jhon Doe</h4>
						<p>
							 "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a lorem quis neque interdum consequat ut sed sem. Duis quis tempor nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus."
						</p>
						<div class="rating">
							<i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><i class="icon-smile"></i>
						</div>
					</div><!-- End review strip -->
				</div>
			</div>
		</div><!--End  single_tour_desc-->
        
		<aside class="col-md-4">
		<p class="hidden-sm hidden-xs">
			<a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap">View on map</a>
		</p>
		<div class="box_style_1 expose">
			<h3 class="inner">- Booking -</h3>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label><i class="icon-calendar-7"></i> Select a date</label>
						<input class="date-pick form-control" data-date-format="M d, D" type="text">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label><i class=" icon-clock"></i> Time</label>
						<input class="time-pick form-control" value="12:00 AM" type="text">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Adults</label>
						<div class="numbers-row">
							<input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Children</label>
						<div class="numbers-row">
							<input type="text" value="0" id="children" class="qty2 form-control" name="quantity">
						</div>
					</div>
				</div>
			</div>
			<br>
			<table class="table table_summary">
			<tbody>
			<tr>
				<td>
					Adults
				</td>
				<td class="text-right">
					2
				</td>
			</tr>
			<tr>
				<td>
					Children
				</td>
				<td class="text-right">
					0
				</td>
			</tr>
			<tr>
				<td>
					Total amount
				</td>
				<td class="text-right">
					3x $52
				</td>
			</tr>
			<tr class="total">
				<td>
					Total cost
				</td>
				<td class="text-right">
					$154
				</td>
			</tr>
			</tbody>
			</table>
			<a class="btn_full" href="cart.html">Book now</a>
			<a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Add to whislist</a>
		</div><!--/box_style_1 -->
        
		<div class="box_style_4">
			<i class="icon_set_1_icon-90"></i>
			<h4><span>Book</span> by phone</h4>
			<a href="tel://004542344599" class="phone">+45 423 445 99</a>
			<small>Monday to Friday 9.00am - 7.30pm</small>
		</div>
        
		</aside>
	</div><!--End row -->
</div><!--End container -->
