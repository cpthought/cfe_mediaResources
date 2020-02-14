<?php
/* 
 * Common configuration that can be used throughout the application
 * Please refer to DooConfig class in the API doc for a complete list of configurations
 * Access via Singleton, eg. Doo::conf()->BASE_PATH;
 */
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Kuala_Lumpur');

/**
 * for benchmark purpose, call Doo::benchmark() for time used.
 */
//$config['START_TIME'] = microtime(true);


//For framework use. Must be defined. Use full absolute paths and end them with '/'      eg. /var/www/project/

$config['SITE_PATH'] = realpath('..').'/cfe_mediaResources/';
//$config['PROTECTED_FOLDER'] = 'protected/';
$config['BASE_PATH'] = realpath('..').'/dooframework/';

//for production mode use 'prod'
$config['APP_MODE'] = 'dev';

//----------------- optional, if not defined, default settings are optimized for production mode ----------------
//if your root directory is /var/www/ and you place this in a subfolder eg. 'app', define SUBFOLDER = '/app/'

$config['SUBFOLDER'] = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\','/',$config['SITE_PATH']));
if(strpos($config['SUBFOLDER'], '/')!==0){
	$config['SUBFOLDER'] = '/'.$config['SUBFOLDER'];
}

$config['APP_URL'] = 'http://'.$_SERVER['HTTP_HOST'].$config['SUBFOLDER'];
//$config['AUTOROUTE'] = TRUE;
$config['DEBUG_ENABLED'] = TRUE;

//$config['TEMPLATE_COMPILE_ALWAYS'] = TRUE;

//register functions to be used with your template files
//$config['TEMPLATE_GLOBAL_TAGS'] = array('url', 'url2', 'time', 'isset', 'empty');

/**
 * Path to store logs/profiles when using with the logger tool. This is needed for writing log files and using the log viewer tool
 */
//$config['LOG_PATH'] = '/var/logs/';

$config['AUTHKEY']="z685b7q4V8ifR7F9T71eUdH8p9k5i135G6p6C9Mek4m3q7y7Uba2XbXdKfXbr9Af";

//$config['ERROR_404_DOCUMENT'] = 'error.php';
$config['ERROR_404_ROUTE'] = '/error';

define ( "WEB_SITE", "http://mr.hujiao.com" );
define ( "WEB_SITE_GLOBAL", WEB_SITE . "/global/" );
define ( "REAL_PATH", realpath ( '..' ) );
define ( "SITE_PATH", REAL_PATH . "/cfe_mediaResources/" );

include 'js.edition.conf.php';
//$config['pagesize'] = 10;
