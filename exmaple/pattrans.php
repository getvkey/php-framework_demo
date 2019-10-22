<?php

class Person
{
    private $name = "Mickiey";

    public function getName()
    {
        return $this->name;
    }
}

class Student
{
    public function __construct(Person $person)
    {
        echo $person->getName();
    }
}

$stu = new Student(new Person);

// print_r($stu);