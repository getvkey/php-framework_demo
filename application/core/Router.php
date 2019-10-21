<?php

namespace application\core;

use application\core\View;

class Router {

    protected $routes = []; //路由正则
    protected $params = []; //匹配到的当前路由

    /**
     * 获取配置文件url路由数组参数
     */
    public function __construct() {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    /**
     * 加入路由匹配规则
     *
     * @param string $route 路由url链接 前后拼接为正则语句 精确匹配
     * @param array $params 实际控制器/方法名称 不用加 Controller和Action
     * @return void
     */
    public function add(string $route, array $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * 取得当前url路径 判断与路由配置是否匹配
     * @return bool
     */
    public function match() {
        // /account/register trim参数2删除指定字符
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * 程序入口 判断是否匹配到路由
     * ucfirst 首字母转换成大写
     * 检查类名/方法名是否定义
     * 调用类 匹配到进入控制器基类构造方法
     *
     * @return void
     */
    public function run(){
        if ($this->match()) {
            $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            //检查类是否存在
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                //检查类的方法是否存在
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

}