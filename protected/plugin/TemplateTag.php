<?php

// register global/PHP functions to be used with your template files
// You can move this to common.conf.php $config['TEMPLATE_GLOBAL_TAGS'] = array('isset', 'empty');
// Every public static methods in TemplateTag class (or tag classes from modules) are available in templates without the need to define in TEMPLATE_GLOBAL_TAGS
Doo::conf ()->TEMPLATE_GLOBAL_TAGS = array (
		'upper',
		'tofloat',
		'sample_with_args',
		'debug',
		'url',
		'url2',
		'function_deny',
		'isset',
		'empty',
		'make_date',
		'inarray',
		'ascriptionQuantity',
		'isInvoiceMoldShow'
);


/**
 * 判断发票的审批权限
 * @param number $sid 用户ID
 * @param string $mold 项目类型
 * @return boolean
 */
function isInvoiceMoldShow($sid = 0, $mold = '') {
	if (! empty ( $sid ) && ! empty ( $mold )) {
		Doo::loadModel ( "invoiceManage" );
		$invoiceManage = new invoiceManage ();
		$imList = $invoiceManage->getInvoiceByMold ( $mold );
		$list = array ();
		foreach ( $imList ['staffList'] as $k => $v ) {
			array_push ( $list, $v [0] );
		}

		return inarray ( $sid, $list );
	} else
		return false;
}

/**
 * Define as class (optional)
 * class TemplateTag { public static test(){} public static test2(){} }
 */
function ascriptionQuantity($cid) {
	Doo::loadModel ( 'invoiceReceivables' );
	$invoiceReceivables = new invoiceReceivables ();
	
	$receivables = $receivablesList = $invoiceReceivables->getInvoiceReceivablesByClaim ( $cid );
	
	$quantity1 = count ( $receivables['csClaim'] );
	$quantity2 = count ( $receivables['sClaim'] );
	
	return $quantity1+$quantity2;
}
function inarray($v1, $v2) {
	return in_array ( $v1, $v2 );
}
function make_date() {
	return date ( "Y-m" );
}
function upper($str) {
	return strtoupper ( $str );
}
function tofloat($str) {
	return sprintf ( "%.2f", $str );
}
function sample_with_args($str, $prefix) {
	return $str . ' with args: ' . $prefix;
}
function debug($var) {
	if (! empty ( $var )) {
		echo '<pre>';
		print_r ( $var );
		echo '</pre>';
	}
}

// This will be called when a function NOT Registered is used in IF or ElseIF statment
function function_deny($var = null) {
	echo '<span style="color:#ff0000;">Function denied in IF or ElseIF statement!</span>';
	exit ();
}

// Build URL based on route id
function url($id, $param = null, $addRootUrl = false) {
	Doo::loadHelper ( 'DooUrlBuilder' );
	// param pass in as string with format
	// 'param1=>this_is_my_value, param2=>something_here'
	
	if ($param != null) {
		$param = explode ( ', ', $param );
		$param2 = null;
		foreach ( $param as $p ) {
			$splited = explode ( '=>', $p );
			$param2 [$splited [0]] = $splited [1];
		}
		return DooUrlBuilder::url ( $id, $param2, $addRootUrl );
	}
	
	return DooUrlBuilder::url ( $id, null, $addRootUrl );
}

// Build URL based on controller and method name
function url2($controller, $method, $param = null, $addRootUrl = false) {
	Doo::loadHelper ( 'DooUrlBuilder' );
	// param pass in as string with format
	// 'param1=>this_is_my_value, param2=>something_here'
	
	if ($param != null) {
		$param = explode ( ', ', $param );
		$param2 = null;
		foreach ( $param as $p ) {
			$splited = explode ( '=>', $p );
			$param2 [$splited [0]] = $splited [1];
		}
		return DooUrlBuilder::url2 ( $controller, $method, $param2, $addRootUrl );
	}
	
	return DooUrlBuilder::url2 ( $controller, $method, null, $addRootUrl );
}

?>