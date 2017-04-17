<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('default_socket_timeout', -1);
ini_set('gd.jpeg_ignore_warning', 1); //por causa disso: "imagecreatefromstring(): gd-jpeg, libjpeg: recoverable error: Invalid SOS parameters for sequential JPEG"

/*
 * SECURITY
 */
const ACCESS_ORIGIN = "*";

$slim_debug = false;
if (getenv('SLIM_DEBUG') == 'true') $slim_debug = true;

$slimSettings = array(
	'debug' => $slim_debug,
	'mode' => getenv('SLIM_MODE'),

	'cookies.encrypt' => true,
	'cookies.secret_key' => '(%kCUFa9WLl5glaöpóDEr†',
	'cookies.cipher' => MCRYPT_RIJNDAEL_256,
	'cookies.cipher_mode' => MCRYPT_MODE_CBC
);
