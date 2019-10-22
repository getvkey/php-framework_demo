<?php

class Car
{
    public $name;

    public function run()
    {
        return "在行驶中";
    }
}

class Bus extends Car
{
    public function __construct()
    {
        $this->name = "公交车";
    }
}

class Taxi extends Car{
    public function __construct()
    {
        $this->name = "计程车";
    }
}
$line2 = new Bus;

echo $line2->name . $line2->run();