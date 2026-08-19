/**
 * @author IFT
 */
var controllerSearchStr = "RpcSearchController";
//var controllerSearchStr = "vrpc/RpcSearchController";

let domain = window.location.hostname;
let urlAppRpc = "";

if (domain.includes('vrpclocal')) {
    urlAppRpc = "http://vrpclocal.ift.org.mx/";
} else if (domain.includes('localhost')) {
    urlAppRpc = "http://localhost:8080/VRPC/";
}
else if (domain.includes('uat')) {
    urlAppRpc = "https://rpc-uat.crt.gob.mx/vrpc/";
}
else if (domain.includes('qa')) {
    urlAppRpc = "https://rpcqa.crt.gob.mx/vrpc/";
} 
else if (domain.includes('dev')) {
    urlAppRpc = "https://rpcdev.crt.gob.mx/vrpc/";
} 
else {
    urlAppRpc = "https://rpc.ift.org.mx/vrpc/"; // producción
}

function fixUrl(reqPage, url) {
    if (reqPage.indexOf(url) < 0) {
        reqPage = url + "/" + reqPage;
    }
    return urlAppRpc+reqPage;
} 		

function checkNull(field, defaultValue) {
	if (field == null) {
		return defaultValue;
	} else {
		return field;
	}
}

function goToByScroll(id){
    //id = id.replace("link", "");
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top},
        'slow');
}

function searchConcesiones(evt) {
    evt.preventDefault();

    reqPageO = 'searchConcesiones';
    //var rescontrollerSearchStr = controllerSearchStr.replace("vrpc/vrpc", "vrpc");
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var strConcesionario = $('#txtConcesionario').val();
	
	var txtBPConcesionario = $('#txtBPConcesionario').val();
	
	var strServiciosValues = $('#rpc-services').val();
	var strServicios = JSON.stringify(checkNull(strServiciosValues,''));
	
	var strFET = $('#fet_search').val();
	
	var strCoberturaValues = $('#rpc-estados').val();
	var strCobertura = JSON.stringify(checkNull(strCoberturaValues,''));
	
	var strExpediente = $('#expediente_search').val();
	
	var strEstatusValues = $('#rpc-estatus').val();
	var strEstatus = JSON.stringify(checkNull(strEstatusValues,''));
	
	//var strCanal = $('#canal_search').val();
	var strCanal = '';
	
	var strTipoValues = $('#rpc-tipo').val();
	var strTipo = JSON.stringify(checkNull(strTipoValues,''));
	
	
	var strTipoUsoValues = $('#rpc-tipo-uso').val();
	var strTipoUso = JSON.stringify(checkNull(strTipoUsoValues,''));
	
	var strSateliteValues = $('#rpc-satelites').val();
	var strSatelite = JSON.stringify(checkNull(strSateliteValues,''));
	
	var strPosicionValues = $('#rpc-posiciones').val();
	var strPosicion = JSON.stringify(checkNull(strPosicionValues,''));
     
     
    //var cbComercializadoraChecked = $('#cbComercializadora:checked').val();
    
    var cbOMVChecked = $('#cbOMV:checked').val(); 
     
    var cbRangoFrecuenciasChecked = $('#cbRangoFrecuencias:checked').val();
    
    var slider = $("#rangeFrecuenciaCon").data("ionRangeSlider");
    var strRangoFrom = slider.result.from;
    var strRangoTo = slider.result.to;
    
    if (!cbRangoFrecuenciasChecked) {
    	strRangoFrom = '';
    	strRangoTo = '';
    	strFrecuenciaValues = '';
    }
    
    var strCbComercializadora = "0";
    //if (cbComercializadoraChecked) {
    //	strCbComercializadora = "1";
    //}
    
    var strCbOMV = "0";
    if (cbOMVChecked) {
    	strCbOMV = "1";
    }
    
    var strFrecuenciaValues = $('#rpc-frecuencia').val();
	var strFrecuencia = JSON.stringify(checkNull(strFrecuenciaValues,''));
    
     
    $.fancybox.showLoading();
    
    var json;
    	json = {
    		"txtBPConcesionario": txtBPConcesionario,
    		"strConcesionario": strConcesionario,
    		"strServicios": strServicios,
    		"strFET": strFET,    		
    		"strCobertura": strCobertura,
    		"strExpediente": strExpediente,
    		"strEstatus": strEstatusValues,
    		"strCanal": strCanal,
    		"strTipo": strTipoValues,
    		"strSatelite": strSatelite,
    		"strPosicion": strPosicion,
    		"strRangoSegmentosFrom": strRangoFrom,
    		"strRangoSegmentosTo": strRangoTo,
    		"strTipoUso": strTipoUsoValues,
    		"strFrecuencia": strFrecuenciaValues,
    		"cbComercializadoraChecked" : strCbComercializadora,
    		"cbOMVChecked" : strCbOMV
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
        	$.fancybox.hideLoading();
            $('#divResults').html(data);
            goToByScroll('divResults');
            console.log(reqPage);
        },
        error: function (e) {
        	$.fancybox.hideLoading();
            console.log(e)
        }
    });
    
    
    
}

function cleanConvenios(evt) {
	
	$('#rpc-tipo-convenio').multiselect("deselectAll", false).multiselect("refresh");
	$('#txtConvFecIni').val('');
	$('#txtConvFecFin').val('');
	$('#conv_folio').val('');
	
	$('#conv-source1-bp').val('');
	$('#conv-source2-bp').val('');
	
	$('#conv_operador1_search').typeahead('val', '');
	$('#conv_operador2_search').typeahead('val', '');
		
}

function searchConvenios(evt) {
    evt.preventDefault();

    reqPageO = 'searchConvenios';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var strTiposConveniosValues = $('#rpc-tipo-convenio').val();
	var strTiposConvenios = JSON.stringify(checkNull(strTiposConveniosValues,''));
	
	//var strDescConvenio = $('#convenio_desc_search').val();
	var strDescConvenio = '';
	
	var strConvFecIni = $('#txtConvFecIni').val();
	var strConvFecFin = $('#txtConvFecFin').val();
	var strConvFolio = $('#conv_folio').val();
	
	var txtConvBpSource1 = $('#conv-source1-bp').val();
	var txtConvBpSource2 = $('#conv-source2-bp').val();
    
    var json;
    	json = {
    		"strTiposConvenios": strTiposConvenios,
    		"strDescConvenio": strDescConvenio,
    		"strConvFecIni": strConvFecIni,
    		"strConvFecFin": strConvFecFin,    		
    		"strConvFolio": strConvFolio,
    		"txtConvBpSource1": txtConvBpSource1,
    		"txtConvBpSource2": txtConvBpSource2
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
    
    
    
}



/* contratos de adhesion */
function searchContratosAdhesion(evt) {
    evt.preventDefault();

    reqPageO = 'searchContratosAdhesion';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var txtidBP = $('#cont-source1-bp').val();
	var txtconcesionario = $('#cont_operador1_search').val();
	var txtfechaProfeco = $('#txtContFecProfeco').val();
	var txtfechaIft = $('#txtContFecIft').val();
	var txtfolioProfeco = $('#cont_folio_profeco').val();
	var txtfolioRegistro = $('#cont_folio_ift').val();
	var txtfet = $('#contFet_operador1_search').val();
	var txtnumInscripcionProfeco = '';

    if ((txtidBP==null || txtidBP=='')
        && (txtfechaProfeco==null || txtfechaProfeco=='')
        && (txtfechaIft==null || txtfechaIft=='')
        && (txtfet==null || txtfet=='')
        && (txtfolioProfeco==null || txtfolioProfeco=='')
        && (txtfolioRegistro==null || txtfolioRegistro=='') ) {
    	alert("Especificar algún filtro");
    	return false;
    }
	
    var json;
    	json = {
    		"txtidBP": txtidBP,
    		"txtconcesionario": txtconcesionario,
    		"txtfechaProfeco": txtfechaProfeco,
    		"txtfechaIft": txtfechaIft,    		
    		"txtfolioProfeco": txtfolioProfeco,
    		"txtfolioRegistro": txtfolioRegistro,
    		"txtfet": txtfet,
    		"txtnumInscripcionProfeco": txtnumInscripcionProfeco
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}

function cleanContratosAdhesion(evt) {
	$('#cont_operador1_search').typeahead('val', '');
	$('#cont-source1-bp').val('');
	$('#contFet_operador1_search').typeahead('val', '');
	$('#txtContFecProfeco').val('');
	$('#cont_folio_profeco').val('');
	$('#txtContFecIft').val('');
	$('#cont_folio_ift').val('');
}

/* contratos de adhesion */


/* espacios de publicidad */
function searchEspaciosPublicidad(evt) {
    evt.preventDefault();

    reqPageO = 'searchEspaciosPublicidad';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var txtidBP = $('#espacios-source1-bp').val();
	var txtconcesionario = $('#espacios_operador1_search').val();
	var txtfolioRegistro = $('#espacios_folio_ift').val();
	var txtfet = $('#espaciosFet_operador1_search').val();

	
    var json;
    	json = {
    		"txtidBP": txtidBP,
    		"txtconcesionario": txtconcesionario,
    		"txtfolioRegistro": txtfolioRegistro,
    		"txtfet": txtfet
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}


function cleanEspacios(evt) {
	$('#espacios_folio_ift').val('');
	$('#espacios-source1-bp').val('');
	$('#espacios_operador1_search').typeahead('val', '');
	$('#espaciosFet_operador1_search').typeahead('val', '');
}

/* espacios de publicidad */


/* estructura accionaria */
function searchEstructuraAccionaria(evt) {
    evt.preventDefault();

    reqPageO = 'searchEstructuraAccionaria';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var txtidBP = $('#estructura-source1-bp').val();
	var txtconcesionario = $('#estructura_operador1_search').val();
	var txtfolioRegistro = $('#estructura_folio_ift').val();
	//var txtfet = $('#estructuraFet_operador1_search').val();
	var txtfet = "";

	
    var json;
    	json = {
    		"txtidBP": txtidBP,
    		"txtconcesionario": txtconcesionario,
    		"txtfolioRegistro": txtfolioRegistro,
    		"txtfet": txtfet
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}


function cleanEstructuraAccionaria(evt) {
	$('#estructura_folio_ift').val('');
	
	$('#estructura_operador1_search').typeahead('val', '');
	
	$('#estructura-source1-bp').val('');
	
	//$('#estructuraFet_operador1_search').typeahead('val', '');
}

/* estructura accionaria */


/* codigos de etica */
function searchCodigosEtica(evt) {
    evt.preventDefault();

    reqPageO = 'searchCodigosEtica';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var txtIdBP = $('#codigose-source1-bp').val();
	var txtConcesionario = $('#codigose_operador1_search').val();
	var txtFolioRegistro = $('#codigose_folio_ift').val();
	var txtDistintivo = $('#codigose_distintivo').val();
	var txtFet = $('#codigoseFet_operador1_search').val();

	
    var json;
    	json = {
    		"txtIdBP": txtIdBP,
    		"txtConcesionario": txtConcesionario,
    		"txtFolioRegistro": txtFolioRegistro,
    		"txtDistintivo": txtDistintivo,
    		"txtFet": txtFet
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}


function cleanCodigosEtica(evt) {
	$('#codigose_folio_ift').val('');
	
	//$('#codigose_distintivo').val('');
	
	$('#codigose_distintivo').typeahead('val', '');
	
	$('#codigose_operador1_search').typeahead('val', '');
	
	$('#codigose-source1-bp').val('');
	
	$('#codigoseFet_operador1_search').typeahead('val', '');
}
/* codigos de etica */


/* defensores de audiencias */
function searchDefensoresAudiencia(evt) {
    evt.preventDefault();

    reqPageO = 'searchDefensorAudiencias';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var txtIdBP = $('#defensoresa-source1-bp').val();
	var txtConcesionario = $('#defensoresa_operador1_search').val();
	var txtFolioRegistro = $('#defensoresa_folio_ift').val();
	var txtDefensorHash = $('#defensoresa-hash-defensor').val();
	var txtDistintivo = $('#defensoresa_distintivo').val();
	var txtFet = $('#defensoresaFet_operador1_search').val();
	

	
    var json;
    	json = {
    		"txtIdBP": txtIdBP,
    		"txtConcesionario": txtConcesionario,
    		"txtFolioRegistro": txtFolioRegistro,
    		"txtDefensorHash": txtDefensorHash,
    		"txtDistintivo": txtDistintivo,
    		"txtFet": txtFet
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}


function cleanDefensoresAudiencia(evt) {
	

	$('#defensoresaFet_operador1_search').typeahead('val', '');
	$('#defensoresa_folio_ift').val('');
	$('#defensoresa_distintivo').typeahead('val', '');
	$('#defensoresa-source1-bp').val('');
	$('#defensoresa-hash-defensor').val('');
	$('#defensoresa_operador1_search').typeahead('val', '');
	$('#defensoresa_defensor').typeahead('val', '');
	
	
}
/* defensores de audiencias */


function searchSanciones(evt) {
    evt.preventDefault();

    reqPageO = 'searchSanciones';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	
	//var strDescSancion = $('#sancion_desc_search').val();
	var strDescSancion = "";
	var strBpSancion = $('#txtSancionBp').val();
	
	var strSancionFecIni = $('#txtSancionFecIni').val();
	var strSancionFecFin = $('#txtSancionFecFin').val();
	var strSancionFolio = $('#sancion_folio').val();
	
	var strTipoInformeValue = $('#rpc-tipo-informe').val();
	
	var strBpSancionName = $('#soperador_desc_search').val();
    
    var json;
    	json = {
    		"strDescSancion": strDescSancion,
    		"strBpSancion": strBpSancion,
    		"strSancionFecIni": strSancionFecIni,
    		"strSancionFecFin": strSancionFecFin,    		
    		"strSancionFolio": strSancionFolio,
    		"strTipoInforme": strTipoInformeValue,
    		"strBpSancionName": strBpSancionName
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
    
    
    
}


function displayDetail(evt,idConcesion) {
	evt.preventDefault();
	
	reqPageO = 'viewConcesionDetail';
    reqPage = fixUrl(reqPageO, controllerSearchStr);
	
	$.ajaxSetup ({
        cache: false
    });
    
    var json;
    	json = {
    		"idConcesion": idConcesion
    		};
    
    $.fancybox.showLoading();
    
    $.ajax({
    	type: "POST",
    	data: json,
    	url: reqPage,
    	success: function(data) {
    		if (data!==null) {
    			//console.log(data);
    		}
      		$.fancybox( '<div></div>', {
      			title:'Detalle de la concesión: '+idConcesion,
      			autoSize : true,
      			openEffect:'elastic',
      			openSpeed:'slow',
      			closeEffect:'elastic',
      			closeSpeed:'slow',
      			showCloseButton : false,
      			afterLoad  : function () {
		            $.extend(this, {
		                aspectRatio : false,
		                type    : 'html',
		                width   : '100%',
		                height  : '100%',
		                content : data
		            });
           	}
      			
      			 
      			}
      			 );
    	},
    	error: function () {
			alert('error');
			$.fancybox( '<h1>ERROR Lorem lipsum</h1>' );
			
			//$.fancybox.open(this);
		}
    	
    	
  	});
	
}

function closeFancyBox(evt) {
	evt.preventDefault();
	$.fancybox.close();
}

function goToConveniosSection() {
	event.preventDefault();
	var element = document.getElementById('conveniosSection');
	element.scrollIntoView();
}

function goToSancionesSection() {
	event.preventDefault();
	var element = document.getElementById('sancionesSection');
	element.scrollIntoView();
}


/* puntos de interconexion */
function searchPuntosInt(evt) {
    evt.preventDefault();

    reqPageO = 'searchPuntosDeInterconexion';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var idBP = $('#puntos-source1-bp').val();
	var descripcion = $('#convenio_desc1_search').val();
	var fechaInscripcion = $('#txtPuntosFecInsc').val();
	var folioInscripcion = $('#puntosFolioInsc').val();
    
    var json;
    	json = {
    		"idBP": idBP,
    		"descripcion": descripcion,
    		"fechaInscripcion": fechaInscripcion,
    		"folioInscripcion": folioInscripcion    		
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}
/* puntos de interconexion */

/* Permisos de radiodifusion */

function cleanPermisosRadiodifusion(evt) {
	$('#txtConcesionarioPRP').val('');
	$('#txtBPConcesionarioPRP').val('');
	//$('#rpc-servicesPRP').val('');
	
	$('#rpc-servicesPRP').multiselect("deselectAll", false).multiselect("refresh");
	$('#rpc-estadosPRP').multiselect("deselectAll", false).multiselect("refresh");
	
	$('#fets-remote-searchPRP').typeahead('val', '');
	$('#fet_searchPRP').val('');
	
	$('#expediente_searchPRP').typeahead('val', '');
	
	$('#txtConcesionarioPRP').typeahead('val', '');
	
	//var slider = $("#rangePRP").data("ionRangeSlider");
	//var strServicios = JSON.stringify(checkNull(strServiciosValues,''));
	//var strCobertura = JSON.stringify(checkNull(strCoberturaValues,''));
}

function searchPermisosRadiodifusion(evt) {
    evt.preventDefault();

    reqPageO = 'searchPermisosRadiocomunicacion';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var strConcesionario = $('#txtConcesionarioPRP').val();
	var txtBPConcesionario = $('#txtBPConcesionarioPRP').val();
	var strServiciosValues = $('#rpc-servicesPRP').val();
	var strServicios = JSON.stringify(checkNull(strServiciosValues,''));
	var strFET = $('#fet_searchPRP').val();
	var strCoberturaValues = $('#rpc-estadosPRP').val();
	var strCobertura = JSON.stringify(checkNull(strCoberturaValues,''));
	var strExpediente = $('#expediente_searchPRP').val();
	
	//var strRangoSegmentosValues = $('#rangePRP').val();
	//var strRangoSegmentos = JSON.stringify(checkNull(strRangoSegmentosValues,''));
    
    var slider = $("#rangePRP").data("ionRangeSlider");
    var strRangoFrom = slider.result.from;
    var strRangoTo = slider.result.to; 
    
    if ((txtBPConcesionario==null || txtBPConcesionario=='')
        && (strServiciosValues==null || strServiciosValues=='')
        && (strCoberturaValues==null || strCoberturaValues=='')
        && (strFET==null || strFET=='')
        && (strExpediente==null || strExpediente=='') ) {
    	alert("Especificar algún filtro extra");
    	return false;
    }
    
    var json;
    	json = {
    		"txtBPConcesionario": txtBPConcesionario,
    		"strConcesionario": strConcesionario,
    		"strServicios": strServicios,
    		"strFET": strFET,    		
    		"strCobertura": strCobertura,
    		"strExpediente": strExpediente,
    		"strRangoSegmentosFrom": strRangoFrom,
    		"strRangoSegmentosTo": strRangoTo,
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
    
    
    
}


/* Permisos de radiodifusion */


/* Interconexion Interacional */
function searchIntInternacional(evt) {
    evt.preventDefault();

    reqPageO = 'searchInterconexionInternacional';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

	var idBP = $('#intinternacional-source1-bp').val();
	var idBPExterno = $('#intinternacionalext-source1-bp').val();
	var bp = $('#intinternacional-source1-remote-search').val();
	var externo = $('#intinternacionalext-source1-remote-search').val();
	var fechaInscripcion = $('#txtIntInternacionalFecInsc').val();
	var folioInscripcion = $('#intInternacionalFolioInsc').val();
    
    var json;
    	json = {
    		"idBP": idBP,
    		"idBPExterno": idBPExterno,
    		"bp": bp,
    		"externo": externo,
    		"fecRegistro": fechaInscripcion,
    		"folio": folioInscripcion    		
    		};
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $('#divResults').html(data);
            goToByScroll('divResults');
        },
        error: function (e) {
            console.log(e)
        }
    });
}

function cleanIntInternacional(evt) {
	
	$('#intinternacional-source1-remote-search').typeahead('val', '');
	$('#intinternacional-source1-bp').val('');
	
	$('#intinternacionalext-source1-remote-search').typeahead('val', '');
	$('#intinternacionalext-source1-bp').val('');
	
	$('#txtIntInternacionalFecInsc').val('');
	$('#intInternacionalFolioInsc').val('');
}

/* Interconexion Internacional */

/* Buscador por URL Hash */
$(document).ready(function() {
    var match = window.location.search.match(/[?&]hash=([^&]+)/);
    if (match) {
        var hash = decodeURIComponent(match[1]);
        // Limpiar caracteres no válidos de Base64 (como > de %3E, comillas, etc.)
        hash = hash.replace(/[^A-Za-z0-9+\/=]/g, '');
        try {
            var isBase64 = /^[A-Za-z0-9+/]+={0,2}$/.test(hash) && (hash.length % 4 === 0);
            if (isBase64) {
                var decoded = atob(hash);
                var parts = decoded.split('|');
                if (parts.length >= 2) {
                    var idTramiteControl = parts[0];
                    var idTipoTramite = parts[1];
                    
                    // Cargar Folio de inscripción
                    $('#buscador-folio').val(idTramiteControl);
                    
                    // Cargar Tipo de convenio
                    $('#buscador-id-tipo-tramite').val(idTipoTramite);
                    
                    // Mostrar la pestaña del buscador
                    $('a[href="#buscador"]').tab('show');
                    
                    // Ejecutar búsqueda automáticamente
                    searchBuscador();
                }
            }
        } catch (e) {
            console.error('Error al decodificar el hash del buscador:', e);
        }
    }
});

function searchBuscador(evt) {
    if (evt) evt.preventDefault();

    reqPageO = 'searchBuscador';
    reqPage = fixUrl(reqPageO, controllerSearchStr);

    var idTipoTramite = $('#buscador-id-tipo-tramite').val() || '';
    var strFolio = $('#buscador-folio').val() || '';
    
    var json = {
        "idTipoTramite": idTipoTramite,
        "strFolio": strFolio
    };
    
    $.fancybox.showLoading();
    
    $.ajax({
        url: reqPage, 
        type: 'POST',
        data: json,
        dataType: 'html', 
        success: function (data) {
            $.fancybox.hideLoading();
            $.fancybox(data, {
                title: 'Resultados del Buscador',
                autoSize: true,
                width: '90%',
                height: '90%',
                openEffect: 'elastic',
                closeEffect: 'elastic'
            });
        },
        error: function (e) {
            $.fancybox.hideLoading();
            console.log(e);
        }
    });
}

function cleanBuscador(evt) {
    if (evt) evt.preventDefault();
    $('#buscador-folio').val('');
    $('#buscador-id-tipo-tramite').val('');
}
