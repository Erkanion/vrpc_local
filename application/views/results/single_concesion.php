<?php

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
	
	$objClient = new SoapClient(URLSEARCHWS."?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true));
	
?>

<?php
	if ($idConcesion !== null) {
		$arrParameters_Search = array('baseId' => '', 'concesionId' => $idConcesion, 'folio' => '', 'includeRates' => false);
		$objConcesion =  $objClient->findExpedienteTst($arrParameters_Search);
		
		foreach ($objConcesion as $concesion) {
			//foreach($concesionR as $concesion) {
			
?>


<?php
    $tipoDeConcesion = substr($concesion->folio, 0, 3);
	$titExpediente = 'Expediente';
	
	$isRadio = false;
	$tipoFE = substr($concesion->folio, 0,3);
	if ($tipoFE=='FER') {
		$isRadio = false;
	}
	
	$notUpdated = FALSE;
	
	//$vigencia = getFieldValue($concesion,'vigencia','').' años';
	$vigencia = getFieldValue($concesion,'vigencia','');
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
	
	//if (isset($concesion->coberturas) AND count($concesion->coberturas)>=1) {
	if (isset($concesion->coberturas) && is_object($concesion->coberturas)) {
		$hasBandasDeFrecuencia = true;
	}
	
	//if (isset($concesion->informesaep) AND count($concesion->informesaep)>=1) {
	if (isset($concesion->informesaep) && is_object($concesion->informesaep)) {
		$hasSanciones = true;
	}
	
	$hasConvenios = $concesion->hasConvenios;
	
	if (isset($concesion->coberturasEstructuradas)) {
		$hasCoberturas = true;
	}
	
	if (isset($concesion->serviciosAuxiliares)) {
		$hasServiciosAutorizados = true;
	}
	
	//if (isset($concesion->satelites) AND count($concesion->satelites)>=1 ) {
	if (isset($concesion->satelites) && is_object($concesion->satelites)) {
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
		//if (count($concesion->serviceAliasExp)==1) {
		if (isset($concesion->serviceAliasExp) && is_object($concesion->serviceAliasExp)) {
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
	
	/*
	$fechaDeVencimiento = getFieldValue($concesion,'fechaVencimiento','');
	$fechaDeinicioDeVigencia = getFieldValue($concesion,'fechaInstalacion','');
	$fechaDeProrroga = getFieldValue($concesion,'fechaRegistro','');
	$fechaDeRegistro = getFieldValue($concesion,'fechaRegistro','');
	$fechaDeOtorgamiento = getFieldValue($concesion,'fechaOtorgamiento','');
	*/
	
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
					//$vigencia = getFieldValue($concesion,'vigencia','').' años';
					$vigencia = getFieldValue($concesion,'vigencia','');
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
?>


<!-- record info -->
<div class="container margin_60">
	<div class="row">
				<div class="col-md-3">
					<h3>&nbsp;</h3>
				</div>
	</div>
	<div class="row">
		<div class="col-md-8" id="single_tour_desc">
        
			<div id="single_tour_feat">
				<ul>
					<li><a href="#"><i class="icon_set_1_icon-53"></i>General</a></li>
					
<?php
	if ($hasConvenios) {
		echo "<li><a href='#' onclick='goToConveniosSection();'><i class='icon_set_1_icon-68'></i>Convenios</a></li>";
	}
	//if ($hasSanciones) {
		echo "<li><a href='#' onclick='goToSancionesSection();'><i class='icon_set_1_icon-66'></i>Sanciones y supervisión</a></li>";
	//}
?>	
				<li><a href="#" onclick="closeFancyBox(event);"><i class="icon_set_1_icon-77"></i>Cerrar</a></li>
				</ul>
			</div>
<?php
	//var_dump($concesion);
?>
            
			<div class="row">
				<div class="col-md-3">
					<h3>Información general</h3>
				</div>
				<div class="col-md-9">
					<h4>Folio electrónico</h4>
					<p>
						<?php echo getFieldValue($concesion,'folio',''); ?>
					</p>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<h4>Materia</h4>
							<p>
								<?php echo getFieldValue($concesion,'tipo',''); ?>
							</p>
						</div>
						<div class="col-md-6 col-sm-6">
							<h4>Estatus</h4>
							<p>
<?php 
				$vEstado = getFieldValue($concesion,'estadoConcesion','');
				if (isset($vEstado) && $vEstado!==null && $vEstado=='EXTINTO') {
					echo 'EXTINGUIDO POR CONSOLIDACIÓN';
				} else {
					echo getFieldValue($concesion,'estadoConcesion','');
				} 
?>
							</p>
						</div>
					</div><!-- End row  -->
					<h4>Nombre del concesionario</h4>
					<p>
						<?php echo getFieldValue($concesion,'concesionarioName',''); ?>
					</p>
<?php
	$nombreComercial = getFieldValue($concesion,'nombreComercial','');
	if ($nombreComercial !== null AND $nombreComercial !== '') {
?>					
					<h4>Nombre comercial</h4>
					<p>
						<?php echo $nombreComercial; ?>
					</p>
<?php
	}
?>					
					<h4>Tipo de inscripción</h4>
					<p>
						<?php echo getFieldValue($concesion,'tipoInscripcion',''); ?>
					</p>

					
					<h4><?php echo $titExpediente ?></h4>
					<p>
						<?php echo getFieldValue($concesion,'distintivoLlamada',''); ?>
					</p>


<!-- servicios autorizados -->					
<?php
	if ($hasServiciosAutorizados) {
		$serviciosAutorizados=$concesion->serviciosAuxiliares;
		//var_dump($serviciosAutorizados);
?>
	<h4>Servicios autorizados</h4>
					<div class="row">
						<div class="col-md-12">
							<table class="table table_summary">
								<thead>
									<tr>
										<th>Anexo</th>
										<th>Fecha</th>
										<th>Descripción</th>
									</tr>
								</thead>								
								<tbody>
									
<?php
		//if (count($serviciosAutorizados)==1) {
		if (isset($serviciosAutorizados) && is_object($serviciosAutorizados)) {
?>
									<tr>
										<td style="width: 20%;"><?php echo getFieldValue($serviciosAutorizados,'nom_anexo','');?></td>
										<td style="width: 20%;"><?php echo getFieldValue($serviciosAutorizados,'fecha_anexo_str','');?></td>
										<td><?php echo getFieldValue($serviciosAutorizados,'descripcion','');?></td>
									</tr>
<?php			
		} else {
			foreach($serviciosAutorizados as $servicioAutorizado) {
				//var_dump($servicioAutorizado);
?>
									<tr>
										<td style="width: 20%;"><?php echo getFieldValue($servicioAutorizado,'nom_anexo','');?></td>
										<td style="width: 20%;"><?php echo getFieldValue($servicioAutorizado,'fecha_anexo_str','');?></td>
										<td><?php echo getFieldValue($servicioAutorizado,'descripcion','');?></td>
									</tr>
<?php
			}
		}
?>									
								</tbody>
							</table>
						</div>
					</div><!-- End row  -->
<?php		
	} else {
		if ($tipoDeConcesion == 'FER') {
?>
		<h4>Servicios autorizados</h4>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<ul class="list_ok">
								<li>RADIODIFUSIÓN</li>
							</ul>
						</div>
					</div><!-- End row  -->
<?php	
		}	
	}
?>			
<!-- servicios autorizados -->		
					
<!-- cobertura -->					
					
<?php
	if ($hasCoberturas) {
		$coberturasEstructuradas=$concesion->coberturasEstructuradas;
		//var_dump($coberturasEstructuradas);
?>
		<h4>Cobertura</h4>
					<div class="row">
						<div class="col-md-12">
							<table id="tblCoberturas" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Estado</th>
										<th>Municipio</th>
										<th>Población</th>
									</tr>
								</thead>								
								<tbody>
									
<?php
		//if (count($coberturasEstructuradas)==1) {
		if (isset($coberturasEstructuradas) && is_object($coberturasEstructuradas)) {
?>
									<tr>
										<td style="width: 10%;"><?php echo getFieldValue($coberturasEstructuradas,'tipo2','');?></td>
										<td style="width: 25%;"><?php echo getFieldValue($coberturasEstructuradas,'estado','');?></td>
										<td style="width: 25%;"><?php echo getFieldValue($coberturasEstructuradas,'municipio','');?></td>
										<td style="width: 40%;"><?php echo getFieldValue($coberturasEstructuradas,'poblacion','');?></td>
									</tr>
<?php			
		} else {
			foreach($coberturasEstructuradas as $coberturaEstructurada) {
				//var_dump($servicioAutorizado);
?>
									<tr>
										<td ><?php echo getFieldValue($coberturaEstructurada,'tipo2','');?></td>
										<td ><?php echo getFieldValue($coberturaEstructurada,'estado','');?></td>
										<td ><?php echo getFieldValue($coberturaEstructurada,'municipio','');?></td>
										<td ><?php echo getFieldValue($coberturaEstructurada,'poblacion','');?></td>
									</tr>
<?php
			}
		}
?>									
								</tbody>
							</table>
						</div>
					</div><!-- End row  -->
<script>
	$('#tblCoberturas').DataTable( {
        "scrollX": true,
        "scrollY":        '50vh',
        "scrollCollapse": true,
        language: {
		        	    search: 'Buscar:',
		        	    zeroRecords: 'No existen coincidencias',
		        	    infoFiltered: '(filtrado sobre _MAX_ registros)',
		            emptyTable: 'Sin datos',
		            info: 'Mostrando _START_ a _END_ de _TOTAL_ registross',
		            infoEmpty: 'Mostrando 0 registros',
		            lengthMenu: 'Mostrar _MENU_ ',
		            paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
        			}
    } );	
</script>					
<?php		
	} 
?>
<!-- cobertura -->

<!-- bandas TV Principal -->
<?php
 if ($hasPrincipalRyTV) {
 	$bandasTV = $concesion->principalRyTV;
	 $hasMultiprogramacion = FALSE;
 	//if (count($bandasTV)==1) {
 	if (isset($bandasTV) && is_object($bandasTV)) {
 		$bandasTV = array($concesion->principalRyTV);
 	}
	
	foreach ($bandasTV as $bandaTV) {
		$hasMultiprogramacion = $bandaTV->hasMulti;
	}
	
?>
	<h4>Frecuencia principal</h4>
		<div class="row">
			<div class="col-md-12">
				<table id="tblTvFrecuenciaPrincipal" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Distintivo</th>
							<th>Banda</th>
							<th>Canal</th>
							<th>Frecuencia</th>							
							<th>Canal de programación</th>
							<th>Canal virtual</th>
							<th>Población</th>
							<th>Municipio</th>
							<th>Estado</th>
<?php
		if ($hasMultiprogramacion==TRUE) {
?>
							<th>Canal virtual</th>
							<th>Calidad de video (HDTV o SDTV)</th>
							<th>Formato compresión</th>
							<th>Tasa de transferencia (Mbps)</th>
							<th>Canal de programación</th>
							<th>Tipo de acceso</th>
							<th>Acceso a</th>
							<th>Resolución</th>
<?php			
		} 
?>							
						</tr>
					</thead>								
					<tbody>
<?php		
        $lastBanda = '';
		foreach ($bandasTV as $bandaTV) {
			$newBanda = getFieldValue($bandaTV,'distintivoAdicional','').getFieldValue($bandaTV,'bandaAdicional','').getFieldValue($bandaTV,'canalAdicional','');
			$newBanda = $newBanda.getFieldValue($bandaTV,'frecuenciaAdicional','').getFieldValue($bandaTV,'canalProgramacion','');
			$newBanda = $newBanda.getFieldValue($bandaTV,'poblacion','').getFieldValue($bandaTV,'municipio','').getFieldValue($bandaTV,'estado','');
			if ($newBanda !== $lastBanda) {
?>
						<tr>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'distintivoAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'bandaAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'canalAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'frecuenciaAdicional','');?></td>							
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'canalProgramacion','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'canalVirtual','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'poblacion','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'municipio','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'estado','');?></td>
						
<?php
			} else {
?>
				<tr>
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>							
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>
							<td style="width: 10%;">&nbsp;</td>

<?php				
			}
			$lastBanda = $newBanda;
			
			if ($hasMultiprogramacion==TRUE) {
?>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'canalMulti','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'calidadVideo','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'formatoCompresion','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'tasaTransferencia','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'identidadCanal','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'tipoPrestador','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'acesoA','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'resolucion','');?></td>
<?php				
			}
?>
					</tr>
<?php			
		}
?>						
					</tbody>
				</table>
			</div>
		</div><!-- End row  -->
		
<script>
	$('#tblTvFrecuenciaPrincipal').DataTable( {
        "scrollX": true,
        "bSort": true,
        language: {
		        	    search: 'Buscar:',
		        	    zeroRecords: 'No existen coincidencias',
		        	    infoFiltered: '(filtrado sobre _MAX_ registros)',
		            emptyTable: 'Sin datos',
		            info: 'Mostrando _START_ a _END_ de _TOTAL_ registross',
		            infoEmpty: 'Mostrando 0 registros',
		            lengthMenu: 'Mostrar _MENU_ ',
		            paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
        			}
    } );	
</script>		
<?php
 }
?>
<!-- bandas TV Principal -->

<!-- bandas TV Adicional -->
<?php
 if ($hasAdicionalRyTV) {
 	$bandasTV = $concesion->adicionalRyTV;
 	//if (count($bandasTV)==1) {
 	if (isset($bandasTV) && is_object($bandasTV)) {
 		$bandasTV = array($concesion->adicionalRyTV);
 	}
?>
	<h4>Frecuencia adicional</h4>
		<div class="row">
			<div class="col-md-12">
				<table id="tblTvFrecuenciaAdicional" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Distintivo</th>
							<th>Banda</th>
							<th>Canal</th>
							<th>Frecuencia</th>
							<th>Población</th>
							<th>Municipio</th>
							<th>Estado</th>
						</tr>
					</thead>								
					<tbody>
<?php		
		foreach ($bandasTV as $bandaTV) {
?>
						<tr>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'distintivoAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'bandaAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'canalAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'frecuenciaAdicional','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'poblacion','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'municipio','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaTV,'estado','');?></td>
						</tr>
<?php
		}
?>						
					</tbody>
				</table>
			</div>
		</div><!-- End row  -->
<script>
	$('#tblTvFrecuenciaAdicional').DataTable();
</script>		
<?php
 }
?>
<!-- bandas TV Adicional -->


<!-- bandas de frecuencia -->
<?php
 if ($hasBandasDeFrecuencia) {
 	$bandasFrecuencia = $concesion->coberturas;
 	//if (count($bandasFrecuencia)==1) {
 	if (isset($bandasFrecuencia) && is_object($bandasFrecuencia)) {
 		$bandasFrecuencia = array($concesion->coberturas);
 	}
?>
	<h4>Bandas de frecuencia</h4>
		<div class="row">
			<div class="col-md-12">
				<table id="tblBandasFrecuencia" class="table table-striped table-bordered">
<?php
		$secondSection = false;
		foreach ($bandasFrecuencia as $bandaFrecuencia) {
			//if (isset($bandaFrecuencia->cob_abs) AND $bandaFrecuencia->cob_abs!==null AND trim($bandaFrecuencia->cob_abs)!=='' ) {
			if ( (isset($bandaFrecuencia->cob_bloque) AND $bandaFrecuencia->cob_bloque!==null AND trim($bandaFrecuencia->cob_bloque)!=='') 
			OR (isset($bandaFrecuencia->cob_grupo) AND $bandaFrecuencia->cob_grupo!==null AND trim($bandaFrecuencia->cob_grupo)!=='')  
			OR (isset($bandaFrecuencia->cob_abs) AND $bandaFrecuencia->cob_abs!==null AND trim($bandaFrecuencia->cob_abs)!=='') ) {
				$secondSection = true;
			}
		}
		if ($secondSection) {
?>
					<thead>
						<tr>
							<th>#</th>
							<th>Abs</th>
							<th>Cobertura</th>
							<th>Estado</th>
							<th>Bloque</th>
							<th>Grupo</th>
							<th>Serie</th>
							<th>RX</th>
							<th>TX</th>
						</tr>
					</thead>								
					<tbody>
<?php
			$iBanda = 1;
			foreach ($bandasFrecuencia as $bandaFrecuencia) {
?>
						<tr>
							<td style="width: 10%;"><?php echo $iBanda;?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_abs','');?></td>
							<td ><?php echo getFieldValue($bandaFrecuencia,'cob_desccobertura','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_estado','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_bloque','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_grupo','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_serie','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_rx','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_tx','');?></td>
						</tr>
<?php				
			}
		} else {
?>					
					<thead>
						<tr>
							<th>#</th>
							<th>Segmento inferior/ida(MHz)</th>
							<th>Segmento superior/retorno(MHz)</th>
							<th>Ancho de banda (MHz)</th>
						</tr>
					</thead>								
					<tbody>
<?php		
        	$iBanda = 1;
			foreach ($bandasFrecuencia as $bandaFrecuencia) {
?>
						<tr>
							<td style="width: 10%;"><?php echo $iBanda;?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_ida','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_retorno','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($bandaFrecuencia,'cob_anchobanda','');?></td>
						</tr>
<?php
				$iBanda=$iBanda+1;
			}
		}
?>						
					</tbody>
				</table>
			</div>
		</div><!-- End row  -->
<script>
	$('#tblBandasFrecuencia').DataTable();
</script>		
<?php 	
 }
?>


<!-- sistema satelital -->


<?php
 if ($hasSatelites) {
 	$satelitesArray = $concesion->satelites;
 	//if (count($satelitesArray)==1) {
 	if (isset($satelitesArray) && is_object($satelitesArray)) {
 		$satelitesArray = array($concesion->satelites);
 	}
?>
	<h4>Sistema satelital</h4>
		<div class="row">
			<div class="col-md-12">
				<table id="tblSatelital" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Sistema satelital</th>
							<th>Posición orbital</th>
							<th>Banda de frecuencia</th>
						</tr>
					</thead>								
					<tbody>
<?php		
		$iCount = 1;
		foreach ($satelitesArray as $satelite) {
			
?>
						<tr>
							<td style="width: 10%;"><?php echo $iCount; ?></td>
							<td style="width: 10%;"><?php echo getFieldValue($satelite,'sat_nombresatelite','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($satelite,'sat_posicionorbital','');?></td>
							<td style="width: 10%;"><?php echo getFieldValue($satelite,'sat_bandafrecuencia','');?></td>
						</tr>
<?php
			$iCount++;
		}
?>						
					</tbody>
				</table>
			</div>
		</div><!-- End row  -->
		
<script>
	$('#tblSatelital').DataTable( {
        "scrollX": true,
        language: {
		        	    search: 'Buscar:',
		        	    zeroRecords: 'No existen coincidencias',
		        	    infoFiltered: '(filtrado sobre _MAX_ registros)',
		            emptyTable: 'Sin datos',
		            info: 'Mostrando _START_ a _END_ de _TOTAL_ registross',
		            infoEmpty: 'Mostrando 0 registros',
		            lengthMenu: 'Mostrar _MENU_ ',
		            paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
        			}
    } );	
</script>		
<?php 	
 }
?>

<!-- sistema satelital -->

<!-- bandas de frecuencia -->



					
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<h4>Antecedente registral</h4>
							<p>
								<?php echo getFieldValue($concesion,'tituloConcesion',''); ?>
							</p>
						</div>
						<div class="col-md-6 col-sm-6">
							<h4>Fecha de registro de antecedente registral</h4>
							<p>
								<?php echo $fechaDeRegistroAntecedente; ?>
							</p>
						</div>
					</div><!-- End row  -->
					
					
					
				</div>
			</div>
            
			<hr>

<!-- convenios -->
<?php
	if ($hasConvenios && isset($concesion->convenios)) {
		$convenios = $concesion->convenios;
?>
	<script>
		var dataSetConveniosList=[]; 
		var iCList = 0;
		var dataConvenios = {};
		var dataConveniosList = [];
<?php
		//error_log('[DEV ] $convenios-->size'.count($convenios));
		//if (count($convenios)==1) {
		if (isset($convenios) && is_object($convenios)) {			
 			$conveniosTmp = array($convenios);
			$convenios = $conveniosTmp;
 		}
		foreach($convenios as $convenio) {
			$fldL01 = json_encode(getFieldValue($convenio, 'folioConvenio'));
			$fldL02 = json_encode(getFieldValue($convenio, 'folioInscripcion'));
			$fldL03 = json_encode(getFieldValue($convenio, 'cTipo'));
			$fldL04 = json_encode(getFieldValue($convenio, 'descripcion'));
			$fldL05 = json_encode(getFieldValue($convenio, 'fechaCelebracion'));
			
			
			if (isset($convenio->fetsSource)){
				//if (count($convenio->fetsSource)==1) {
				if (isset($convenio->fetsSource) && is_object($convenio->fetsSource)) {			
 					$conveniosTmp = array($convenio->fetsSource);
					$convenio->fetsSource = $conveniosTmp;
 				}
			} else {
				//$convenio->fetsSource=[];
			}
			
			if (isset($convenio->fetsTarget)){
				//if (count($convenio->fetsTarget)==1) {
				if (isset($convenio->fetsTarget) && is_object($convenio->fetsTarget)) {			
 					$conveniosTmp = array($convenio->fetsTarget);
					$convenio->fetsTarget = $conveniosTmp;
 				}
			} else {
				//$convenio->fetsTarget=[];
			}
			
			//$fldFetSource = json_encode($convenio->fetsSource);
			//$fldFetTarget = json_encode($convenio->fetsTarget);
			
			$fldFetSource = json_encode(isset($convenio->fetsSource)?$convenio->fetsSource:[]);
			$fldFetTarget = json_encode(isset($convenio->fetsTarget)?$convenio->fetsTarget:[]);
			
			
			/*
			*/
			
			if (isset($convenio->documents)) {
				$fldFetDocument = json_encode($convenio->documents);
			} else {
				$fldFetDocument = '"nulo"';
			}
?>

		var convenioRecord = {};
		convenioRecord["fldL01"] = <?php echo $fldL01;?>;
		convenioRecord["fldL02"] = <?php echo $fldL02;?>;
		convenioRecord["fldL03"] = <?php echo $fldL03;?>;
		convenioRecord["fldL04"] = <?php echo $fldL04;?>;
		convenioRecord["fldL05"] = <?php echo $fldL05;?>;
		convenioRecord["fldFetSource"] = <?php echo $fldFetSource;?>;
		convenioRecord["fldFetTarget"] = <?php echo $fldFetTarget;?>;
		convenioRecord["fldFetDocument"] = <?php echo $fldFetDocument;?>;
		dataConveniosList.push(convenioRecord);
<?php
		}
?>      
		dataConvenios["data"] = dataConveniosList;    
	</script>  
<style>
	td.details-control {
    background: url('<?php echo URLAPPPUBLISHVRPC;?>assets/img/details_open.png') no-repeat left center;
    cursor: pointer;
    padding-left: 30px;
	}
	tr.shown td.details-control {
	    background: url('<?php echo URLAPPPUBLISHVRPC;?>assets/img/details_close.png') no-repeat left center;
	    padding-left: 30px;
	}
</style>	
			<div class="row" id="conveniosSection" name="conveniosSection">
				<div class="col-md-3">
					<h3>Convenios</h3>
				</div>
				<div class="col-md-9">
					
<!-- bootstrap table -->


	<table id="tblConvenios" class="display table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th></th>
                <th>Expediente</th>
                <th>Folio de Inscripción</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Fecha de celebración</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Expediente</th>
                <th>Folio de Inscripción</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Fecha de celebración</th>
            </tr>
        </tfoot>
    </table>

<script>
	/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    var sFirstTable = "";
    
    
    sFirstTable += '<table cellpadding="5" cellspacing="5" border="0" style="padding-left:50px;">';
    
    sFirstTable += '<tbody>';
    sFirstTable += '<tr><td><a target="_blank" href="<?php echo URLAPPPUBLISHVRPC;?>upload/files/convenios/'+d.fldFetDocument.docUrl+'" ><i class=" icon-doc"></i>Ver documento del convenio</a></td></tr>';
    
    console.log(d.fldFetDocument);
    sFirstTable += '</tbody>';
    sFirstTable += '</table>';
    
    sFirstTable += '<table class="table table-striped">';
    sFirstTable += '<thead><tr><th colspan="2">Operadores 1</th></tr></thead>';
    sFirstTable += '<tbody>';
    for (var i=0; i < d.fldFetSource.length; i++){
    	vSource = d.fldFetSource[i];
    	if (vSource.fet===undefined) {
    		vSource.fet='';
    	}
    	sFirstTable += '<tr><td>'+vSource.fet+'</td><td>'+vSource.concesionario+'</td></tr>';
    }
    sFirstTable += '</tbody>';
    sFirstTable += '</table>';
    
    sFirstTable += '<table class="table table-striped">';
    sFirstTable += '<thead><tr><th colspan="2">Operadores 2</th></tr></thead>';
    sFirstTable += '<tbody>';
    for (var i=0; i < d.fldFetTarget.length; i++){
    	vSource = d.fldFetTarget[i];
    	if (vSource.fet===undefined) {
    		vSource.fet='';
    	}
    	sFirstTable += '<tr><td>'+vSource.fet+'</td><td>'+vSource.concesionario+'</td></tr>';
    }
    sFirstTable += '</tbody>';
    sFirstTable += '</table>';
    
    return sFirstTable;
}
 
$(document).ready(function() {
	//console.log( dataConveniosList );
    var table = $('#tblConvenios').DataTable( {
        "data": dataConveniosList,
        "columns": [
            {                
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "fldL01", "className":      'details-control' },
            { "data": "fldL02" },
            { "data": "fldL03" },
            { "data": "fldL04" },
            { "data": "fldL05" }
        ],
        "order": [[1, 'asc']],
        language: {
		        	    search: 'Buscar:',
		        	    zeroRecords: 'No existen coincidencias',
		        	    infoFiltered: '(filtrado sobre _MAX_ registros)',
		            emptyTable: 'Sin datos',
		            info: 'Mostrando _START_ a _END_ de _TOTAL_ registross',
		            infoEmpty: 'Mostrando 0 registros',
		            lengthMenu: 'Mostrar _MENU_ ',
		            paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
        			}
    } );
     
    // Add event listener for opening and closing details
    $('#tblConvenios tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    
} );
</script>
        
<!-- bootstrap table -->
				</div>
			</div>
<?php
	}
?>			
<!-- convenios -->			
			
            
			<hr>

<!-- sanciones -->  
<?php
	if ($hasSanciones) { 
?>          
			<div class="row"  id="sancionesSection" name="sancionesSection">
				<div class="col-md-3">
					<h3>Sanciones y supervisión </h3>
				</div>
				<div class="col-md-9">
                    <hr>
<?php
		$sanciones = $concesion->informesaep;
		//if (count($sanciones)==1){
		if (isset($sanciones) && is_object($sanciones)) {
			$tmpArray = $sanciones;
			$sanciones = array($tmpArray);
		}
		foreach($sanciones as $sancion) {
?>
					<div class="review_strip_single">
						<small><?php echo getFieldValue($sancion,'periodo','');?></small>
						<h4><?php echo getFieldValue($sancion,'aep','');?></h4>
						<h5>Folio de inscripción: <?php echo getFieldValue($sancion,'id_inscripcion','');?></h5>
						<p>
							 Acto: <?php echo getFieldValue($sancion,'tipo_informe','');?> 
						</p>
						<div class="rating">
							<a href="<?php echo URLAPPPUBLISHVRPC;?>/pdfs/informes/<?php echo getFieldValue($sancion,'document','');?>" target="_blank">Ver documento</a>
						</div>
					</div><!-- End review strip -->
<?php			
		}
?>                    
					
                    
				</div>
			</div>
<?php
	} else {
?>
			<div class="row"  id="sancionesSection" name="sancionesSection">
				<div class="col-md-3">
					<h3>Sanciones y supervisión </h3>
				</div>
				<div class="col-md-9">
					<hr>
					<h4>No se encuentran sanciones registradas </h4>
				</div>	
			</div>
<?php		
	}
?>			
<!-- sanciones -->			
			
		</div><!--End  single_tour_desc-->
        
		<aside class="col-md-4">

		
		<div class="box_style_1 expose">
			<h3 class="inner">- Vigencia -</h3>
			<table class="table table_summary">
			<tbody>
		    <tr class="total">
				<td colspan="2">
					<?php echo $sarcNumeroVigencia; ?> años
				</td>
			</tr>
			<tr>
				<td>
					Fecha de vencimiento
				</td>
				<td class="text-right">
					<?php echo $sarcFechaVencimiento; ?>
				</td>
			</tr>
			<tr>
				<td>
					Fecha de inicio de vigencia
				</td>
				<td class="text-right">
					<?php echo $sarcInicioVigencia; ?>
				</td>
			</tr>
			<tr>
				<td>
					Fecha de prórroga
				</td>
				<td class="text-right">
					<?php echo $sarcFechaProrroga; ?>
				</td>
			</tr>
			<tr>
				<td>
					Fecha de otorgamiento
				</td>
				<td class="text-right">
					<?php echo $fechaDeOtorgamiento; ?>
				</td>
			</tr>
			</tbody>
			</table>
		</div><!--/box_style_1 -->
		
		<div class="box_style_1 expose">
			<h3 class="inner">- Documentos -</h3>
			<table class="table table_summary">
			<tbody>
<?php
    if (!$isRadio) {
	$documentos = isset($concesion->caratula->zp09->documents)?$concesion->caratula->zp09->documents:null;
	if ( isset($documentos) AND $documentos!==null AND is_array($documentos) ) {
	foreach ($documentos as $document) { //foreach
		$docCategoria = getFieldValue($document,'docCategoria');
		if ($docCategoria!=='') {
?>
	<tr class="total">
				<td>
					<?php echo $docCategoria;?>
				</td>
			</tr>
<?php			
		} else {
?>
			<tr>
				<td>
					<i class=" icon-doc"></i><a href="<?php echo URLAPPPUBLISHVRPC;?>pdfs/<?php echo getFieldValue($document,'docname'); ?>" target="_blank"><?php echo getFieldValue($document,'docTitle'); ?></a>					
				</td>
			</tr>
<?php			
		}
		} //foreach
	} //if
	}
?>				
			
			
			</tbody>
			</table>
			<!--
			<a class="btn_full" href="cart.html">Book now</a>
			<a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Add to whislist</a>
			-->
		</div><!--/box_style_1 -->

<!--        
		<div class="box_style_4">
			<i class="icon_set_1_icon-90"></i>
			<h4><span>Book</span> by phone</h4>
			<a href="tel://004542344599" class="phone">+45 423 445 99</a>
			<small>Monday to Friday 9.00am - 7.30pm</small>
		</div>
-->
        
		</aside>
	</div><!--End row -->
</div><!--End container -->
<!-- record info -->

<?php
			//} /* end foreach sub */			
		} /* end foreach */
	} /* end idConcesion null */
 
?>