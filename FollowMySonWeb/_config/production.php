<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 'On');

define('URL','http://followmyson.dataminas.com.br');
define('PATH', '/home/httpd/vhosts/dataminas.com.br/subdomains/followmyson/httpdocs');
define('H2O_PATH',PATH . '/_h2o');
define('DIR_CLASSES',PATH . '/_classes');
define('DIR_TEMPLATES',PATH . '/_templates');
define('URL_IMAGES', URL . '/_images');

define('MYSQL_LOCALHOST', 'localhost');
define('MYSQL_USUARIO', 'dataminas_followmyson');
define('MYSQL_SENHA', '1dataminas1');
define('MYSQL_BANCO', 'dataminas_followmyson-master');

define('CODIGO_SEGURANCA', sha1(')!*#(%*#FOllOwMySoNJ!RDSF!%#@%!#@$%'));


$pagina = array();
$config = array(
					'path' => PATH,
					'url_atual' => $_SERVER['REQUEST_URI'],
					'url' => URL,
					'url_images' => URL_IMAGES
				);

$config['title'] = '';

function __autoload($classe) {
	if(is_file(DIR_CLASSES . '/' . $classe . '.php')){
		require_once DIR_CLASSES . '/' . $classe . '.php';
	}
}

function pageNotFound($msg = 'Page not found'){
	header('HTTP/1.0 404 Not Found');
	exit($msg);
}
?>