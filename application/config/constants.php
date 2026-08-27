<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/* =========================================================
 * ENVIRONMENT VARIABLES
 * ========================================================= */

$domain = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? '');

/* Base URL por defecto (producción) */
$hostInfo = 'https://rpc.ift.org.mx/vrpc/';
$hostSert = 'https://sert.ift.org.mx/';
$hostTarifas = 'https://tarifas.ift.org.mx/';
$ipws = 'http://172.17.41.204:9001/';
/* Detectar entorno */
if (stripos($domain, 'dev') !== false) {
    $hostInfo = 'https://rpcdev.crt.gob.mx/vrpc/';
    $hostSert = 'https://sertdev.ift.org.mx/';
    $hostTarifas = 'https://tarifasdev.ift.org.mx/';
    $ipws = 'http://172.17.41.204:9001/CftRtServices/CftRtServices';
} elseif (stripos($domain, 'crt') !== false) {
    $hostInfo = 'https://rpc.crt.gob.mx/vrpc/';
    $hostSert = 'https://sertqa.ift.org.mx/';
    $hostTarifas = 'https://tarifasqa.ift.org.mx/';
    $ipws = 'http://172.17.42.125:9001/CftRtServices/CftRtServices';
} elseif (stripos($domain, 'qa') !== false) {
    $hostInfo = 'https://rpcqa.crt.gob.mx/vrpc/';
    $hostSert = 'https://sertqa.ift.org.mx/';
    $hostTarifas = 'https://tarifasqa.ift.org.mx/';
    $ipws = 'http://172.17.42.125:9001/CftRtServices/CftRtServices';
} elseif (stripos($domain, 'uat') !== false) {
    $hostInfo = 'https://rpc-uat.crt.gob.mx/vrpc/';
    $hostSert = 'https://sertqa.ift.org.mx/';
    $hostTarifas = 'https://tarifasqa.ift.org.mx/';
    $ipws = 'http://172.17.42.125:9003/CftRtServicesUAT/CftRtServices';
} elseif (stripos($domain, 'vrpclocal') !== false) {
    $hostInfo = 'http://vrpclocal.ift.org.mx/';
    $hostSert = 'https://sertdev.ift.org.mx/';
    $hostTarifas = 'https://tarifasqa.ift.org.mx/';
    $ipws = 'http://172.17.42.113:9001/CftRtServices/CftRtServices';
} elseif (stripos($domain, 'localhost') !== false) {
    $hostInfo = 'http://localhost:8080/VRPC/';
    $hostSert = 'https://sertdev.ift.org.mx/';
    $hostTarifas = 'https://tarifasqa.ift.org.mx/';
    $ipws = 'http://172.17.42.113:9001/CftRtServices/CftRtServices';
}



/* environment variables */
defined('URLAPPPUBLISHVRPC')      OR define('URLAPPPUBLISHVRPC', $hostInfo);
defined('URLAPP')      OR define('URLAPP', $hostInfo);
defined('URLASSETS')      OR define('URLASSETS', URLAPPPUBLISHVRPC.'assets/');

defined('URLSEARCHWS')      OR define('URLSEARCHWS', $ipws);
#defined('URLAPPVISORSERT')      OR define('URLAPPVISORSERT', 'https://rpc.ift.org.mx/ift_visor/');
defined('URLAPPVISORSERT')      OR define('URLAPPVISORSERT', $hostTarifas.'/ift_visor/');


defined('URLASSETSMODELOSINT')      OR define('URLASSETSMODELOSINT', URLAPPPUBLISHVRPC.'assets/publish/modelointerconexion/');
defined('URLASSETSESPACIOS')      OR define('URLASSETSESPACIOS', URLAPPPUBLISHVRPC.'assets/publish/tarifasespacios/');
defined('URLASSETSESTRUCTURA')      OR define('URLASSETSESTRUCTURA', URLAPPPUBLISHVRPC.'assets/publish/estructuraaccionaria/');
defined('URLASSETSINTERNACIONAL')      OR define('URLASSETSINTERNACIONAL', URLAPPPUBLISHVRPC.'assets/publish/convinternacional/');
defined('URLASSETSEMBARGOS')      OR define('URLASSETSEMBARGOS', URLAPPPUBLISHVRPC.'assets/publish/gravamenes/');
defined('URLASSETSCRUCES')      OR define('URLASSETSCRUCES', URLAPPPUBLISHVRPC.'assets/publish/crucesfronterizos/');
defined('URLASSETSCODIGOS')      OR define('URLASSETSCODIGOS', URLAPPPUBLISHVRPC.'assets/publish/codigoetica/');
defined('URLASSETSDEFENSORESA')      OR define('URLASSETSDEFENSORESA', URLAPPPUBLISHVRPC.'assets/publish/defensoresaudiencia/');
defined('URLASSETSOFERTAS')      OR define('URLASSETSOFERTAS', URLAPPPUBLISHVRPC.'assets/publish/ofertapublica/');
defined('URLASSETSOFERTAP')      OR define('URLASSETSOFERTAP', URLAPPPUBLISHVRPC.'assets/publish/ofertapublica/');
defined('URLASSETSDONACIONES')      OR define('URLASSETSDONACIONES', $hostSert.'/tarifasrpc/assets/publish/criteriosadoptados/');
defined('URLASSETSEXCHINT') OR define('URLASSETSEXCHINT', URLAPPPUBLISHVRPC.'assets/publish/');
defined('URLASSETSPLANESTECNICOS')      OR define('URLASSETSPLANESTECNICOS',URLAPPPUBLISHVRPC.'assets/publish/planesTecnicosFundamentales/');
defined('URLASSETSCONSULTASPUBLICAS')      OR define('URLASSETSCONSULTASPUBLICAS', URLAPPPUBLISHVRPC.'/assets/publish/consultaspublicas/');

defined('URLASSETSCNA')      OR define('URLASSETSCNA', URLAPPPUBLISHVRPC.'/assets/publish/cuadronacional/');
