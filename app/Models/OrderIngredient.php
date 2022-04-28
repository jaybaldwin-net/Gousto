<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderIngredient extends Model {
    protected $fillable = [
        'name',
        'order_id',
        'volume'
    ];
    protected $primaryKey = 'id';

    protected $table = 'order_ingredients';

    public $timestamps = false;

    // use SoftDeletes;
}
