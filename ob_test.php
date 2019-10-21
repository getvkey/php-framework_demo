<?php

$vars = [
    'news' => [
        ['title' => 'dsdsdsdsdsdsd1', 'contents' => 'dsdsdsdsdsdsdsd1'],
        ['title' => 'dsdsdsdsdsdsd2', 'contents' => 'dsdsdsdsdsdsdsd2'],
        ['title' => 'dsdsdsdsdsdsd3', 'contents' => 'dsdsdsdsdsdsdsd3'],
        ['title' => 'dsdsdsdsdsdsd4', 'contents' => 'dsdsdsdsdsdsdsd4'],
        ['title' => 'dsdsdsdsdsdsd5', 'contents' => 'dsdsdsdsdsdsdsd5']
    ]
];

extract($vars);

$path = "inc_test.php";
ob_start();

require $path; //此处为NewsList前端页面 ob存放缓冲区
$content = ob_get_clean(); //获取缓冲区内容赋给变量 并删除缓冲区

require "header_test.php"; //此处为layouts前端页面
print_r($tt);