<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Okn extends Model
{
    protected $table = 'okn';

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
