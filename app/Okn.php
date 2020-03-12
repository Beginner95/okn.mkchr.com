<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Okn extends Model
{
    protected $table = 'okn';

    public function complex()
    {
        return $this->belongsTo(self::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function getFindByName($name)
    {
        return self::where('name', $name)->first();
    }
}
