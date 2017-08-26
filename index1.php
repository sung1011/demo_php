<?php
class fw
{
    function __get($k)
    {
        return new $k;
    }
}
class user extends fw
{

}

class pve extends fw
{

}

class arena extends fw
{
    public $rank = 10;

}

$user = new user;//getapp->getUser();
$arena = $user->pve->arena;
echo $arena->rank -= 2;
