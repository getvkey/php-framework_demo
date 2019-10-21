<?php

namespace tests;

require_once __DIR__ . '/../vendor/autoload.php';
 
 
use PHPUnit\Framework\TestCase;
 
 
class FirstTest extends TestCase
{
    public function testTure()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));
    }
}