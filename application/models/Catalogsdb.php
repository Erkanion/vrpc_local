<?php

Class Catalogsdb extends CI_Model {

    
    function buscaFets($dataInput) {

        $searchFet = $dataInput['searchFet'];
		$searchFet=trim($searchFet);
        if ($searchFet==null OR $searchFet=='') {
        	return null;
        }
		
		$searchFet = strtoupper($searchFet);
		//$cadenaQuery = "SELECT FOLIO_ELECTRONICO, expediente from rpc_base where folio_electronico like ? ";
		
		$cadenaQuery = "SELECT c_folio_electronico FOLIO_ELECTRONICO, c_distintivo_llamada EXPEDIENTE from cft_rt_concesion where c_folio_electronico like '%".$this->db->escape_like_str($searchFet)."%' ";
		
		$searchFetT = ' %'.$searchFet.'%';
		
		error_log('[DEV ] buscaFets-->' . $searchFetT);
		
		//$query = $this->db->query($cadenaQuery, array($searchFetT));

        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }
	
	function buscaConvBp1($dataInput) {
        $searchConvBp = $dataInput['searchConvBp'];
		$searchConvBp=trim($searchConvBp);
        if ($searchConvBp==null OR $searchConvBp=='') {
        	return null;
        }
		
		$searchConvBp = strtoupper($searchConvBp);
		$cadenaQuery = "select substr(ci_fet,13,6) ID_bp, ci_nombre_concesionario concesionario from cft_rt_ci_concesiones where ci_nombre_concesionario like '%".$this->db->escape_like_str($searchConvBp)."%' and ci_grupo=1 group by substr(ci_fet,13,6), ci_nombre_concesionario order by ci_nombre_concesionario ";
		
		error_log('[DEV ] buscaConvBp-->' . $cadenaQuery);
		
		//$query = $this->db->query($cadenaQuery, array($searchFetT));
        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }
	
	function buscaConvBp2($dataInput) {

        $searchConvBp = $dataInput['searchConvBp'];
		$searchConvBp=trim($searchConvBp);
        if ($searchConvBp==null OR $searchConvBp=='') {
        	return null;
        }
		
		$searchConvBp = strtoupper($searchConvBp);
		$cadenaQuery = "select substr(ci_fet,13,6) ID_bp, ci_nombre_concesionario concesionario from cft_rt_ci_concesiones where ci_nombre_concesionario like '%".$this->db->escape_like_str($searchConvBp)."%' and ci_grupo=2 group by substr(ci_fet,13,6), ci_nombre_concesionario order by ci_nombre_concesionario ";
		
		error_log('[DEV ] buscaConvBp-->' . $cadenaQuery);
		
		//$query = $this->db->query($cadenaQuery, array($searchFetT));
        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }
	
	function searchConvByDesc($dataInput) {

        $searchConvBp = $dataInput['convDescrip'];
		$searchConvBp=trim($searchConvBp);
        if ($searchConvBp==null OR $searchConvBp=='') {
        	return null;
        }
		
		$searchConvBp = strtoupper($searchConvBp);
		$cadenaQuery = "select ci_descrip_conv from cft_rt_ci_convenios where ci_descrip_conv like '%".$this->db->escape_like_str($searchConvBp)."%' group by ci_descrip_conv order by ci_descrip_conv ";
		
		error_log('[DEV ] searchConvByDesc-->' . $cadenaQuery);
		
		//$query = $this->db->query($cadenaQuery, array($searchFetT));
        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }
	
	function buscaExpediente($dataInput) {

        $searchExp = $dataInput['searchExp'];
		
		$searchExp=trim($searchExp);
        if ($searchExp==null OR $searchExp=='') {
        	return null;
        }
		
		$searchExp = strtoupper($searchExp);
		
		$cadenaQuery = "select distinct c_distintivo_llamada EXPEDIENTE from cft_rt_concesion where c_distintivo_llamada is not null and c_distintivo_llamada like '%".$this->db->escape_like_str($searchExp)."%' ";
		
		error_log('[DEV ] buscaExpediente-->' . $searchExp);
		
        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }
    
    
    function buscaBps($dataInput) {

        $searchBps = $dataInput['searchBP'];
        $searchBps=trim($searchBps);
        
        if ($searchBps==null OR $searchBps=='') {
        	return null;
        }
		
        $searchBps = strtoupper($searchBps);
        error_log('[DEV ] buscaBps-->' . $searchBps);

		/*
        $cadenaQuery = "select ID_BP, CONCESIONARIO FROM (
				SELECT ID_BP, bp_fisica_moral,
				  CASE WHEN bp_fisica_moral='FI'
				  THEN bp_nombre||' '||nvl(bp_ap_paterno,'')||' '||nvl(bp_ap_materno,'') 
				  ELSE 
				  bp_razon_social_1||nvl(trim(bp_razon_social_2),'')||nvl(trim(bp_razon_social_3),'')||nvl(trim(bp_razon_social_4),'')||' '||nvl(trim(bp_entidad_legal),'') END AS CONCESIONARIO 
				  FROM cft_rt_bp 
				)
				  WHERE 
				  CONCESIONARIO is not null
				  AND CONCESIONARIO like ? group by ID_BP,CONCESIONARIO order by CONCESIONARIO ";
		*/
		/*
		$cadenaQuery = "select ID_BP, decode(TRIM(COMERCIAL), null, CONCESIONARIO, '', CONCESIONARIO, COMERCIAL) CONCESIONARIO,
		    soundex(CONCESIONARIO), soundex(COMERCIAL), 
		    utl_match.edit_distance(CONCESIONARIO, ?),
		    utl_match.edit_distance(COMERCIAL, ?) 
			FROM (
				SELECT ID_BP, bp_fisica_moral, bp_nombre_comercial comercial,
				  CASE WHEN bp_fisica_moral='FI'
				  THEN bp_nombre||' '||nvl(bp_ap_paterno,'')||' '||nvl(bp_ap_materno,'')  
				  ELSE
				  bp_razon_social_1||nvl(trim(bp_razon_social_2),'')||nvl(trim(bp_razon_social_3),'')||nvl(trim(bp_razon_social_4),'')||' '||nvl(trim(bp_entidad_legal),'') END AS CONCESIONARIO  
				  FROM cft_rt_bp 
				)
				  WHERE 
				  CONCESIONARIO is not null
				  AND (CONCESIONARIO like ? OR COMERCIAL like ?)
				  group by ID_BP,CONCESIONARIO, COMERCIAL order by CONCESIONARIO ";
		 */
		 
		 $cadenaQuery = "select ID_BP, 
		    case 
          		when instr(TRIM(CONCESIONARIO), ?)>0 then
            	CONCESIONARIO
          	else 
            	decode(TRIM(COMERCIAL), null, CONCESIONARIO, '', CONCESIONARIO, COMERCIAL)
        	end CONCESIONARIO
			FROM (
				SELECT ID_BP, bp_fisica_moral, bp_nombre_comercial comercial,
				  CASE WHEN bp_fisica_moral='FI'
				  THEN bp_nombre||' '||nvl(bp_ap_paterno,'')||' '||nvl(bp_ap_materno,'')  
				  ELSE
				  bp_razon_social_1||nvl(trim(bp_razon_social_2),'')||nvl(trim(bp_razon_social_3),'')||nvl(trim(bp_razon_social_4),'')||' '||nvl(trim(bp_entidad_legal),'') END AS CONCESIONARIO  
				  FROM cft_rt_bp 
				)
				  WHERE 
				  CONCESIONARIO is not null
				  AND (CONCESIONARIO like ? OR COMERCIAL like ?)
				  group by ID_BP,CONCESIONARIO, COMERCIAL order by CONCESIONARIO ";

		$query=$this->db->query($cadenaQuery, array($searchBps,'%'.$searchBps.'%', '%'.$searchBps.'%'));
        
        //$query = $this->db->query($cadenaQuery);
        
        error_log('[DEV ] Catalogsdb-->buscaBps-->SQL[' . $cadenaQuery.']');		
        $results = $query->result();
        return json_encode($results);
		
    }
    
    
	function listSatelites() {
    	$cadenaQuery = "select distinct NOM_SATELITE    
			from cft_rt_satelites
			order by nom_satelite ";
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] listSatelites-->found');
            return $query->result();
        } else {
            error_log('[DEV ] listSatelites-->not found');
            return false;
        }
			
    }
	
	
	function listPosicionOrbital() {
    	$cadenaQuery = "select trim(pos_orbital) POS_ORBITAL    
			from cft_rt_satelites
			where trim(pos_orbital) is not null
			group by trim(pos_orbital)
			order by trim(pos_orbital) ";
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] listPosicionOrbital-->found');
            return $query->result();
        } else {
            error_log('[DEV ] listPosicionOrbital-->not found');
            return false;
        }
			
    }
	
	
	function listPopular() {
    	$cadenaQuery = "select * from (select key_item, key_item_str, item_type, description_item, hits, priority     
			from cft_rt_popular			
			order by item_type, priority desc, hits desc ) where ROWNUM <= 5 ";
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] listPopular-->found');
            return $query->result();
        } else {
            error_log('[DEV ] listPopular-->not found');
            return false;
        }
			
    }
	
	
    function valVacio($campo){
        
        if($campo == '' || $campo == null){
            return "NULL";
        }
        else {
            return "'".trim(strtoupper($campo))."'";
        }
    }
	
	
	function searchSancionByDesc($dataInput) {

        $searchConvBp = $dataInput['sancionDescrip'];
		$searchConvBp=trim($searchConvBp);
        if ($searchConvBp==null OR $searchConvBp=='') {
        	return null;
        }
		
		$searchConvBp = strtoupper($searchConvBp);
		$cadenaQuery = "select tipo_informe from cft_rt_informes where tipo_informe like '%".$this->db->escape_like_str($searchConvBp)."%' group by tipo_informe  ";
		
		error_log('[DEV ] searchSancionByDesc-->' . $cadenaQuery);
		
		//$query = $this->db->query($cadenaQuery, array($searchFetT));
        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }
	
	function searchSancionByOperador($dataInput) {

        $searchConvBp = $dataInput['sancionOperador'];
		$searchConvBp=trim($searchConvBp);
        if ($searchConvBp==null OR $searchConvBp=='') {
        	return null;
        }
		
		$searchConvBp = strtoupper($searchConvBp);
		//$cadenaQuery = "select id_bp_aep, aep from cft_rt_informes where aep like '%".$this->db->escape_like_str($searchConvBp)."%' group by id_bp_aep, aep  ";
		$cadenaQuery = "select id_bp_aep, aep from cft_rt_informes where upper(convert(aep, 'US7ASCII')) like upper(convert('%".$this->db->escape_like_str($searchConvBp)."%','US7ASCII')) group by id_bp_aep, aep ";
		
		error_log('[DEV ] searchSancionByOperador-->' . $cadenaQuery);
		
		//$query = $this->db->query($cadenaQuery, array($searchFetT));
        $query = $this->db->query($cadenaQuery);
        $results = $query->result();
        return json_encode($results);
    }

}

?>