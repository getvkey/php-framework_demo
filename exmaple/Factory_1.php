<?php

interface IUser
{
    function getName();
}

class User implements IUser
{
    function __construct($id)
    {
        echo $id . PHP_EOL;
    }

    function getName()
    {
        return "Mickiey";
    }
}

class UserFactory
{
    public static function Create($id)
    {
        return new User($id);
    }
}

$uo = UserFactory::Create(1);

echo $uo->getName();