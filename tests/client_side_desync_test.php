<?php

$configuration = file_get_contents(__DIR__ . '/../.htaccess');
$requiredDirectives = array(
	'RewriteCond %{REQUEST_METHOD} !^(GET|HEAD)$ [NC]',
	'RewriteRule ^assets/ - [E=nokeepalive:1,E=CLOSE_STATIC_REQUEST:1]',
	'RewriteRule ^assets/ - [R=405,L]',
	'Header always set Connection "close" env=CLOSE_STATIC_REQUEST'
);

foreach ($requiredDirectives as $directive) {
	if (strpos($configuration, $directive) === false) {
		fwrite(STDERR, 'Missing client-side desync protection: ' . $directive . PHP_EOL);
		exit(1);
	}
}

$methodGuard = strpos($configuration, $requiredDirectives[0]);
$assetGuard = strpos($configuration, $requiredDirectives[1]);
$applicationRewrite = strpos($configuration, 'RewriteCond %{REQUEST_FILENAME} !-f');
if ($methodGuard > $assetGuard || $assetGuard > $applicationRewrite) {
	fwrite(STDERR, "Client-side desync protection must run before application routing.\n");
	exit(1);
}

echo "Client-side desync configuration test passed.\n";
