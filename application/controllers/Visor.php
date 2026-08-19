<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	private $objClient = null; 
	 
	function __construct() {
        parent::__construct();
		ini_set('default_socket_timeout', 300);	
		//$this->objClient = new SoapClient("http://rpc.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true,'default_socket_timeout' => 300));
		//$this->objClient = new SoapClient("http://10.34.144.82:7010/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>10));
		//$this->objClient = new SoapClient("http://rpc.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
		$this->objClient = new SoapClient(URLSEARCHWS."?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
		//$this->objClient = new SoapClient("http://ucsws.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
        //$this->load->model('catalogsdb', '', TRUE);
    }
	
	public function index()
	{
		//$this->output->cache(5);
		//$satelitesList = $this->catalogsdb->listSatelites();
		$satelitesList = $this->listSatelites();
		//$posicionesList = $this->catalogsdb->listPosicionOrbital();
		$posicionesList = $this->listPosicionOrbital();
		
		//$popularList = $this->catalogsdb->listPopular();
		$popularList = $this->listPopular();
		
		$data['satelitesList'] = $satelitesList;
		$data['posicionesList'] = $posicionesList;
		$data['popularList'] = $popularList;
		$this->load->view('main_search', $data);
	}

	public function downloads() {
		$this->load->view('sections/downloads');
	}

	public function generarReporteProrroga() {
		$dataInput = array(
			'dummy' => '?'
		);

		$logPath = APPPATH . 'logs/genReporteServicesCRT.txt';
		$timestamp = date('Y-m-d H:i:s');
		$status = 'ERROR';
		$errorMessage = '';
		$response = null;
		$soapRequest = '';
		$soapResponse = '';
		$fileName = 'Reporte_Generico.xlsx';
		$fileContent = '';
		$curlCommand = '';

		try {
			$response = $this->objClient->genReporteServicesCRT($dataInput);
			$status = 'EXITO';
		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
		}

		$soapRequest = $this->objClient->__getLastRequest();
		$soapResponse = $this->objClient->__getLastResponse();
		$soapRequestHeaders = $this->objClient->__getLastRequestHeaders();
		$endpointUrl = rtrim(URLSEARCHWS, '/') . '/CftRtServices/CftRtServices';
		$soapAction = '"genReporteServicesCRT"';
		$contentType = 'text/xml; charset=utf-8';

		if (!empty($soapRequestHeaders)) {
			$headerLines = explode("\n", str_replace("\r", '', $soapRequestHeaders));
			foreach ($headerLines as $headerLine) {
				$headerLine = trim($headerLine);
				if (strpos($headerLine, 'POST ') === 0) {
					$parts = explode(' ', $headerLine);
					if (count($parts) >= 2 && !empty($parts[1])) {
						$endpointUrl = (strpos($parts[1], 'http') === 0)
							? $parts[1]
							: rtrim(URLSEARCHWS, '/') . $parts[1];
					}
				}
				if (stripos($headerLine, 'SOAPAction:') === 0) {
					$soapAction = trim(substr($headerLine, strlen('SOAPAction:')));
				}
				if (stripos($headerLine, 'Content-Type:') === 0) {
					$contentType = trim(substr($headerLine, strlen('Content-Type:')));
				}
			}
		}

		if (!empty($soapRequest)) {
			$soapRequestForCurl = str_replace("'", "'\\''", $soapRequest);
			$curlCommand = "curl --location --request POST '$endpointUrl' "
				. "--header 'Content-Type: $contentType' "
				. "--header 'SOAPAction: $soapAction' "
				. "--data '$soapRequestForCurl'";
		}

		if ($status === 'EXITO' && isset($response->return->data->entry)) {
			$entries = $response->return->data->entry;
			if (!is_array($entries)) {
				$entries = array($entries);
			}

			foreach ($entries as $entry) {
				if (!isset($entry->key) || !isset($entry->value)) {
					continue;
				}
				if ($entry->key === 'datoArray') {
					$fileContent = base64_decode($entry->value, true);
				}
				if ($entry->key === 'nombreReporte' && !empty($entry->value)) {
					$fileName = $entry->value;
				}
			}
		}

		if ($fileContent === false || $fileContent === '') {
			if ($status === 'EXITO') {
				$status = 'ERROR';
				$errorMessage = 'No se pudo decodificar el archivo XLSX de la respuesta SOAP.';
			}
			$fileContent = '';
		}

		$logContent = "[$timestamp] genReporteServicesCRT\n";
		$logContent .= "ESTADO: $status\n";
		if (!empty($errorMessage)) {
			$logContent .= "ERROR: $errorMessage\n";
		}
		$logContent .= "SOAP REQUEST:\n$soapRequest\n";
		if (!empty($curlCommand)) {
			$logContent .= "CURL INSOMNIA:\n$curlCommand\n";
		}
		if (!empty($soapResponse)) {
			$logContent .= "SOAP RESPONSE:\n$soapResponse\n";
		}
		$logContent .= "RESPUESTA PARSEADA:\n" . print_r($response, true) . "\n";
		$logContent .= "NOMBRE_REPORTE: $fileName\n";
		$logContent .= "BYTES_REPORTE: " . strlen($fileContent) . "\n";
		$logContent .= str_repeat('=', 100) . "\n";

		file_put_contents($logPath, $logContent, FILE_APPEND);

		if ($status === 'EXITO' && !empty($fileContent)) {
			$this->output->set_status_header(200);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
			header('Content-Length: ' . strlen($fileContent));
			header('Cache-Control: max-age=0');
			echo $fileContent;
			return;
		}

		$this->output->set_status_header(500);
		header('Content-Type: text/plain; charset=utf-8');
		echo !empty($errorMessage)
			? 'La solicitud genReporteServicesCRT falló: ' . $errorMessage
			: 'La solicitud genReporteServicesCRT falló. Revisar application/logs/genReporteServicesCRT.txt';
	}



    private function listSatelites() {
    	$dataInput = array(
            'dummy' => 'dummy'
        );
		//$objSatelites = array();
		try {
		   $objSatelites =  $this->objClient->vRpcSatelitesList($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		
		$resultTmp = null;
		foreach ($objSatelites as $satelite) {
			$resultTmp = $satelite;
		}
		
		error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		
		//$resultTmp2 = json_encode($resultTmp);
		//return $resultTmp2;
		return $resultTmp;
    }
	
	private function listPosicionOrbital() {
    	$dataInput = array(
            'dummy' => 'dummy'
        );
		//$objSatelites = array();
		try {
		   $objPosiciones =  $this->objClient->vRpcPosicionOrbitalList($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		
		$resultTmp = null;
		foreach ($objPosiciones as $posicion) {
			$resultTmp = $posicion;
		}
		
		error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		
		//$resultTmp2 = json_encode($resultTmp);
		//return $resultTmp2;
		return $resultTmp;
    }
	
	private function listPopular() {
    	$dataInput = array(
            'dummy' => 'dummy'
        );
		//$objSatelites = array();
		try {
		   $objPosiciones =  $this->objClient->vRpcListPopular($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		
		$resultTmp = null;
		foreach ($objPosiciones as $posicion) {
			$resultTmp = $posicion;
		}
		
		error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		
		//$resultTmp2 = json_encode($resultTmp);
		//return $resultTmp2;
		return $resultTmp;
    }	
}
