<?php

namespace application\core;

use application\core\View;

abstract class Controller {

	public $route;
	public $view;
	public $acl;

	/**
	 * 构造 初始化
	 *
	 * @param array $route 当前匹配到的路由
	 */
	public function __construct(array $route) {
		$this->route = $route;
		if (!$this->checkAcl()) {
			View::errorCode(403);
		}
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
	}

	/**
	 * 加载模型
	 *
	 * @param string $name
	 * @return void
	 */
	public function loadModel(string $name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	/**
	 * 权限检测
	 * 不同用户类型权限不同
	 *
	 * @return void
	 */
	public function checkAcl() {
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if ($this->isAcl('all')) {
			return true;
		} elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
			return true;
		} elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
			return true;
		} elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
			return true;
		}

		return false;
	} 

	/**
	 * 判断当前控制器方法是否在权限范围内
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function isAcl(string $key) {
		return in_array($this->route['action'], $this->acl[$key]);
	}

}