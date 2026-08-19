<?php

Class Searchdb extends CI_Model {

    function searchConcesiones($dataInput) {
        	
		$txtBPConcesionario = $dataInput['txtBPConcesionario'];
        $strConcesionario = $dataInput['strConcesionario'];
		$strServicios = $dataInput['strServicios'];
		$strFET = $dataInput['strFET'];
		$strCobertura = $dataInput['strCobertura'];
		$strEstatus = $dataInput['strEstatus'];
		$strExpediente = $dataInput['strExpediente'];
		$strCanal = $dataInput['strCanal'];
		$strTipo = $dataInput['strTipo'];
		$strSatelite = $dataInput['strSatelite'];
		$strPosicion = $dataInput['strPosicion'];


		error_log('[DEV ] RPC->searchConcesiones-->$strServicios'. $strServicios);
		error_log('[DEV ] RPC->searchConcesiones-->$strCobertura'. $strCobertura);
		
		$strSateliteArray = null;
		$hasStrSateliteArray = false;
		if (isset($strSatelite) AND $strSatelite!==null AND $strSatelite!=='""' AND strlen($strSatelite)>0) {
			error_log('[DEV ] RPC->searchConcesiones-->strlen($strSatelite)'. strlen($strSatelite));
			$strSateliteArray=json_decode($strSatelite, true);
			$hasStrSateliteArray = true;
		}
		
		$strPosicionArray = null;
		$hasStrPosicionArray = false;
		if (isset($strSatelite) AND $strPosicion!==null AND $strPosicion!=='""' AND strlen($strPosicion)>0) {
			$strPosicionArray=json_decode($strPosicion, true);
			$hasStrPosicionArray = true;
		}
		
		$strServiciosArray = null;
		$hasStrServiciosArray = false;
		if (isset($strServicios) AND $strServicios!==null AND $strServicios!=='""' AND strlen($strServicios)>0) {
			$strServiciosArray=json_decode($strServicios, true);
			$hasStrServiciosArray = true;
		}
		
		$strCoberturaArray = null;
		$hasStrCoberturaArray = false;
		if (isset($strCobertura) AND $strCobertura!==null AND $strCobertura!=='""' AND strlen($strCobertura)>0) {
			$strCoberturaArray=json_decode($strCobertura, true);
			$hasStrCoberturaArray = true;
		}
		

        $hasAnd = false;
        $cadenaQuery = "select c.id_concesion, c.c_folio_electronico, c.concesionario_name, c.nombre_comercial, c.tipo_inscripcion, ";
		$cadenaQuery = $cadenaQuery." c.estado_concesion, c.tipo_registro, decode(substr(c.c_folio_electronico,1,3),'FET','TELECOMUNICACIONES', 'FER', 'RADIO Y TELEVISIÓN') tipo,  ";
		$cadenaQuery = $cadenaQuery." c.c_vigencia_concesion, to_char(c.c_fecha_vencimiento, 'dd/MM/yyyy') fvencimiento,   ";
		$cadenaQuery = $cadenaQuery." to_char(c.c_fecha_instalacion, 'dd/MM/yyyy') finivigencia,   ";
		$cadenaQuery = $cadenaQuery." decode(substr(c.c_folio_electronico,1,3),'FET' ,to_char(c.c_fecha_otorgamiento,'dd/MM/yyyy'),'FER','') fotorgamiento,   ";
		$cadenaQuery = $cadenaQuery." to_char(c.c_fecha_registro, 'dd/MM/yyyy') fprorroga,   ";
		$cadenaQuery = $cadenaQuery." nvl(c.comercializadora,'NO') comercializadora, decode(nvl(c.conc_unica,'NO'),'X','SI','NO') unica ";
		$cadenaQuery = $cadenaQuery." from cft_rt_concesion c ";
		
		if ($hasStrSateliteArray OR $hasStrPosicionArray) {
			$cadenaQuery = $cadenaQuery." , cft_rt_satelites s ";
		}
		
		if (isset($strCanal) AND $strCanal!==null AND strlen(trim($strCanal))>0 ) {
			$cadenaQuery = $cadenaQuery." , cft_rt_tv tv ";
		}
		
		if ($hasStrCoberturaArray) {
			$cadenaQuery = $cadenaQuery." , cft_rt_cobertura_est cob ";
		}
		
		$cadenaQuery = $cadenaQuery." where ROWNUM <= 10  ";$hasAnd = true;
		
		if ($hasStrSateliteArray OR $hasStrPosicionArray) {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.id_concesion = s.id_concesion ";
		}
		
		if (isset($strCanal) AND $strCanal!==null AND strlen(trim($strCanal))>0 ) {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.id_concesion = TV.ID_CONCESION ";
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." TV.CANAL='".trim($strCanal)."' ";
		}
		
		if ($hasStrSateliteArray) {
			$cadenaQuery = $cadenaQuery." AND ( ";
			$hasOr = false;
			for ($i=0; $i < count($strSateliteArray); $i++) {
				$cadenaQuery = $cadenaQuery.($hasOr?" OR ":" ") ." s.nom_satelite='".$strSateliteArray[$i]."' ";
				$hasOr = true; 
				error_log('[DEV ] RPC->searchConcesiones-->$keySatelite'. $strSateliteArray[$i]);
			}
			$cadenaQuery = $cadenaQuery." ) ";
			$hasAnd = true;
		}
		
		if ($hasStrPosicionArray) {			
			$cadenaQuery = $cadenaQuery." AND ( ";
			$hasOr = false;
			for ($i=0; $i < count($strPosicionArray); $i++) {
				$cadenaQuery = $cadenaQuery.($hasOr?" OR ":" ") ." s.pos_orbital='".$strPosicionArray[$i]."' ";
				$hasOr = true; 
				error_log('[DEV ] RPC->searchConcesiones-->$strPosicionArray'. $strPosicionArray[$i]);
			}
			$cadenaQuery = $cadenaQuery." ) ";
			$hasAnd = true;
		}
		
		if ($hasStrServiciosArray) {			
			$cadenaQuery = $cadenaQuery." AND ( ";
			$hasOr = false;
			for ($i=0; $i < count($strServiciosArray); $i++) {
				$cadenaQuery = $cadenaQuery.($hasOr?" OR ":" ") ." FindSrvAlias('".$strServiciosArray[$i]."',c.id_concesion)='OK' ";
				$hasOr = true; 
				error_log('[DEV ] RPC->searchConcesiones-->$strServiciosArray'. $strServiciosArray[$i]);
			}
			$cadenaQuery = $cadenaQuery." ) ";
			$hasAnd = true;
		}
		
		
		if ($hasStrCoberturaArray) {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." C.ID_CONCESION=COB.ID_CONCESION ";
			$hasAnd = true;
			for ($i=0; $i < count($strCoberturaArray); $i++) {
				$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." COB.ESTADO4SEARCH LIKE '%". $this->decodeEdo($strCoberturaArray[$i])."%' ";
			}
		}
		
		if ($txtBPConcesionario!==null AND trim($txtBPConcesionario)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." substr(c.c_folio_electronico,13,6)='".trim($txtBPConcesionario)."'";
			$hasAnd = true;
		}
		if ($strFET!==null AND trim($strFET)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.c_folio_electronico='".trim($strFET)."'";
			$hasAnd = true;
		}
		
		if ($strEstatus!==null AND trim($strEstatus)!=='' AND trim($strEstatus)!=='ANY') {
			$strEstatusR = '';
			if ($strEstatus=='VIG') {
				$strEstatusR = 'VIGENTE';
			} else if ($strEstatus=='TER') {
				$strEstatusR = 'TERMINADO';
			} else if ($strEstatus=='INP') {
				$strEstatusR = 'EN PROCESO DE PRORROGA';
			}			
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.estado_concesion='".trim($strEstatusR)."'";
			$hasAnd = true;
		}
		
		if ($strExpediente!==null AND trim($strExpediente)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.c_distintivo_llamada='".trim($strExpediente)."'";
			$hasAnd = true;
		}
		
		if ($strTipo!==null AND trim($strTipo)!=='' AND trim($strTipo)!=='ANY') {
			$strTipoR = '';
			if ($strTipo=='AS') {
				$strTipoR = 'AS';
			} else if ($strTipo=='PE') {
				$strTipoR = 'PE';
			} else if ($strTipo=='CO') {
				$strTipoR = 'CO';
			}  else if ($strTipo=='AU') {
				$strTipoR = 'AU';
			}			
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.tipo_registro='".trim($strTipoR)."'";
			$hasAnd = true;
		}
			
		$cadenaQuery = $cadenaQuery." order by c.id_concesion ";
		error_log('[DEV ] RPC->searchConcesiones-->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchConcesiones-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchConcesiones-->not found');
            return null;
        }
    }
	
	
	function searchDocuments($idConcesion) {
        	
        $hasAnd = false;
        $cadenaQuery = "select dctm_concesion, dctm_docname, dctm_doctype, dctm_doctitle ";
		$cadenaQuery = $cadenaQuery." from cft_rt_documentos  ";
		$cadenaQuery = $cadenaQuery." where dctm_concesion=?   ";
		$cadenaQuery = $cadenaQuery." order by case when dctm_doctype='TITULOS' then 1 when  dctm_doctype='PERMISOS' then 2 when  dctm_doctype='CESIONES' then 3when  dctm_doctype='MODIFICACIONES' then  4 when dctm_doctype='PRÓRROGAS' then 5 else 6 end, dctm_fecha ";
		

		error_log('[DEV ] RPC->searchDocuments-->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery, array($idConcesion));
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchDocuments-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchDocuments-->not found');
            return false;
        }
    }

	function searchCobertura($idConcesion) {
        	
        $hasAnd = false;
        $cadenaQuery = "select ";
		$cadenaQuery = $cadenaQuery." ID_CONCESION, ESTADO  ";
		$cadenaQuery = $cadenaQuery." FROM CFT_RT_COBERTURA_EST  ";
		$cadenaQuery = $cadenaQuery." WHERE ID_CONCESION=?   ";
		$cadenaQuery = $cadenaQuery." GROUP BY ESTADO, ID_CONCESION ";
		$cadenaQuery = $cadenaQuery." ORDER BY ESTADO, ID_CONCESION ";		

		error_log('[DEV ] RPC->searchCobertura->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery, array($idConcesion));
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchDocuments-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchDocuments-->not found');
            return false;
        }
    }
	
	function searchServiciosAsociados($idConcesion) {
        	
        $hasAnd = false;
        $cadenaQuery = "select ";
		$cadenaQuery = $cadenaQuery." distinct DESCRIPCION   ";
		$cadenaQuery = $cadenaQuery." FROM CFT_RT_SERV_ALIAS  ";
		$cadenaQuery = $cadenaQuery." WHERE ID_CONCESION=?   ";
		$cadenaQuery = $cadenaQuery." ORDER BY DESCRIPCION  ";		

		error_log('[DEV ] RPC->searchServiciosAsociados->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery, array($idConcesion));
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchServiciosAsociados-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchServiciosAsociados-->not found');
            return false;
        }
    }
	
	function viewConcesionDetail($idConcesion) {
        	
        $hasAnd = false;
        $cadenaQuery = "select ";
		$cadenaQuery = $cadenaQuery." distinct DESCRIPCION   ";
		$cadenaQuery = $cadenaQuery." FROM CFT_RT_SERV_ALIAS  ";
		$cadenaQuery = $cadenaQuery." WHERE ID_CONCESION=?   ";
		$cadenaQuery = $cadenaQuery." ORDER BY DESCRIPCION  ";		

		error_log('[DEV ] RPC->searchServiciosAsociados->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery, array($idConcesion));
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchServiciosAsociados-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchServiciosAsociados-->not found');
            return false;
        }
    }
    
    function buscaBps($dataInput) {

        $searchBps = $dataInput['searchBP'];
        $searchBps=trim($searchBps);
        
        if ($searchBps==null OR $searchBps=='') {
        	return null;
        }
		
        $searchBps = strtoupper($searchBps);
        error_log('[DEV ] buscaBps-->' . $searchBps);

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

		$query=$this->db->query($cadenaQuery, array('%'.$searchBps.'%'));
        
        //$query = $this->db->query($cadenaQuery);
        
        error_log('[DEV ] buscaBps-->SQL[' . $cadenaQuery.']');		
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
	
    function valVacio($campo){
        
        if($campo == '' || $campo == null){
            return "NULL";
        }
        else {
            return "'".trim(strtoupper($campo))."'";
        }
    }
    
    /* Convenios */
    function searchConvenios($dataInput) {
        	
		$strTiposConvenios = $dataInput['strTiposConvenios'];
        $strDescConvenio = $dataInput['strDescConvenio'];
		$strConvFecIni = $dataInput['strConvFecIni'];
		$strConvFecFin = $dataInput['strConvFecFin'];
		$strConvFolio = $dataInput['strConvFolio'];
		$txtConvBpSource1 = $dataInput['txtConvBpSource1'];
		$txtConvBpSource2 = $dataInput['txtConvBpSource2'];


        $hasAnd = false;
        $cadenaQuery = "select c.CI_ID_INSCR, c.CI_FOLCONVENIO EXPEDIENTE, c.CI_FOLINSCRIP FOLIO_INSCRIPCION,   ";
		$cadenaQuery = $cadenaQuery." c.CI_DESCRIP_CONV DESCRIPCION,  ";
		$cadenaQuery = $cadenaQuery." upper(c.CI_TIPO) DESCRIPCION_TIPO,  ";
		$cadenaQuery = $cadenaQuery." to_char(c.CI_FECHA_CELEB,'dd/MM/yyyy') FECHA_CELEBRACION,   ";
		$cadenaQuery = $cadenaQuery." to_char(c.CI_FECHA_TERM,'dd/MM/yyyy') FECHA_TERMINO,   ";
		$cadenaQuery = $cadenaQuery." nvl(c.CI_ESTATUS,'') ESTATUS,  ";
		$cadenaQuery = $cadenaQuery." c.CI_DESCRIPCION,  ";
		$cadenaQuery = $cadenaQuery." d.CI_DOCTYPE, d.CI_DOCTITLE, d.CI_DOCNAME , ";
		$cadenaQuery = $cadenaQuery." cn.ci_fet, cn.ci_nombre_concesionario, cn.ci_grupo  ";
		$cadenaQuery = $cadenaQuery." from cft_rt_ci_convenios c, cft_rt_ci_documentos d, cft_rt_ci_concesiones cn ";
		$cadenaQuery = $cadenaQuery." where c.CI_ID_INSCR=d.CI_ID_INSC ";
		$cadenaQuery = $cadenaQuery." AND c.CI_ID_INSCR=cn.ci_id_inscr ";
		$hasAnd = true;
		
		if ($strDescConvenio!==null AND trim($strDescConvenio)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.CI_DESCRIP_CONV like '%".trim($strDescConvenio)."%'";
			$hasAnd = true;
		}
		
		if ($strConvFecIni!==null AND trim($strConvFecIni)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.CI_FECHA_CELEB >=to_date('".trim($strConvFecIni)."','dd/MM/yyyy')";
			$hasAnd = true;
		}
		
		if ($strConvFecFin!==null AND trim($strConvFecFin)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.CI_FECHA_CELEB <=to_date('".trim($strConvFecFin)."','dd/MM/yyyy')";
			$hasAnd = true;
		}
		
		if ($strConvFolio!==null AND trim($strConvFolio)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." c.CI_FOLINSCRIP ='".trim($strConvFolio)."' ";
			$hasAnd = true;
		}
		
		
		$hasBp1 = false;
		$hasBp2 = false;
		$cadenaQueryBp1 = '';
		$cadenaQueryBp2 = '';
		
		if ($txtConvBpSource1!==null AND trim($txtConvBpSource1)!=='') {
			$hasBp1=true;
			$cadenaQueryBp1 = " (substr(cn.ci_fet,13,6)='".trim($txtConvBpSource1)."' AND cn.ci_grupo=1)";
			$hasAnd = true;
		}
		
		if ($txtConvBpSource2!==null AND trim($txtConvBpSource2)!=='') {
			$hasBp2=true;
			$cadenaQueryBp2 = " (substr(cn.ci_fet,13,6)='".trim($txtConvBpSource2)."' AND cn.ci_grupo=2)";
			$hasAnd = true;
		}
		if ($hasBp1 AND $hasBp2) {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") . " (".$cadenaQueryBp1." OR ".$cadenaQueryBp2.") ";
		} else if ($hasBp1) {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") . " (".$cadenaQueryBp1.") ";
		} else if ($hasBp2) {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") . " (".$cadenaQueryBp2.") ";
		}
		
		$cadenaQuery = $cadenaQuery." order by c.CI_FOLCONVENIO, c.CI_FOLINSCRIP, cn.ci_grupo, cn.ci_nombre_concesionario   ";
		error_log('[DEV ] RPC->searchConvenios-->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchConvenios-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchConvenios-->not found');
            return null;
        }
    }
    
	
	/* Sanciones */
    function searchSanciones($dataInput) {
        	
		$strDescSancion = $dataInput['strDescSancion'];
        $strBpSancion = $dataInput['strBpSancion'];
		$strSancionFecIni = $dataInput['strSancionFecIni'];
		$strSancionFecFin = $dataInput['strSancionFecFin'];
		$strSancionFolio = $dataInput['strSancionFolio'];
		
		$strTipoInforme = $dataInput['strTipoInforme'];


        $hasAnd = false;
        $cadenaQuery = "select id_inscripcion, id_bp_aep, aep, tipo_informe, periodo, document  ";
		$cadenaQuery = $cadenaQuery." from cft_rt_informes ";
		
		if ($strDescSancion!==null AND trim($strDescSancion)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." tipo_informe like '%".trim($strDescSancion)."%'";
			$hasAnd = true;
		}
		
		if ($strBpSancion!==null AND trim($strBpSancion)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." id_bp_aep ='".trim($strBpSancion)."' ";
			$hasAnd = true;
		}
		
		if ($strSancionFecIni!==null AND trim($strSancionFecIni)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." fecha_ini_informe >=to_date('".trim($strSancionFecIni)."','dd/MM/yyyy')";
			$hasAnd = true;
		}
		
		if ($strSancionFecFin!==null AND trim($strSancionFecFin)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." fecha_fin_informe <=to_date('".trim($strSancionFecFin)."','dd/MM/yyyy')";
			$hasAnd = true;
		}
		
		if ($strSancionFolio!==null AND trim($strSancionFolio)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." id_inscripcion ='".trim($strSancionFolio)."' ";
			$hasAnd = true;
		}
		
		if ($strTipoInforme!==null AND trim($strTipoInforme)!=='') {
			if ($strTipoInforme=='IN') {
				$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." tipo_reg ='I' ";
			} else if ($strTipoInforme=='SU') {
				$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." tipo_reg ='S' ";
			}
			
			$hasAnd = true;
		}
		
		
		$cadenaQuery = $cadenaQuery." order by id_inscripcion   ";
		error_log('[DEV ] RPC->searchSanciones-->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchSanciones-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchSanciones-->not found');
            return null;
        }
    }
    
	
	
	function searchSancionesFets($idInscripcion) {
        	
        $cadenaQuery = "select id_inscripcion, id_bp_aep, aep, tipo_informe, periodo, document  ";
		$cadenaQuery = $cadenaQuery." from cft_rt_informes ";
		
		if ($strDescSancion!==null AND trim($strDescSancion)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." tipo_informe like '%".trim($strDescSancion)."%'";
			$hasAnd = true;
		}
		
		if ($strBpSancion!==null AND trim($strBpSancion)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." AND id_bp_aep ='".trim($strBpSancion)."' ";
			$hasAnd = true;
		}
		
		if ($strSancionFecIni!==null AND trim($strSancionFecIni)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." AND fecha_ini_informe >=to_date('".trim($strSancionFecIni)."','dd/MM/yyyy')";
			$hasAnd = true;
		}
		
		if ($strSancionFecFin!==null AND trim($strSancionFecFin)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." AND fecha_fin_informe <=to_date('".trim($strSancionFecFin)."','dd/MM/yyyy')";
			$hasAnd = true;
		}
		
		if ($strSancionFolio!==null AND trim($strSancionFolio)!=='') {
			$cadenaQuery = $cadenaQuery.($hasAnd?" AND ":" WHERE ") ." AND id_inscripcion ='".trim($strSancionFolio)."' ";
			$hasAnd = true;
		}
		
		
		$cadenaQuery = $cadenaQuery." order by id_inscripcion   ";
		error_log('[DEV ] RPC->searchSanciones-->SQL'. $cadenaQuery);	
			
		$query = $this->db->query($cadenaQuery);
		if ($query->num_rows() >= 1) {
            error_log('[DEV ] searchSanciones-->found');
            return $query->result();
        } else {
            error_log('[DEV ] searchSanciones-->not found');
            return null;
        }
    }


	function decodeEdo($dataEdo){
		$strEdo='';
		switch ($dataEdo) {
			case '1':
				$strEdo='AGUASCALIENTES'; 
				break;
			case '2':
				$strEdo='BAJA CALIFORNIA N'; 
				break;
			case '3':
				$strEdo='BAJA CALIFORNIA SUR'; 
				break;
			case '4':
				$strEdo='CAMPECHE'; 
				break;
			case '5':
				$strEdo='COAHUILA'; break;
			case '6':
				$strEdo='COLIMA'; 
				break;
			case '7':
				$strEdo='CHIAPAS'; 
				break;
			case '8':
				$strEdo='CHIHUAHUA'; 
				break;
			case '9':
				$strEdo='DISTRITO FEDERAL'; 
				break;
			case '10':
				$strEdo='DURANGO'; 
				break;
			case '11':
				$strEdo='GUANAJUATO'; 
				break;
			case '12':
				$strEdo='GUERRERO'; 
				break;
			case '13':
				$strEdo='HIDALGO'; 
				break;
			case '14':
				$strEdo='JALISCO'; 
				break;
			case '15':
				$strEdo='ESTADO DE MEXICO'; 
				break;
			case '16':
				$strEdo='MICHOACAN'; 
				break;
			case '17':
				$strEdo='MORELOS'; 
				break;
			case '18':
				$strEdo='NAYARIT'; 
				break;
			case '19':
				$strEdo='NUEVO LEON'; 
				break;
			case '20':
				$strEdo='OAXACA'; 
				break;
			case '21':
				$strEdo='PUEBLA'; 
				break;
			case '22':
				$strEdo='QUERETARO'; 
				break;
			case '23':
				$strEdo='QUINTANA ROO'; 
				break;
			case '24':
				$strEdo='SAN LUIS POTOSI'; 
				break;
			case '25':
				$strEdo='SINALOA'; 
				break;
			case '26':
				$strEdo='SONORA'; 
				break;
			case '27':
				$strEdo='TABASCO'; 
				break;
			case '28':
				$strEdo='TAMAULIPAS'; 
				break;
			case '29':
				$strEdo='TLAXCALA'; 
				break;
			case '30':
				$strEdo='VERACRUZ'; 
				break;
			case '31':
				$strEdo='YUCATAN'; 
				break;
			case '32':
				$strEdo='ZACATECAS'; 
				break;
			
			default:
				$strEdo='NACIONAL';
				break;
		}
        return $strEdo;                                
	}



}

?>