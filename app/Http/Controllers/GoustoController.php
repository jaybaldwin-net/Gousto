<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Order;
use App\Models\OrderIngredient;
use App\Models\Test;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GoustoController extends Controller{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        return view('index');
    }

    public function init(){
        $box_content = file_get_contents(storage_path('boxes.json'));
        $box_content = json_decode($box_content, true);

        foreach($box_content as $box_item){
            $box = new Box();
            $box->name = $box_item['name'];
            $box->volume = $box_item['dimensions']['widthMm'] * $box_item['dimensions']['heightMm'] * $box_item['dimensions']['depthMm'];
            $box->co2 = $box_item['co2FootprintKg'];
            $box->save();
        }

        $order_content = file_get_contents(storage_path('orders.json'));
        $order_content = json_decode($order_content, true);

        foreach($order_content as $order_item){

            $order = new Order();
            $order->name = $order_item['id'];
            $order->save();

            foreach($order_item['ingredients'] as $ingredient){
                $order_ingredient = new OrderIngredient();
                $order_ingredient->order_id = $order->id;
                $order_ingredient->name = $ingredient['name'];
                $order_ingredient->volume = $ingredient['volumeCm3'] * 1000;
                $order_ingredient->save();
            }
        }
    }
    public function calculate(){
        $orders = Order::all();

        $co2 = 0;

        $order_output = [];

        foreach($orders as $order){
            $order_volume = $order->calculateVolume();
            $best_box = Box::where('volume', '>=', $order_volume)
                ->orderBy('volume', 'asc')
                ->first();
            if(!isset($best_box->id)){
                return ['success' => false, 'message' => 'No box found for order: ' . $order->name];
            }
            $co2 += $best_box->co2;
            $order_output[] = [
                'order_id' => $order->id,
                'target_box' => $best_box->name
            ];
        }

        return ['success' => true, 'output' => $order_output, 'co2' => $co2];
    }
}
