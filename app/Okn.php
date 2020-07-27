<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $name_chr
 * @property int $isComplex
 * @property string $date_okn
 * @property string $act
 * @property int $district_id
 * @property string $address
 * @property string $category
 * @property string $owner
 * @property string $latitude
 * @property string $longitude
 * @property string $comment
 * @property string $file
 */

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
