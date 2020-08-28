<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 * @property string $name
 */
class District extends Model
{
    protected $table = 'district';
}
