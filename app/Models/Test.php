<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model {
    protected $fillable = [
        'name'
    ];
    protected $primaryKey = 'id';

    protected $table = 'test_table';

    public $timestamps = false;

    // use SoftDeletes;
}
