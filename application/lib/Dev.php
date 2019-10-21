<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * 格式化打印
 *
 * @param array|string $str
 * @return void
 */
function debug($str) {
	echo '<pre>';
	var_dump($str);
	echo '</pre>';
	exit;
}

/**
 *@todo: 判断是否为post
 */  
if (!function_exists('is_post')) {
	function is_post()
	{
	   return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' ? true : false;	
	}
}
 
/**
 *@todo: 判断是否为get
 */ 
if (!function_exists('is_get')) {
	function is_get()
	{
	   return strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' ? true : false;
	}
}
 
/**
 *@todo: 判断是否为ajax
 */ 
if (!function_exists('is_ajax')) {
	function is_ajax()
	{
	    return strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST' ? true : false;	
	}
}
 
/**
 *@todo: 判断是否为命令行模式
 */ 
if (!function_exists('is_cli')) {
	function is_cli()
	{
        return (PHP_SAPI === 'cli' OR defined('STDIN'));  
	}
}