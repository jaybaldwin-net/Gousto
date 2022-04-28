<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    protected $fillable = [
        'name'
    ];
    protected $primaryKey = 'id';

    protected $table = 'orders';

    public $timestamps = false;

    // use SoftDeletes;


    public function ingredients() {
        return $this->hasMany('App\Models\OrderIngredient', 'order_id', 'id');
    }


    public function calculateVolume(){
        return $this->ingredients()->sum('volume');
    }
}
