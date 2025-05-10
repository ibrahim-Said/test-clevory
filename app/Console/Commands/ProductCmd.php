<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProductCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync poducts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response=Http::get("https://fakestoreapi.com/products");
        if($response->successful()){
            foreach($response->collect() as $product)
            {
                Product::updateOrCreate([
                    'id'=>$product['id'],
                ],[
                 'title'=>$product['title'],
                 'description'=>$product['description'],
                 'price'=>$product['price'],
                 'rating_rate'=>$product['rating']['rate'],
                 'rating_count'=>$product['rating']['count'],
                 'category'=>$product['category']   
                ]);
            }
        }
    }
}
