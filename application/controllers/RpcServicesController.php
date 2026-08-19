<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RpcServicesController extends CI_Controller {

	private $objClient = null;

    function __construct() {
        parent::__construct();
		ini_set('default_socket_timeout', 300);	
		//$this->objClient = new SoapClient("http://rpc.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => true,'default_socket_timeout' => 300));
		//$this->objClient = new SoapClient("http://10.34.144.82:7010/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>10));
		//$this->objClient = new SoapClient("http://rpc.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
		//$this->objClient = new SoapClient("http://ucsws.ift.org.mx/CftRtServices/CftRtServices?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
        //$this->load->model('catalogsdb', '', TRUE);
        
        $this->objClient = new SoapClient(URLSEARCHWS."?WSDL", array('cache_wsdl' => WSDL_CACHE_NONE,'trace' => 1, 'exceptions' => 1, 'connection_timeout' =>300));
        
    }

	function checkStringEmpty($cadena) {
	   	if($cadena!==null && trim($cadena)!=="" ) {
	   		return trim($cadena);
	   	} else {
	   		return "-";
	   	}
   }
	

    public function index() {

        error_log('[DEV ] call RpcServicesController-->');

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['useralias'] = $session_data['useralias'];
            $data['comesFromNav'] = '0';
            $data['concontratoFound'] = '';
            $data['section'] = '';
            $data['errorMsg'] = '';
            $data['action'] = 'INFO';

            $this->load->view('dashboard_main', $data);
        } else {
            //If no session, redirect to login page
            redirect('Login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('Login', 'refresh');
    }

    
//------------------------------------------------------------------------------ G R A V A M E N E S ----------------------------------------------

    //--------------------------------------------------------------- gravamenes
    
    function searchFET() {
        $dataInput = array(
            'searchFet' => $this->input->get('query')
        );
        //$result = $this->catalogsdb->buscaFets($dataInput);
        //$result = $this->buscaFets($dataInput);
		//error_log('[DEV ] searchFET-->' . $result);
		//return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
		
		try {
		   $objFets =  $this->objClient->vRpcFetsSearch($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
	 $resultTmp = null;	
		foreach ($objFets as $fets) {
			$resultTmp = $fets;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		
		$resultTmp2 = json_encode($resultTmp);
		
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }


	function searchConvBP1() {
        /*
        $dataInput = array(
            'searchConvBp' => $this->input->get('query')
        );
        $result = $this->catalogsdb->buscaConvBp1($dataInput);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
		*/
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcConveniosByBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function searchConvBP2() {
        /*
        $dataInput = array(
            'searchConvBp' => $this->input->get('query')
        );
        $result = $this->catalogsdb->buscaConvBp1($dataInput);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
		*/
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '2'
        );
		try {
		   $objBps =  $this->objClient->vRpcConveniosByBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function searchConvByDesc() {
        $dataInput = array(
            'convDescrip' => $this->input->get('query')
        );
        //$result = $this->catalogsdb->searchConvByDesc($dataInput);		
		//return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
		
		try {
		   $objBps =  $this->objClient->vRpcConveniosDescSearch($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
		
    }
    
	function searchBP() {
		$dataInput = array(
            'bpStr' => $this->input->get('query')
        );
		error_reporting(-1);
		try {
		   $objBps =  $this->objClient->vrpcSearchBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	/* permisos de radiocomunicacion */
	function searchBPPermisos() {
		$dataInput = array(
            'bpStr' => $this->input->get('query')
        );
		error_reporting(-1);
		try {
		   $objBps =  $this->objClient->vrpcSearchBPPermisos($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {	
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function searchFETPermisos() {
        $dataInput = array(
            'searchFet' => $this->input->get('query')
        );
        //$result = $this->catalogsdb->buscaFets($dataInput);
        //$result = $this->buscaFets($dataInput);
		//error_log('[DEV ] searchFET-->' . $result);
		//return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
		
		try {
		   $objFets =  $this->objClient->vRpcFetsSearchPermisos($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		
		foreach ($objFets as $fets) {
			$resultTmp = $fets;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		
		$resultTmp2 = json_encode($resultTmp);
		
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function searchExpedientesPermisos() {
		$expediente = $this->input->get('query');
		$dataInput = array(
            'searchExp' => strtoupper($expediente)
        );
		
		$objExpedientes= array(); 
		//error_log('[DEV ] $objExpedientes-->' . count($objExpedientes)  );
		try {
		   $objExpedientes =  $this->objClient->vRpcExpedientePermisosSearch($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objExpedientes as $expedientes) {
			$resultTmp = $expedientes;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	/* permisos de radiocomunicacion */
	
	
	function searchExpedientes() {
        /*
        $dataInput = array(
            'searchExp' => $this->input->get('query')
        );
        $result = $this->catalogsdb->buscaExpediente($dataInput);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
		*/
		
		$expediente = $this->input->get('query');
		$dataInput = array(
            'searchExp' => strtoupper($expediente)
        );
		
		$objExpedientes= array(); 
		//error_log('[DEV ] $objExpedientes-->' . count($objExpedientes)  );
		try {
		   $objExpedientes =  $this->objClient->vRpcExpedienteSearch($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objExpedientes as $expedientes) {
			$resultTmp = $expedientes;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function getBpFets() {
		$dataInput = array(
            'idBp' => $this->input->post('idBp')
        );
        $result = $this->catalogsdb->getBpFets($dataInput);
		//error_log('[DEV ] getBpFets-->' . $result);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
	}
	
	/* sanciones y supervision */
	function searchSancionByDesc() {
        $dataInput = array(
            'sancionDescrip' => $this->input->get('query')
        );
        $result = $this->catalogsdb->searchSancionByDesc($dataInput);
		
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
    }
	
	function searchSancionByOperador() {
        $dataInput = array(
            'sancionOperador' => $this->input->get('query')
        );
        
		try {
		   $objBps =  $this->objClient->vRpcInfSancionesByBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] searchSancionByOperador-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
		
        //$result = $this->catalogsdb->searchSancionByOperador($dataInput);
		//return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($result);
    }
	
	
	function searchPuntosBP() {
		$dataInput = array(
            'searchPuntosBp' => strtoupper($this->input->get('query'))
        );
		error_log('searchPuntosBp-->'.strtoupper($this->input->get('query')));
		try {
		   $objBps =  $this->objClient->vRpcPuntosByBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] searchPuntosBP-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function searchPuntosDescription() {
		$dataInput = array(
            'searchPuntosDesc' => strtoupper($this->input->get('query'))
        );
		error_log('searchPuntosDescription-->'.strtoupper($this->input->get('query')));
		try {
		   $objBps =  $this->objClient->vRpcPuntosByDescription($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] searchPuntosDescription-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	/* contratos de adhesion */
	function searchContratoAdhesionBP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcContratoAdhesionBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }

	function searchContratoAdhesionFET() {
		
		$dataInput = array(
            'searchContFet' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcContratoAdhesionFet($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
    
	
	/* espacios de publicidad */
	function searchEspaciosBP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcEspaciosBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }

	function searchEspaciosFET() {
		
		$dataInput = array(
            'searchContFet' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcEspaciosFet($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }	
	

	/* estructura accionaria */
	function searchEstructuraBP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcEstructuraBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }

	function searchEstructuraFET() {
		
		$dataInput = array(
            'searchContFet' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcEstructuraFet($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
	}
	/* estructura accionaria */	
	
	/* interconexion internacional */
	function searchIntInternacionalBP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcIntInternacionalBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	
	function searchIntInternacionalExtBP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcIntInternacionalExtBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }
	/* interconexion internacional */
	
	/* codigos de etica */
	function searchCodigosEBP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcCodigosEBP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }

	function searchCodigosEFET() {
		
		$dataInput = array(
            'searchContFet' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcCodigosEFet($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
	}
	
	function searchCodigosEDistintivo() {
		
		$dataInput = array(
            'searchExp' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcCodigosEDistintivo($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
	}
	
	
	/* codigos de etica */
	
	
	/* defensores de audiencia */
	function searchDefensoresABP() {
		
		$dataInput = array(
            'searchConvBp' => strtoupper($this->input->get('query')),
            'tipoBp' => '1'
        );
		try {
		   $objBps =  $this->objClient->vRpcDefensoresABP($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
    }

	function searchDefensoresAFET() {
		
		$dataInput = array(
            'searchContFet' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcDefensoresAFet($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
	}
	
	function searchDefensoresADistintivo() {
		
		$dataInput = array(
            'searchExp' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcDefensoresADistintivo($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
	}
	
	function searchDefensoresADefensor() {
		
		$dataInput = array(
            'searchExp' => strtoupper($this->input->get('query'))
        );
		try {
		   $objBps =  $this->objClient->vRpcDefensoresADefensor($dataInput);
        } catch (Exception $e) {
        	error_log('$e-->'.$e);
			error_log('$reqArray-->'.json_encode($dataInput));
		}
		$resultTmp = null;
		foreach ($objBps as $bps) {
			$resultTmp = $bps;			
		}
		//if (count($resultTmp)==1) {
		if ($resultTmp!==null && is_object($resultTmp)) {
			$tmpArray = $resultTmp;
			$resultTmp = array($tmpArray);
		}
		//error_log('[DEV ] $resultTmp-->' . count($resultTmp)  );
		$resultTmp2 = json_encode($resultTmp);
		return $this->output->set_content_type('application/json')->set_status_header(200)->set_output($resultTmp2);
	}
	
	
	/* defensores de audiencia */
	
}
