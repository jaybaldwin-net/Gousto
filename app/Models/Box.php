<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model {
    protected $fillable = [
        'name',
        'volume'
    ];
    protected $primaryKey = 'id';

    protected $table = 'boxes';

    public $timestamps = false;

    // use SoftDeletes;
}
