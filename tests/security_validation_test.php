<?php

define('BASEPATH', __DIR__);
$testAppPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'vrpc-security-tests' . DIRECTORY_SEPARATOR;
if (!is_dir($testAppPath . 'logs')) {
	mkdir($testAppPath . 'logs', 0777, true);
}
define('APPPATH', $testAppPath);

class CI_Controller {
	public $input;
	public $output;
}

class TestInput {
	private $values;

	public function __construct($values) {
		$this->values = $values;
	}

	public function post($field) {
		return isset($this->values[$field]) ? $this->values[$field] : null;
	}
}

class TestOutput {
	public $status;
	public $body;

	public function set_status_header($status) {
		$this->status = $status;
		return $this;
	}

	public function set_content_type($contentType) {
		return $this;
	}

	public function set_output($body) {
		$this->body = $body;
		return $this;
	}
}

require __DIR__ . '/../application/controllers/RpcSearchController.php';

function assertRejected($method, $values, $description) {
	$reflection = new ReflectionClass('RpcSearchController');
	$controller = $reflection->newInstanceWithoutConstructor();
	$controller->input = new TestInput($values);
	$controller->output = new TestOutput();
	$controller->$method();

	if ($controller->output->status !== 400) {
		fwrite(STDERR, 'FAIL: ' . $description . PHP_EOL);
		exit(1);
	}
}

assertRejected('searchPermisosRadiocomunicacion', array(
	'strServicios' => '["78073941\' or \'4143\'=\'4143"]'
), 'SQL syntax in strServicios must be rejected');

$sancionesPayloads = array(
	'strBpSancion' => "44739663' or 2137=2137--",
	'strDescSancion' => "31105184' or 2385=2385--",
	'strSancionFolio' => "67302023' or '6489'='6489",
	'strTipoInforme' => "29384837' or '7961'='7961"
);

foreach ($sancionesPayloads as $field => $payload) {
	assertRejected('searchSanciones', array($field => $payload), 'SQL syntax in ' . $field . ' must be rejected');
}

echo "Security validation tests passed.\n";
