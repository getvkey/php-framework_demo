<?php

namespace application\core;

class View {

	public $path; //路由地址
	public $route; //路由数组
	public $layout = 'default';

	/**
	 * 构造 初始化
	 *
	 * @param array $route 当前匹配到的路由
	 */
	public function __construct(array $route) {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	/**
	 * 渲染前端
	 * ob_start()用来定义下面出现的echo内容不输出到浏览器上，
	 * 而是将内容输出到缓冲区，如果想获得缓冲区的内容，这是就用到下面ob_get_clean()函数。
	 * ob_get_clean()得到当前缓冲区的内容并删除当前输出缓冲区。
	 * 这里把ob_get_clean()函数取回缓冲区的内容值给变量$content。
	 * 后续代码就可用获取的缓冲区内容即$content了。
	 * 
	 *
	 * @param string $title 标题
	 * @param array $vars 参数
	 * @return void
	 */
	public function render($title, $vars = []) {
		extract($vars);
		$path = 'application/views/'.$this->path.'.php';
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'application/views/layouts/'.$this->layout.'.php';
		}
	}

	/**
	 * URL跳转
	 *
	 * @param string $url
	 * @return void
	 */
	public function redirect(string $url) {
		header('location: '.$url);
		exit;
	}

	/**
	 * 返回错误页面
	 *
	 * @param integer $code
	 * @return void
	 */
	public static function errorCode(int $code) {
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit;
	}

	/**
	 * 返回json格式消息
	 *
	 * @param string $status
	 * @param string $message
	 * @return void
	 */
	public function message(string $status, string $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	/**
	 * 返回json格式url地址
	 *
	 * @param string $url
	 * @return void
	 */
	public function location(string $url) {
		exit(json_encode(['url' => $url]));
	}

}	