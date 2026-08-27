<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RpcSearchController extends CI_Controller {

	private $objClient = null;
	
	private function writeLog($message) {
		$logPath = APPPATH . 'logs/log.txt';
		error_log($message . PHP_EOL, 3, $logPath);
	}

    function __construct() {
        parent::__construct();
        //$this->load->model('searchdb', '', TRUE);        
        //$this->objClient = new SoapClient("http://10.34.144.82:7010/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>10));
		//$this->objClient = new SoapClient("http://rpc.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
		//$this->objClient = new SoapClient("http://ucsws.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
		
		$this->objClient = new SoapClient(URLSEARCHWS."?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
		
    }

    public function index() {

        $this->writeLog('[DEV ] call RpcSearchController-->');

    }
	
	function getFieldValue($section, $field, $defaultValue = '') {
	    if (!isset($section)) {
	        if ($defaultValue == 'TODAY') {
	            return date('d/m/Y');
	        } else {
	            return $defaultValue;
	        }
	    }
	    if (!isset($section->$field)) {
	        if ($defaultValue == 'TODAY') {
	            return date('d/m/Y');
	        } else {
	            return $defaultValue;
	        }
	    }
	    return $section->$field;
	}

/* search concesiones */
	public function searchConcesiones() {
		
		
		$arrParameters_Search = array('searchParams' => array(
			'txtBPConcesionario' => trim($this->input->post('txtBPConcesionario')),
            'strConcesionario' => trim($this->input->post('strConcesionario')),
			'strServicios' => json_decode($this->input->post('strServicios')),
			'strFET' => trim($this->input->post('strFET')),
			'strCobertura' => json_decode(trim($this->input->post('strCobertura'))),
			'strEstatus' => trim($this->input->post('strEstatus')),
			'strExpediente' => trim($this->input->post('strExpediente')),
			'strCanal' => trim($this->input->post('strCanal')),
			'strTipo' => trim($this->input->post('strTipo')),
			'strTipoUso' => trim($this->input->post('strTipoUso')),
			'strSatelite' => json_decode($this->input->post('strSatelite')),
			'strPosicion' =>json_decode( $this->input->post('strPosicion')),
			'strRangoSegmentosFrom' =>json_decode( $this->input->post('strRangoSegmentosFrom')),
			'strRangoSegmentosTo' =>json_decode( $this->input->post('strRangoSegmentosTo')),
			'strFrecuencia' => trim($this->input->post('strFrecuencia')),
			'comercializadora' => trim($this->input->post('cbComercializadoraChecked')),
			'omv' => trim($this->input->post('cbOMVChecked')),
        ) );
		
		//var_dump(json_decode($this->input->post('strServicios')));
		
		//$concesionesList = $this->searchdb->searchConcesiones($dataInput);
		$concesionesList = null;
		try {
		   $concesionesList =  $this->objClient->vRpcConcesionesSearch($arrParameters_Search);
		   $this->writeLog('[DEV ] RPC->searchConcesiones-->requestPayload: ' . json_encode($arrParameters_Search));
		   $this->writeLog('[DEV ] RPC->searchConcesiones-->soapRequest: ' . $this->objClient->__getLastRequest());
		   $this->writeLog('[DEV ] RPC->searchConcesiones-->response: ' . print_r($concesionesList, true));
        } catch (Exception $e) {
	        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
			$this->writeLog('[DEV ] RPC->searchConcesiones-->soapRequestError: ' . $this->objClient->__getLastRequest());
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $concesionesList-->' . count($concesionesList)  );
		
		foreach ($concesionesList as $concesiones) {
			$resultTmp = $concesiones;
		}
		$concesionesList = $resultTmp;
		
		//if (count($concesionesList)==1) {
		if ($concesionesList!==null && is_object($concesionesList)) {
			$tmpArray = $concesionesList;
			$concesionesList = array($tmpArray);
		}
		
		$concesionesListFinal=null;
		if ($concesionesList!==null) {
			$documentsList = null;
			$concesionesListFinal = array();
			foreach($concesionesList as $record) {
				$concesionRecord = new stdClass();
				
				$concesionRecord->NOMBRE_COMERCIAL = $this->getFieldValue($record, 'nombre_comercial');
				$concesionRecord->ID_CONCESION = $this->getFieldValue($record, 'id_concesion');
				$concesionRecord->C_FOLIO_ELECTRONICO = $this->getFieldValue($record, 'c_folio_electronico');
				$concesionRecord->CONCESIONARIO_NAME = $this->getFieldValue($record, 'concesionario_name');
				$concesionRecord->TIPO_INSCRIPCION = $this->getFieldValue($record, 'tipo_inscripcion');
				$concesionRecord->ESTADO_CONCESION = $this->getFieldValue($record, 'estado_concesion');
				$concesionRecord->TIPO_REGISTRO = $this->getFieldValue($record, 'tipo_registro');
				$concesionRecord->TIPO = $this->getFieldValue($record, 'tipo');
				$concesionRecord->C_VIGENCIA_CONCESION = $this->getFieldValue($record, 'c_vigencia_concesion');
				$concesionRecord->FVENCIMIENTO = $this->getFieldValue($record, 'fvencimiento');
				$concesionRecord->FINIVIGENCIA = $this->getFieldValue($record, 'finivigencia');
				$concesionRecord->FOTORGAMIENTO = $this->getFieldValue($record, 'fotorgamiento');
				$concesionRecord->FPRORROGA = $this->getFieldValue($record, 'fprorroga');
				$concesionRecord->COMERCIALIZADORA = $this->getFieldValue($record, 'comercializadora');
				$concesionRecord->UNICA = $this->getFieldValue($record, 'unica');
				
				$concesionRecord->SARCFECHAPRORROGA = $this->getFieldValue($record, 'sarcFechaProrroga');
				$concesionRecord->SARCNUMEROVIGENCIA = $this->getFieldValue($record, 'sarcNumeroVigencia');
				$concesionRecord->SARCINICIOVIGENCIA = $this->getFieldValue($record, 'sarcInicioVigencia');
				$concesionRecord->SARCFECHAVENCIMIENTO = $this->getFieldValue($record, 'sarcFechaVencimiento');
				$concesionRecord->FECHA_INICIO_PRORROGA = $this->getFieldValue($record, 'fechaInicioProrroga');
				$concesionRecord->FECHA_FIN_PRORROGA = $this->getFieldValue($record, 'fechaFinProrroga');
				$concesionRecord->ENTRA_PRORROGA = $this->getFieldValue($record, 'entraProrroga');
				
				if (!isset($concesionRecord->SARCINICIOVIGENCIA) || $concesionRecord->SARCINICIOVIGENCIA==null || $concesionRecord->SARCINICIOVIGENCIA=='' ) {
					$concesionRecord->SARCFECHAPRORROGA = $concesionRecord->FPRORROGA;
					$concesionRecord->SARCNUMEROVIGENCIA = $concesionRecord->C_VIGENCIA_CONCESION;
					$concesionRecord->SARCINICIOVIGENCIA = $concesionRecord->FINIVIGENCIA;
					$concesionRecord->SARCFECHAVENCIMIENTO = $concesionRecord->FVENCIMIENTO;
				}
				
				//if (isset($record->documents) AND count($record->documents)==1) {
				if (isset($record->documents) &&  is_object($record->documents)) {
					$tmpArray = $record->documents;
					$record->documents = array($tmpArray);
				}				
				$concesionRecord->DOCUMENTS = $this->getFieldValue($record, 'documents');
				
				//if (isset($record->cobertura) AND count($record->cobertura)==1) {
				if (isset($record->cobertura) &&  is_object($record->cobertura)) {
					$tmpArray = $record->cobertura;
					$record->cobertura = array($tmpArray);
				}
				$concesionRecord->COBERTURA = $this->getFieldValue($record, 'cobertura');
				
				//if (isset($record->servicios) AND count($record->servicios)==1) {
				if (isset($record->servicios) &&  is_object($record->servicios)) {
					$tmpArray = $record->servicios;
					$record->servicios = array($tmpArray);
				}
				$concesionRecord->SERVICIOS = $this->getFieldValue($record, 'servicios');
				
				/*
				 
				$concesionRecord->NOMBRE_COMERCIAL = $record->NOMBRE_COMERCIAL;
				$concesionRecord->ID_CONCESION = $record->ID_CONCESION;
				$concesionRecord->C_FOLIO_ELECTRONICO = $record->C_FOLIO_ELECTRONICO;
				$concesionRecord->CONCESIONARIO_NAME = $record->CONCESIONARIO_NAME;
				$concesionRecord->NOMBRE_COMERCIAL = $record->NOMBRE_COMERCIAL;
				$concesionRecord->TIPO_INSCRIPCION = $record->TIPO_INSCRIPCION;
				$concesionRecord->ESTADO_CONCESION = $record->ESTADO_CONCESION;
				$concesionRecord->TIPO_REGISTRO = $record->TIPO_REGISTRO;
				$concesionRecord->TIPO = $record->TIPO;
				$concesionRecord->C_VIGENCIA_CONCESION = $record->C_VIGENCIA_CONCESION;
				$concesionRecord->FVENCIMIENTO = $record->FVENCIMIENTO;
				$concesionRecord->FINIVIGENCIA = $record->FINIVIGENCIA;
				$concesionRecord->FOTORGAMIENTO = $record->FOTORGAMIENTO;
				$concesionRecord->FPRORROGA = $record->FPRORROGA;
				$concesionRecord->COMERCIALIZADORA = $record->COMERCIALIZADORA;
				$concesionRecord->UNICA = $record->UNICA; 
				
				$concesionRecord->DOCUMENTS = $this->searchdb->searchDocuments($record->ID_CONCESION);
				$concesionRecord->COBERTURA = $this->searchdb->searchCobertura($record->ID_CONCESION);
				$concesionRecord->SERVICIOS = $this->searchdb->searchServiciosAsociados($record->ID_CONCESION);
				*/
				
				array_push($concesionesListFinal, $concesionRecord);
			}
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		//$data['concesionesResults'] = $concesionesList;
		$data['concesionesResults'] = $concesionesListFinal;
        $this->load->view('results/concesiones_results', $data);
		
        //$result = $this->catalogsdb->getBpFets($dataInput);
		//return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
	}
/* search concesiones */


    public function viewConcesionDetail() {
    		
		$idConcesion = trim($this->input->post('idConcesion'));
		
		/*
		$infoGeneral = $this->searchdb->viewConcesionDetail($idConcesion);		
		$documents = $this->searchdb->searchDocuments($idConcesion);
		$this->searchdb->searchCobertura($idConcesion);
		$this->searchdb->searchServiciosAsociados($idConcesion);			
    	$data['infoGeneral'] = $infoGeneral;
		$data['documents'] = $documents;
		*/
		
		$data['idConcesion'] = $idConcesion;
		
    	$this->load->view('results/single_concesion', $data);
	}
    
	
	/* Buscador de Documentos */
	public function searchBuscador() {
		$idTipoTramiteInput = trim($this->input->post('idTipoTramite'));
		$strFolio = trim($this->input->post('strFolio'));
		
		$arrParameters = array(
			'FilterSearchCCP' => array(
				'folio' => $strFolio
			)
		);
		
		$results = array();
		try {
			$responseObj = $this->objClient->getFiltroFolioModulo($arrParameters);
			$this->writeLog('[DEV ] RPC->searchBuscador (getFiltroFolioModulo)-->requestPayload: ' . json_encode($arrParameters));
			
			$response = null;
			if (isset($responseObj->return)) {
				$response = $responseObj->return;
			}
			
			if ($response !== null) {
				if (is_object($response)) {
					$response = array($response);
				}
				
				// 1. Collect results according to business priority:
				// - CANCELACION first, then CONSTANCIA.
				// - Fallback to the first available if neither is specifically named.
				$itemsToProcess = array();
				
				foreach ($response as $item) {
					if (isset($item->idTipoDocumento) && strtoupper($item->idTipoDocumento) === 'CANCELACION') {
						$itemsToProcess[] = $item;
						break;
					}
				}
				
				foreach ($response as $item) {
					if (isset($item->idTipoDocumento) && strtoupper($item->idTipoDocumento) === 'CONSTANCIA') {
						$itemsToProcess[] = $item;
						break;
					}
				}
				
				if (empty($itemsToProcess)) {
					foreach ($response as $item) {
						if (isset($item->nombreLogico) && !empty($item->nombreLogico)) {
							$itemsToProcess[] = $item;
							break;
						}
					}
				}
				
				foreach ($itemsToProcess as $selectedItem) {
					if (isset($selectedItem->nombreLogico) && !empty($selectedItem->nombreLogico)) {
						$idTipoTramite = 0;
						if (!empty($idTipoTramiteInput)) {
							$idTipoTramite = (int)$idTipoTramiteInput;
						}
						
						$tipoDoc = isset($selectedItem->idTipoDocumento) ? $selectedItem->idTipoDocumento : '';

						// If the transaction type was specified in the search filter, use it.
						// We only verify/fix the file extension if necessary.
						$tramiteConfigs = getTramiteConfigs();
						if ($idTipoTramite !== 0 && isset($tramiteConfigs[$idTipoTramite])) {
							$fileToCheck = $selectedItem->nombreLogico;
							if (substr(strtolower($fileToCheck), -4) !== '.pdf') {
								$url = getTramiteDocumentUrl($idTipoTramite, $fileToCheck . '.pdf', true, $tipoDoc);
								if ($url !== '') {
									$ch = curl_init($url);
									curl_setopt($ch, CURLOPT_NOBODY, true);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
									curl_exec($ch);
									$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
									curl_close($ch);
									if ($code == 200) {
										$selectedItem->nombreLogico = $fileToCheck . '.pdf';
									}
								}
							}
						}
						
						// If the transaction type was NOT specified, perform HTTP cURL HEAD checks 
						// across candidate folders to locate the file and determine its idTipoTramite.
						if ($idTipoTramite === 0) {
							foreach ($tramiteConfigs as $tid => $config) {
								$fileToCheck = $selectedItem->nombreLogico;
								$candidates = array($fileToCheck);
								if (substr(strtolower($fileToCheck), -4) !== '.pdf') {
									$candidates[] = $fileToCheck . '.pdf';
								}
								
								foreach ($candidates as $cand) {
									$url = getTramiteDocumentUrl($tid, $cand, true, $tipoDoc);
									if ($url !== '') {
										$ch = curl_init($url);
										curl_setopt($ch, CURLOPT_NOBODY, true);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
										curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
										curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
										curl_exec($ch);
										$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
										curl_close($ch);
										if ($code == 200) {
											$idTipoTramite = $tid;
											$selectedItem->nombreLogico = $cand;
											break 2;
										}
									}
								}
							}
						}
						
						// Translate option id to option label (nombre_tramite)
						$tramiteLabels = array(
							1  => 'Registro de Contrato de adhesión',
							2  => 'Registro de Nombre comercial',
							3  => 'Registro de Tarifas de servicios y espacios de publicidad',
							5  => 'Registro de Aviso de domicilio para notificaciones y centros de atención',
							8  => 'Registro de Puntos de interconexión',
							12 => 'Registro de Estructura accionaria o de partes sociales o aportaciones',
							13 => 'Registro de Formalización de enajenación de acciones',
							14 => 'Registro de Convenio/contrato celebrado entre concesionarios',
							15 => 'Registro de Gravamen impuesto a las concesiones',
							16 => 'Registro de Aviso de inicio o terminación de prestación de servicios de telecomunicaciones y/o de ampliación o reducción de áreas geoestadísticas',
							17 => 'Registro de Convenio de interconexión internacional',
							18 => 'Registro de Contrato de arrendamiento de espectro radioeléctrico, sus modificaciones y terminación',
							19 => 'Registro de Formalización de transmisión de derechos de concesiones o autorizaciones',
							38 => 'Avisos en materia de integración de socios o asociados'
						);
						
						$nombreTramite = isset($tramiteLabels[$idTipoTramite]) ? $tramiteLabels[$idTipoTramite] : 'Trámite no especificado';
						if (isset($selectedItem->idTipoDocumento)) {
							$tipoDocStr = $selectedItem->idTipoDocumento;
							if (strtoupper(trim($tipoDocStr)) === 'CANCELACION') {
								$tipoDocStr = 'CANCELACIÓN';
							}
							$nombreTramite .= ' - ' . ucfirst(strtolower($tipoDocStr));
						}
						
						$obj = new stdClass();
						$obj->id_tipo_tramite = $idTipoTramite;
						$obj->nombre_tramite = $nombreTramite;
						$obj->folio_inscripcion = $strFolio;
						$obj->tipo_documento = $selectedItem->idTipoDocumento;	
						$obj->nombre_archivo = $selectedItem->nombreLogico;
						$obj->fecha_inscripcion = 'N/D';
						$obj->descripcion = 'Documento obtenido de la búsqueda de folio.';
						
						$results[] = $obj;
					}
				}
			}
		} catch (Exception $e) {
			$this->writeLog('[DEV ] RPC->searchBuscador (getFiltroFolioModulo) failed: ' . $e->getMessage());
			$results = array();
		}
		
		$data['buscadorResults'] = $results;
		$this->load->view('results/buscador_results', $data);
	}
	
	public function verDocumento() {
		$encoded = $this->input->get('file');
		if (!$encoded) {
			show_404();
		}
		
		$filePath = base64_decode($encoded);
		if (!$filePath || strpos($filePath, '..') !== false || strpos($filePath, '/') === false) {
			show_404();
		}
		
		$remoteUrl = URLAPPPUBLISHVRPC . 'upload/files/' . $filePath;
		//echo $remoteUrl;die();
		header('Content-Type: application/pdf');
		header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		
		if (function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $remoteUrl);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_exec($ch);
			curl_close($ch);
		} else {
			@readfile($remoteUrl);
		}
		exit;
	}
	
	/* Convenios */
	public function searchConvenios() {
		
		$dataInput = array('convenioSearchRequest' => array(
			'strTiposConvenios' =>json_decode( $this->input->post('strTiposConvenios')),
            'strDescConvenio' => trim($this->input->post('strDescConvenio')),
			'strConvFecIni' => trim($this->input->post('strConvFecIni')),
			'strConvFecFin' => trim($this->input->post('strConvFecFin')),
			'strConvFolio' => trim($this->input->post('strConvFolio')),
			'txtConvBpSource1' => trim($this->input->post('txtConvBpSource1')),
			'txtConvBpSource2' => trim($this->input->post('txtConvBpSource2'))
        ) );
		
		//$conveniosList = $this->searchdb->searchConvenios($dataInput);
		
		$conveniosList=null;
		
		try {
		   $conveniosList =  $this->objClient->vRpcConveniosSearch($dataInput);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$dataInput-->'.json_encode($dataInput));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $conveniosList-->' . count($conveniosList)  );
		
		if (isset($conveniosList) && (is_array($conveniosList) || is_object($conveniosList))) {
			foreach ($conveniosList as $convenios) {
				$resultTmp = $convenios;
			}
		}
		$conveniosList = $resultTmp;
		
		//if (count($conveniosList)==1) {
		if (isset($conveniosList) &&  is_object($conveniosList)) {
			$tmpArray = $conveniosList;
			$conveniosList = array($tmpArray);
		}
		
		//print_r($conveniosList);
		
		$conveniosListFinal=null;
		if ($conveniosList!==null) {
			$fetsList = null;
			$conveniosListFinal = array();
			
			$idLastInscripcion = '';
			
			$convenioRecord = null;
			$convenioFGClass = null;
			
			$convenioFG1Array = array();
			$convenioFG2Array = array();
			
			$almostOne = false;
			
			foreach($conveniosList as $record) {
				/*
				$idInscripcion = $record->ci_id_inscr;
				if ($idLastInscripcion!==$idInscripcion) {
					if ($idLastInscripcion!=='') {
						$convenioRecord->FETS_G1 = $convenioFG1Array;
						$convenioRecord->FETS_G2 = $convenioFG2Array;
						array_push($conveniosListFinal, $convenioRecord);
					}
					$convenioRecord = new stdClass();
					$convenioFG1Array = array();
					$convenioFG2Array = array();
				}
				*/
				
				$convenioRecord = new stdClass();
				$convenioRecord->CI_ID_INSCR = $this->getFieldValue($record, 'ci_id_inscr');
				$convenioRecord->EXPEDIENTE = $this->getFieldValue($record, 'expediente');
				$convenioRecord->FOLIO_INSCRIPCION = $this->getFieldValue($record, 'folio_inscripcion');
				$convenioRecord->DESCRIPCION = $this->getFieldValue($record, 'descripcion');
				$convenioRecord->DESCRIPCION_TIPO = $this->getFieldValue($record, 'descripcion_tipo');
				$convenioRecord->FECHA_CELEBRACION = $this->getFieldValue($record, 'fecha_celebracion');
				$convenioRecord->FECHA_TERMINO = $this->getFieldValue($record, 'fecha_termino');
				$convenioRecord->ESTATUS = $this->getFieldValue($record, 'estatus');
				$convenioRecord->CI_DESCRIPCION = $this->getFieldValue($record, 'ci_descripcion');
				$convenioRecord->CI_DOCTYPE = $this->getFieldValue($record, 'ci_doctype');
				$convenioRecord->CI_DOCTITLE = $this->getFieldValue($record, 'ci_doctitle');
				$convenioRecord->CI_DOCNAME = $this->getFieldValue($record, 'ci_docname');
				$convenioRecord->CI_TIPO_INSCRIPCION = $this->getFieldValue($record, 'tipo_inscripcion');
				$convenioRecord->LISTDOC = $this->getFieldValue($record, 'listDoc');



				$resultTmp = $this->getFieldValue($record, 'foliosOp1');
				//if (count($resultTmp)==1) {
				if (isset($resultTmp) &&  is_object($resultTmp)) {
					$tmpArray = $resultTmp;
					$resultTmp = array($tmpArray);
				}
				$convenioRecord->FETS_G1 = $resultTmp;
				
				$resultTmp = $this->getFieldValue($record, 'foliosOp2');
				//print_r($resultTmp);
				//if (count($resultTmp)==1) {
				if (isset($resultTmp) &&  is_object($resultTmp)) {
					$tmpArray = $resultTmp;
					$resultTmp = array($tmpArray);
				}
				$convenioRecord->FETS_G2 = $resultTmp;
				array_push($conveniosListFinal, $convenioRecord);
				
				/*
				$gFTipo = $this->getFieldValue($record, 'ci_grupo');
				$convenioFGClass = new stdClass();
				$convenioFGClass->CI_FET=$this->getFieldValue($record, 'ci_fet');
				$convenioFGClass->CI_NOMBRE_CONCESIONARIO=$this->getFieldValue($record, 'ci_nombre_concesionario');
				$convenioFGClass->CI_GRUPO=$this->getFieldValue($record, 'ci_grupo');
				if ($gFTipo=='1') {
					array_push($convenioFG1Array, $convenioFGClass);
				}
				if ($gFTipo=='2') {
					array_push($convenioFG2Array, $convenioFGClass);
				}
				$idLastInscripcion = $idInscripcion;
				$almostOne=true;
				*/
			}
			/*
			if ($almostOne) {
				$convenioRecord->FETS_G1 = $convenioFG1Array;
				$convenioRecord->FETS_G2 = $convenioFG2Array;
				array_push($conveniosListFinal, $convenioRecord);
			}
			*/

		}



		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['conveniosResults'] = $conveniosListFinal;
        $this->load->view('results/convenios_results', $data);
	}
	
	
	
	/* Sanciones */
	public function searchSanciones() {
		$dataInput = array('searchSancionesParams' => array(
			'strDescSancion' => trim($this->input->post('strDescSancion')),
            'strBpSancion' => trim($this->input->post('strBpSancion')),
			'strSancionFecIni' => trim($this->input->post('strSancionFecIni')),
			'strSancionFecFin' => trim($this->input->post('strSancionFecFin')),
			'strSancionFolio' => trim($this->input->post('strSancionFolio')),
			'strTipoInforme' => trim($this->input->post('strTipoInforme'))
        ) );
		
		
		//$sancionesList = $this->searchdb->searchSanciones($dataInput);
		
		$sancionesList=null;
		
		try {
		   $sancionesList =  $this->objClient->vRpcSearchSanciones($dataInput);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$dataInput-->'.json_encode($dataInput));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $sancionesList-->' . count($sancionesList)  );
		
		foreach ($sancionesList as $sancion) {
			$resultTmp = $sancion;
		}
		$sancionesList = $resultTmp;
		
		//if (count($sancionesList)==1) {
		if (isset($sancionesList) &&  is_object($sancionesList)) {
			$tmpArray = $sancionesList;
			$sancionesList = array($tmpArray);
		}
		
		
		
		$sancionesListFinal=null;
		
		if ($sancionesList!==null) {
			$fetsList = null;
			$sancionesListFinal = array();
			
			foreach($sancionesList as $record) {
				
				/*print_r($record);*/
				
				$idInscripcion = $this->getFieldValue($record,'id_inscripcion');
				$sancionRecord = new stdClass();
				$sancionRecord->ID_INSCRIPCION = $this->getFieldValue($record,'id_inscripcion');
				$sancionRecord->ID_BP_AEP = $this->getFieldValue($record,'id_bp_aep');
				$sancionRecord->AEP = $this->getFieldValue($record,'aep');
				$sancionRecord->TIPO_INFORME = $this->getFieldValue($record,'tipo_informe');
				$sancionRecord->PERIODO = $this->getFieldValue($record,'periodo');
				$sancionRecord->DOCUMENT = $this->getFieldValue($record,'document');
				//$sancionRecord->FETS = $this->searchdb->searchSancionesFets($idInscripcion);
				array_push($sancionesListFinal, $sancionRecord);
			}
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		//$data['concesionesResults'] = $concesionesList;
		$data['sancionesResults'] = $sancionesListFinal;
        $this->load->view('results/sanciones_results', $data);
		
        //$result = $this->catalogsdb->getBpFets($dataInput);
		//return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
	}

/* search puntos interconexion */
	public function searchPuntosDeInterconexion() {
		$arrParameters_Search = array('searchPuntosParams' => array(
			'idBP' => trim($this->input->post('idBP')),
            'descripcion' => trim($this->input->post('descripcion')),
			'fechaInscripcion' => json_decode($this->input->post('fechaInscripcion')),
			'folioInscripcion' => trim($this->input->post('folioInscripcion'))
        ) );
		
		$puntosList = null;
		try {
		   $puntosList =  $this->objClient->vRpcSearchPuntosInterconexion($arrParameters_Search);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
				
		foreach ($puntosList as $puntos) {
			$resultTmp = $puntos;
		}
		$puntosList = $resultTmp;
		//error_log('[DEV ] $puntosList-->' . count($puntosList)  );
		//if (count($puntosList)==1) {
		if (isset($puntosList) &&  is_object($puntosList)) {
			$tmpArray = $puntosList;
			$puntosList = array($tmpArray);
		}
		
		$puntosListFinal=null;
		if ($puntosList!==null) {
			$documentsList = null;
			$puntosListFinal = array();
			foreach($puntosList as $record) {
				$puntosRecord = new stdClass();				
				$puntosRecord->id_puntosint = $this->getFieldValue($record, 'id_puntosint');
				$puntosRecord->folio_inscripcion = $this->getFieldValue($record, 'folio_inscripcion');
				$puntosRecord->concesionario = $this->getFieldValue($record, 'concesionario');
				$puntosRecord->servicios_interconexion = $this->getFieldValue($record, 'servicios_interconexion');
				$puntosRecord->observaciones = $this->getFieldValue($record, 'observaciones');
				$puntosRecord->periodo = $this->getFieldValue($record, 'periodo');
				$puntosRecord->fecha_inscripcion = $this->getFieldValue($record, 'fecha_inscripcion');
				$puntosRecord->fol_inscrip_ant = $this->getFieldValue($record, 'fol_inscrip_ant');
				
				$puntosRecord->listDoc = $this->getFieldValue($record, 'listDoc');
				
				//if (isset($record->fets) AND count($record->fets)==1) {
				if (isset($record->fets) &&  is_object($record->fets)) {
					$tmpArray = $record->fets;
					$record->fets = array($tmpArray);
				}
				$puntosRecord->fets = array();
				$recordFets = $this->getFieldValue($record, 'fets', array());
				if (is_object($recordFets)) {
					$recordFets = array($recordFets);
				}
				if (is_array($recordFets)) {
					foreach ($recordFets as $fetRecord) {
						if (!is_object($fetRecord)) {
							continue;
						}
						if ($this->getFieldValue($fetRecord, 'idConcesion') === '' && $this->getFieldValue($fetRecord, 'fet') === '') {
							continue;
						}
						$puntosRecord->fets[] = $fetRecord;
					}
				}
				array_push($puntosListFinal, $puntosRecord);
			}
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['puntosResults'] = $puntosListFinal;
        $this->load->view('results/puntos_interconexion_results', $data);
	}
/* search puntos interconexion */


/* permisos de radiocomunicacion */
public function searchPermisosRadiocomunicacion() {
		
		$arrParameters_Search = array('searchParams' => array(
			'txtBPConcesionario' => trim($this->input->post('txtBPConcesionario')),
            'strConcesionario' => trim($this->input->post('strConcesionario')),
			'strServicios' => json_decode($this->input->post('strServicios')),
			'strFET' => trim($this->input->post('strFET')),
			'strCobertura' => json_decode($this->input->post('strCobertura')),
			'strExpediente' => trim($this->input->post('strExpediente')),
			'strCanal' => trim($this->input->post('strRangoSegmentosFrom')),
			'strTipo' => trim($this->input->post('strRangoSegmentosTo'))
        ) );
		
		$concesionesList = null;
		try {
		   $concesionesList =  $this->objClient->vRpcPermisosSearch($arrParameters_Search);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $concesionesList-->' . count($concesionesList)  );
		
		foreach ($concesionesList as $concesiones) {
			$resultTmp = $concesiones;
		}
		$concesionesList = $resultTmp;
		
		//if (count($concesionesList)==1) {
		if (isset($concesionesList) &&  is_object($concesionesList)) {
			$tmpArray = $concesionesList;
			$concesionesList = array($tmpArray);
		}
		
		$concesionesListFinal=null;
		if ($concesionesList!==null) {
			$documentsList = null;
			$concesionesListFinal = array();
			foreach($concesionesList as $record) {
				$concesionRecord = new stdClass();
				
				$concesionRecord->ID_CONCESION = $this->getFieldValue($record, 'id_concesion');
				$concesionRecord->C_FOLIO_ELECTRONICO = $this->getFieldValue($record, 'c_folio_electronico');
				$concesionRecord->CONCESIONARIO_NAME = $this->getFieldValue($record, 'concesionario_name');
				$concesionRecord->NOMBRE_COMERCIAL = $this->getFieldValue($record, 'nombre_comercial');
				$concesionRecord->TIPO_INSCRIPCION = $this->getFieldValue($record, 'tipo_inscripcion');
				$concesionRecord->C_DISTINTIVO_LLAMADA = $this->getFieldValue($record, 'expediente');
				$concesionRecord->ESTADO_CONCESION = $this->getFieldValue($record, 'estado_concesion');
				$concesionRecord->SERVICIO_RADIOCOM = $this->getFieldValue($record, 'servicio');
				
				//if (isset($record->sitios) AND count($record->sitios)==1) {
				if (isset($record->sitios) &&  is_object($record->sitios)) {
					$tmpArray = $record->sitios;
					$record->sitios = array($tmpArray);
				}				
				$concesionRecord->SITIOS = $this->getFieldValue($record, 'sitios');
				array_push($concesionesListFinal, $concesionRecord);
			}
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['concesionesResults'] = $concesionesListFinal;
        $this->load->view('results/permisosradiocom_results', $data);
	}
/* permisos de radiocomunicacion */


/* contratos de adhesion */
public function searchContratosAdhesion() {
		
		$this->writeLog('[DEV ] searchContratosAdhesion-->' . $this->input->post('txtfechaProfeco') );
		//'fechaProfeco' => json_decode($this->input->post('txtfechaProfeco')),
		
		$arrParameters_Search = array('searchContratoAdhesion' => array(
			'idBP' => trim($this->input->post('txtidBP')),
            'concesionario' => trim($this->input->post('txtconcesionario')),
			'fechaProfeco' => trim($this->input->post('txtfechaProfeco')),
			'fechaIft' => trim($this->input->post('txtfechaIft')),
			'folioProfeco' => trim($this->input->post('txtfolioProfeco')),
			'folioRegistro' => trim($this->input->post('txtfolioRegistro')),
			'fet' => trim($this->input->post('txtfet')),
			'numInscripcionProfeco' => trim($this->input->post('txtnumInscripcionProfeco'))
        ) );
		
		$contratosAdhesionList = null;
		try {
		   $contratosAdhesionList =  $this->objClient->vRpcContratoAdhesionSearch($arrParameters_Search);
		   $this->writeLog('[DEV DEBUG] $contratosAdhesionList: ' . print_r($contratosAdhesionList, true));
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		if ($contratosAdhesionList !== null) {
			foreach ($contratosAdhesionList as $contrato) {
				$resultTmp = $contrato;
			}
		}
		$contratosAdhesionList = $resultTmp;
		
		//if (count($contratosAdhesionList)==1) {
		if (isset($contratosAdhesionList) &&  is_object($contratosAdhesionList)) {
			$tmpArray = $contratosAdhesionList;
			$contratosAdhesionList = array($tmpArray);
		}
		
		$contratosListFinal=null;
		if ($contratosAdhesionList!==null) {
			$documentsList = null;
			$contratosListFinal = array();
			
			foreach($contratosAdhesionList as $record) {
				$concesionRecord = new stdClass();
				
				$concesionRecord->CONCESIONARIO = $this->getFieldValue($record, 'concesionario');
				$concesionRecord->CONCESIONARIOOLD = $this->getFieldValue($record, 'concesionarioOld');
				$concesionRecord->COMERCIAL = $this->getFieldValue($record, 'comercial');
				$concesionRecord->IDGROUP = $this->getFieldValue($record, 'idGroup');
				
				// Normalizamos inscripciones a un array si es un objeto simple
				$inscripciones = null;
				if (isset($record->inscripciones)) {
					if (is_object($record->inscripciones)) {
						$inscripciones = array($record->inscripciones);
					} else if (is_array($record->inscripciones)) {
						$inscripciones = $record->inscripciones;
					}
				}
				
				// Buscamos el documento correspondiente en la última inscripción
				$selectedDoc = null;
				if (!empty($inscripciones)) {
					$lastInscripcion = end($inscripciones);
					if (isset($lastInscripcion->documentos)) {
						$docs = $lastInscripcion->documentos;
						// Normalizamos documentos a array de objetos si es un objeto simple
						if (is_object($docs)) {
							$docs = array($docs);
						}
						
						if (is_array($docs) && !empty($docs)) {
							$lenDocs = count($docs);
							if ($lenDocs >= 2) {
								$penultimoDoc = $docs[$lenDocs - 2];
								$ultimoDoc = $docs[$lenDocs - 1];
								
								$docTypePenultimo = isset($penultimoDoc->dctm_doctype) ? $penultimoDoc->dctm_doctype : (isset($penultimoDoc->dctmDoctype) ? $penultimoDoc->dctmDoctype : '');
								if (strtoupper(trim($docTypePenultimo)) === 'CANCELACION') {
									$selectedDoc = $penultimoDoc;
								} else {
									$selectedDoc = $ultimoDoc;
								}
							} else {
								$selectedDoc = $docs[0];
							}
						}
					}
				}
				
				if ($selectedDoc !== null) {
					$concesionRecord->URLCONTRATO = isset($selectedDoc->dctm_docname) ? $selectedDoc->dctm_docname : (isset($selectedDoc->dctmDocname) ? $selectedDoc->dctmDocname : $this->getFieldValue($record, 'urlContrato'));
					$concesionRecord->enlaceDoc = isset($selectedDoc->enlaceDoc) ? $selectedDoc->enlaceDoc : '';
				} else {
					$concesionRecord->URLCONTRATO = $this->getFieldValue($record, 'urlContrato');
					$concesionRecord->enlaceDoc = $this->getFieldValue($record, 'enlaceDoc');
				}
				
				$concesionRecord->STATUS = $this->getFieldValue($record, 'status');
				$concesionRecord->TIPO = $this->getFieldValue($record, 'tipo');
				$concesionRecord->SERVICIO = $this->getFieldValue($record, 'servicio');
				
				//if (isset($record->inscripciones) AND count($record->inscripciones)==1) {
				if (isset($record->inscripciones) &&  is_object($record->inscripciones)) {
					$tmpArray = $record->inscripciones;
					$record->inscripciones = array($tmpArray);
				}
				$concesionRecord->INSCRIPCIONES = $this->getFieldValue($record, 'inscripciones');
				
				//if (isset($record->inscripciones) AND isset($record->inscripciones->servicios) AND count($record->inscripciones->servicios)==1) {
				if (isset($record->inscripciones) &&  isset($record->inscripciones->servicios) && is_object($record->inscripciones->servicios)) {
						$tmpSArray = $record->inscripciones->servicios;
						$concesionRecord->INSCRIPCIONES->servicios = array($tmpSArray);
				}
								
				
				array_push($contratosListFinal, $concesionRecord);
			}
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['contratosadhesionResults'] = $contratosListFinal;
        $this->load->view('results/contratosadhesion_results', $data);
	}
/* contratos de adhesion */


/* espacios de publicidad */
public function searchEspaciosPublicidad() {
		
		$arrParameters_Search = array('searchEspacioPublicidad' => array(
			'idBP' => trim($this->input->post('txtidBP')),
            'concesionario' => trim($this->input->post('txtconcesionario')),
			'folioRegistro' => trim($this->input->post('txtfolioRegistro')),
			'fet' => trim($this->input->post('txtfet'))
        ) );
		
		$espaciosPublicidadList = null;
		try {
		   $espaciosPublicidadList =  $this->objClient->vRpcEspaciosSearch($arrParameters_Search);
		   $this->writeLog('[DEV DEBUG] $espaciosPublicidadList: ' . print_r($espaciosPublicidadList, true));
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $espaciosPublicidadList-->' . count($espaciosPublicidadList)  );
		
		foreach ($espaciosPublicidadList as $espacio) {
			$resultTmp = $espacio;
		}
		$espaciosPublicidadList = $resultTmp;
		
		//if (count($espaciosPublicidadList)==1) {
		if (isset($espaciosPublicidadList) && is_object($espaciosPublicidadList)) {
			$tmpArray = $espaciosPublicidadList;
			$espaciosPublicidadList = array($tmpArray);
		}
		
		$contratosListFinal=$espaciosPublicidadList;
		
		if ($contratosListFinal !== null && is_array($contratosListFinal)) {
			foreach ($contratosListFinal as $record) {
				// Normalizar listDoc a un array si es un objeto simple
				$listDoc = null;
				if (isset($record->listDoc)) {
					if (is_object($record->listDoc)) {
						$listDoc = array($record->listDoc);
					} else if (is_array($record->listDoc)) {
						$listDoc = $record->listDoc;
					}
				}
				
				// Buscamos el documento correspondiente aplicando la regla de cancelación
				$selectedDoc = null;
				if (!empty($listDoc)) {
					$lenDocs = count($listDoc);
					if ($lenDocs >= 2) {
						$penultimoDoc = $listDoc[$lenDocs - 2];
						$ultimoDoc = $listDoc[$lenDocs - 1];
						
						$docTypePenultimo = isset($penultimoDoc->tipoDocumento) ? $penultimoDoc->tipoDocumento : (isset($penultimoDoc->dctm_doctype) ? $penultimoDoc->dctm_doctype : (isset($penultimoDoc->dctmDoctype) ? $penultimoDoc->dctmDoctype : ''));
						if (strtoupper(trim($docTypePenultimo)) === 'CANCELACION' || strtoupper(trim($docTypePenultimo)) === 'CANCELADO') {
							$selectedDoc = $penultimoDoc;
						} else {
							$selectedDoc = $ultimoDoc;
						}
					} else {
						$selectedDoc = $listDoc[0];
					}
				}
				
				if ($selectedDoc !== null) {
					$docname = isset($selectedDoc->nombreDocumento) ? $selectedDoc->nombreDocumento : (isset($selectedDoc->dctm_docname) ? $selectedDoc->dctm_docname : (isset($selectedDoc->dctmDocname) ? $selectedDoc->dctmDocname : ''));
					$record->enlaceDoc = isset($selectedDoc->enlaceDoc) ? $selectedDoc->enlaceDoc : '';
					$record->urlTarifa = $docname;
				}
				
				// Si enlaceDoc termina en '/', le concatenamos el urlTarifa
				if (isset($record->enlaceDoc) && $record->enlaceDoc !== '' && substr($record->enlaceDoc, -1) === '/') {
					$record->enlaceDoc .= isset($record->urlTarifa) ? $record->urlTarifa : '';
				}
			}
		}
/*		
		if ($contratosAdhesionList!==null) {
			$documentsList = null;
			$contratosListFinal = array();
			foreach($contratosAdhesionList as $record) {
				$concesionRecord = new stdClass();
				
				$concesionRecord->CONCESIONARIO = $this->getFieldValue($record, 'concesionario');
				$concesionRecord->COMERCIAL = $this->getFieldValue($record, 'comercial');
				$concesionRecord->URLCONTRATO = $this->getFieldValue($record, 'urlContrato');
				$concesionRecord->IDGROUP = $this->getFieldValue($record, 'idGroup');
				
				if (isset($record->inscripciones) AND count($record->inscripciones)==1) {
					$tmpArray = $record->inscripciones;
					$record->inscripciones = array($tmpArray);
				}
				$concesionRecord->INSCRIPCIONES = $this->getFieldValue($record, 'inscripciones');
				
				if (isset($record->inscripciones) AND isset($record->inscripciones->servicios) AND count($record->inscripciones->servicios)==1) {
						$tmpSArray = $record->inscripciones->servicios;
						$concesionRecord->INSCRIPCIONES->servicios = array($tmpSArray);
				}
								
				
				array_push($contratosListFinal, $concesionRecord);
			}
		}
*/
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['espaciosPublicidadResults'] = $contratosListFinal;
        $this->load->view('results/espaciospublicidad_results', $data);
	}
/* espacios de publicidad */



/* estructura accionaria */
public function searchEstructuraAccionaria() {
		
		$arrParameters_Search = array('searchEstructuraAccionaria' => array(
			'idBP' => trim($this->input->post('txtidBP')),
            'concesionario' => trim($this->input->post('txtconcesionario')),
			'folioRegistro' => trim($this->input->post('txtfolioRegistro')),
			'fet' => trim($this->input->post('txtfet'))
        ) );
		
		$estructuraAccionariaList = null;
		try {
		   $estructuraAccionariaList =  $this->objClient->vRpcEstructuraSearch($arrParameters_Search);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $estructuraAccionariaList-->' . count($estructuraAccionariaList)  );
		
		foreach ($estructuraAccionariaList as $estructura) {
			$resultTmp = $estructura;
		}
		$estructuraAccionariaList = $resultTmp;
		
		//if (count($estructuraAccionariaList)==1) {
		if (isset($estructuraAccionariaList) && is_object($estructuraAccionariaList)) {
			$tmpArray = $estructuraAccionariaList;
			$estructuraAccionariaList = array($tmpArray);
		}
		
		if ($estructuraAccionariaList !== null && is_array($estructuraAccionariaList)) {
			foreach ($estructuraAccionariaList as $record) {
				// Normalizar listDoc a un array si es un objeto simple
				$listDoc = null;
				if (isset($record->listDoc)) {
					if (is_object($record->listDoc)) {
						$listDoc = array($record->listDoc);
					} else if (is_array($record->listDoc)) {
						$listDoc = $record->listDoc;
					}
				}
				
				// Buscamos el documento correspondiente aplicando la regla de cancelación
				$selectedDoc = null;
				if (!empty($listDoc)) {
					$lenDocs = count($listDoc);
					if ($lenDocs >= 2) {
						$penultimoDoc = $listDoc[$lenDocs - 2];
						$ultimoDoc = $listDoc[$lenDocs - 1];
						
						$docTypePenultimo = isset($penultimoDoc->tipoDocumento) ? $penultimoDoc->tipoDocumento : (isset($penultimoDoc->dctm_doctype) ? $penultimoDoc->dctm_doctype : (isset($penultimoDoc->dctmDoctype) ? $penultimoDoc->dctmDoctype : ''));
						if (strtoupper(trim($docTypePenultimo)) === 'CANCELACION' || strtoupper(trim($docTypePenultimo)) === 'CANCELADO') {
							$selectedDoc = $penultimoDoc;
						} else {
							$selectedDoc = $ultimoDoc;
						}
					} else {
						$selectedDoc = $listDoc[0];
					}
				}
				
				if ($selectedDoc !== null) {
					$docname = isset($selectedDoc->nombreDocumento) ? $selectedDoc->nombreDocumento : (isset($selectedDoc->dctm_docname) ? $selectedDoc->dctm_docname : (isset($selectedDoc->dctmDocname) ? $selectedDoc->dctmDocname : ''));
					$record->enlaceDoc = isset($selectedDoc->enlaceDoc) ? $selectedDoc->enlaceDoc : '';
					$record->urlEstructura = $docname;
				}
				
				// Si enlaceDoc termina en '/', le concatenamos el urlEstructura
				if (isset($record->enlaceDoc) && $record->enlaceDoc !== '' && substr($record->enlaceDoc, -1) === '/') {
					$record->enlaceDoc .= isset($record->urlEstructura) ? $record->urlEstructura : '';
				}
			}
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['estructuraAccionariaResults'] = $estructuraAccionariaList;
        $this->load->view('results/estructura_accionaria_results', $data);
	}
/* estructura accionaria */

/* Interconexion Internacional */
public function searchInterconexionInternacional() {
		
		$arrParameters_Search = array('searchInInternacionalAccionaria' => array(
			'idBp' => trim($this->input->post('idBP')),
            'idExterno' => trim($this->input->post('idBPExterno')),
			'bp' => '',
			'externo' => '',
			'folio' => trim($this->input->post('folio')),
			'fecRegistro' => trim($this->input->post('fecRegistro'))
        ) );
		
		$estructuraAccionariaList = null;
		try {
		   $interconexionInternacionalList =  $this->objClient->vRpcIntInternacionalSearch($arrParameters_Search);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $interconexionInternacionalList-->' . count($interconexionInternacionalList)  );
		
		if (isset($interconexionInternacionalList) && (is_array($interconexionInternacionalList) || is_object($interconexionInternacionalList))) {
			foreach ($interconexionInternacionalList as $internacional) {
				$resultTmp = $internacional;
			}
		}
		$interconexionInternacionalList = $resultTmp;
		
		if (isset($interconexionInternacionalList) && is_object($interconexionInternacionalList)) {
			$tmpArray = $interconexionInternacionalList;
			$interconexionInternacionalList = array($tmpArray);
		}
		

		
		//$contratosListFinal=$estructuraAccionariaList;
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['interconexionInternacionalResults'] = $interconexionInternacionalList;
        $this->load->view('results/interconexion_internacional_results', $data);
	}
/* Interconexion Internacional */


/* codigos de etica */
public function searchCodigosEtica() {
		
		$arrParameters_Search = array('searchCodigosEtica' => array(
			'idBP' => trim($this->input->post('txtIdBP')),
            'concesionario' => trim($this->input->post('txtConcesionario')),
			'folioRegistro' => trim($this->input->post('txtFolioRegistro')),
			'distintivo' => trim($this->input->post('txtDistintivo')),
			'fet' => trim($this->input->post('txtFet'))
        ) );
		
		$codigosEticaList = null;
		try {
		   $codigosEticaList =  $this->objClient->vRpcCodigosESearch($arrParameters_Search);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $codigosEticaList-->' . count($codigosEticaList)  );
		
		foreach ($codigosEticaList as $codigo) {
			$resultTmp = $codigo;
		}
		$codigosEticaList = $resultTmp;
		
		//if (count($codigosEticaList)==1) {
		if (isset($codigosEticaList) && is_object($codigosEticaList)) {
			$tmpArray = $codigosEticaList;
			$codigosEticaList = array($tmpArray);
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['codigosEticaResults'] = $codigosEticaList;
        $this->load->view('results/codigos_etica_results', $data);
	}
/* codigos de etica */

/* defensor de audiencias */
public function searchDefensorAudiencias() {
		
		$arrParameters_Search = array('searchDefensoresAudiencia' => array(
			'idBP' => trim($this->input->post('txtIdBP')),
            'concesionario' => trim($this->input->post('txtConcesionario')),
			'folioRegistro' => trim($this->input->post('txtFolioRegistro')),
			'distintivo' => trim($this->input->post('txtDistintivo')),
			'defensorHash' => trim($this->input->post('txtDefensorHash')),
			'fet' => trim($this->input->post('txtFet'))
        ) );
		
		$defensoresAudienciaList = null;
		try {
		   $defensoresAudienciaList =  $this->objClient->vRpcDefensoresASearch($arrParameters_Search);
        } catch (Exception $e) {
        	$this->writeLog('$e-->'.$e);
			$this->writeLog('$reqArray-->'.json_encode($arrParameters_Search));
		}
		
		$resultTmp = null;
		//error_log('[DEV ] $defensoresAudienciaList-->' . count($defensoresAudienciaList)  );
		
		foreach ($defensoresAudienciaList as $defensor) {
			$resultTmp = $defensor;
		}
		$defensoresAudienciaList = $resultTmp;
		
		//if (count($defensoresAudienciaList)==1) {
		if (isset($defensoresAudienciaList) && is_object($defensoresAudienciaList)) {
			$tmpArray = $defensoresAudienciaList;
			$defensoresAudienciaList = array($tmpArray);
		}
		
        $data['action'] = 'MAIN_CONTRATOA';
		$data['succMsg'] = '';
		$data['defensoresAudienciaResults'] = $defensoresAudienciaList;
        $this->load->view('results/defensores_audiencia_results', $data);
	}
/* defensor de audiencias */




    /* consulta directa */
    public function showConcesionInfo() {
    		
		$idFET = trim($this->input->get('idConcesion'));
		
		$this->writeLog('[DEV ] showConcesionInfo-->In'  );
		
		$idConcesion=-1;
		try {
			$idConcesionStr = substr($idFET, 3, 6);
			$idConcesion = (int)$idConcesionStr;
			$this->writeLog('[DEV ] showConcesionInfo-->$idConcesion-->' . $idConcesion  );
		} catch (Exception $e){
			$this->writeLog('[DEV ] showConcesionInfo-->Invalid FET-->' . $idFET  );
		}
		
		$data['idConcesion'] = $idConcesion;
		
		$this->writeLog('[DEV ] showConcesionInfo-->LoadView'  );
		
    		$this->load->view('results/concesion_direct_view', $data);
		
		//$this->load->view('results/hello_concesion', $data);
		
	}
	/* consulta directa */

    
}
