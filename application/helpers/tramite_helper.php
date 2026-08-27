<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* =========================================================
 * TRAMITES PATHS & URL CONFIGURATIONS HELPER
 * ========================================================= */

if (!function_exists('getTramiteConfigs')) {
    function getTramiteConfigs() {
        return array(
            1  => array('folder' => 'contratoadhesion',      'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            2  => array('folder' => 'nombrecomercial',       'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            3  => array('folder' => 'tarifasespacios',       'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            5  => array('folder' => 'avisodomicilio',        'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            8  => array('folder' => 'puntosinterconexion',   'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            12 => array('folder' => 'estructuraaccionaria',  'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            13 => array('folder' => 'estructuraaccionaria',  'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            14 => array('folder' => 'convenios',             'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            15 => array('folder' => 'gravamenes',            'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            16 => array('folder' => 'pdfs',                  'base_url' => URLAPP,                          'is_direct' => true),
            17 => array('folder' => 'convinternacional',     'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            18 => array('folder' => 'contratosArrenFrec',    'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            19 => array('folder' => 'cesionderechos',        'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
            38 => array('folder' => 'estructuraaccionaria',  'base_url' => URLAPPPUBLISHVRPC . 'upload/files/', 'is_direct' => false),
        );
    }
}

if (!function_exists('getTramiteDocumentUrl')) {
    function getTramiteDocumentUrl($idTipoTramite, $documentPdf, $forChecking = false, $tipoDocumento = '') {
        $configs = getTramiteConfigs();
        if (!isset($configs[$idTipoTramite])) {
            return '';
        }

        $config = $configs[$idTipoTramite];
        $folder = $config['folder'];
        $baseUrl = $config['base_url'];
        $isDirect = $config['is_direct'];
        // Caso especial para idTipoTramite 16 y tipo de documento CANCELACION
        $cleanTipoDoc = strtoupper(trim(str_replace(array('Á','É','Í','Ó','Ú','á','é','í','ó','ú'), array('A','E','I','O','U','A','E','I','O','U'), $tipoDocumento)));
        if ($idTipoTramite === 16 && ($cleanTipoDoc === 'CANCELACION' || strtoupper(trim($tipoDocumento)) === 'CANCELACION')) {
            $folder = 'assets/publish/coberturasservicios';
            $baseUrl = URLAPP;
            $isDirect = true;
        }

        if ($isDirect) {
            $path = $baseUrl;
            if ($folder !== '') {
                $path .= rtrim($folder, '/') . '/';
            }
            return $path . $documentPdf;
        } else {
            if ($forChecking) {
                return $baseUrl . $folder . '/' . $documentPdf;
            } else {
                $relativeFilePath = $folder . '/' . $documentPdf;
                $encodedPath = urlencode(base64_encode($relativeFilePath));
                return URLAPPPUBLISHVRPC . 'RpcSearchController/verDocumento?file=' . $encodedPath;
            }
        }
    }
}
