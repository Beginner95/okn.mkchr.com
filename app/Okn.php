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

    public function getCountObjectInComplex($id)
    {
        $objects = self::where('complex_id', $id)->get();
        return $objects->count();
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
