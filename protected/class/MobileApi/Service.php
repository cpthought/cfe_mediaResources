<?php

Doo::loadClass ( "MobileApi/nusoap" );

$server = new soap_server ();
$server->configureWSDL ( 'CLDwsdl', 'urn:CLDwsdl' );

$server->register ( 'register', // method name  
array ('username' => 'xsd:string', 'game_id' => 'xsd:int', 'fromurl' => 'xsd:string', 'advertiser' => 'xsd:string', 'adFrom' => 'xsd:string', 'adType' => 'xsd:string', 'pageName' => 'xsd:string', 'wordid' => 'xsd:string', 'ip' => 'xsd:string', 'registertime' => 'xsd:time' ), // input parameters  
array ('return' => 'xsd:array' ), // output parameters  
'urn:registerwsdl', // namespace  
'urn:registerwsdl#register', // soapaction  
'rpc', // style  
'encoded' );// use;

$server->register ( 'login',
array ('user' => 'xsd:string', 'pw' => 'xsd:string'),
array ('return' => 'xsd:array' ), 
'urn:loginwsdl', 
'urn:loginwsdl#login',
'rpc',
'encoded' );

function login($user, $pw) {
	return array('status'=>1,'msg'=>'登陆成功','userList'=>array());
}

function register($username, $game_id, $fromurl, $advertiser, $adFrom, $adType, $pageName, $wordid, $ip, $registertime) {
	$param = array ('tg_account' => $username, 'tg_gameID' => $game_id, 'tg_advertiser' => $advertiser, 'tg_adFrom' => $adFrom, 'tg_pageParam' => $fromurl, 'tg_adType' => $adType, //'tg_pageName' => $pagename, 
	'tg_adsID' => $wordid, 'tg_ip' => $ip, 'tg_registerTime' => $registertime );
	return $param;
}
// Use the request to (try to) invoke the service  
$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
$server->service ( $HTTP_RAW_POST_DATA );

?>