<?php 

namespace App\Models;

class Roles
{
    public const ROLES = 
    [
        'customer' => 1,
        'specialist' => 2,
    ];

    public static function getNameOfNum(int $num)
    {
        return array_search($num, Roles::ROLES);
    }
}