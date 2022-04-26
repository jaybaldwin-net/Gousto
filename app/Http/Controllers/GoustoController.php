<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GoustoController extends Controller{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function helloWorld(){
        return view('hello_world');
    }
}
