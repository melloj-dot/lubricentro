<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard_stats(){

        $customers_count = count( Customer::all());

        $vehicle_count = count( Vehicle::all());

        $intervention_count = count( Intervention::all());

        $product_count = count( Product::all());

        $product_count_money = 0;

        $products = Product::all();

        foreach ($products as $p) { // bucle para recorrer todos los productos y sumar al total la cantidad de dinero x cada prod
            $product_count_money += ($p->price) * ($p->stock_quantity);
        }

        $total_sales_count = count(Sale::all());

        $total_sale_money = Sale::sum('total_price');



        // $materials_amount_money = Material::sum('total');

        return view('dashboard',compact('customers_count','vehicle_count','intervention_count'
        ,'product_count','product_count_money','total_sales_count','total_sale_money'));
    }
}
