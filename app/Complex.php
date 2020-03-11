<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    protected $table = 'complex';

    public function getFindByName($name)
    {
        return self::where('name', $name)->first();
    }
}
