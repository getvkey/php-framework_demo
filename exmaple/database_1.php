<?php

// use PDO;

class Database
{
    // 声明$instance为私有静态类型，用于保存当前实例化后的对象
    private static $instance = null;

    // 数据库连接句柄
    private $db = null;

    // 构造方法声明为私有方法，禁止外部程序使用new实例化，只能内部new
    private function __construct($dbConfig = array())
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s;', $dbConfig['db_host'], $dbConfig['db_name']);
        $this->db = new PDO($dsn, $dbConfig['db_user'], $dbConfig['db_pass']);
    }

    // 这是获取当前类对象的唯一方式
    public static function getInstance($dbConfig = array())
    {
        if (self::$instance == null) {
            self::$instance = new self($dbConfig);
        }

        return self::$instance;
    }

    // 获取数据库句柄方法
    public function db()
    {
        return $this->db;
    }

    // 声明私有方法，禁止克隆对象
    private function __clone(){}

    // 声明成私有方法，禁止重建对象
    private function __wakeup(){}

    public function query(string $sql)
    {
        // return $this->db->query($sql)->fetch();
        return $this->db->query($sql)->fetchAll();
    }
}

$dbConfig = [
    'db_host' => '127.0.0.1',
    'db_name' => 'demo2',
    'db_user' => 'root',
    'db_pass' => '123456'
];

/* $db = new Database($dbConfig);
var_dump($db);
$db2 = new Database($dbConfig);
var_dump($db2);
$db3 = new Database($dbConfig);
var_dump($db3); */

$db = Database::getInstance($dbConfig);
var_dump($db);
$db2 = Database::getInstance($dbConfig);
var_dump($db2);
$db3 = Database::getInstance($dbConfig);
var_dump($db3);