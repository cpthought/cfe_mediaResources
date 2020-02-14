<?php
/**
 * 获取get或者POST值
 * @param string $name 属性名称
 * @return fixed 值
 */
function get_args($name) {
    if (isset ( $_GET [$name] )) {
        if (is_array ( $_GET [$name] ))
            return $_GET [$name];
        else {
            return addslashes ( $_GET [$name] );
        }
    } elseif (isset ( $_POST [$name] )) {
        if (is_array ( $_POST [$name] ))
            return $_POST [$name];
        else {
            return addslashes ( $_POST [$name] );
        }
    } else {
        return false;
    }
}

function _GetFileEXT($filename) {
    $pics = explode ( '.', $filename );
    $num = count ( $pics );
    return $pics [$num - 1];
}
 

?>