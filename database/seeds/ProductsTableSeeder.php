<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['product1', 'product2', 'product3'];

        foreach ($products as $product) {
            \App\Modeles\Product::create([
                'ar' => ['name' => $product . '-ar', 'desc' => $product . '-ar-desc'],
                'en' => ['name' => $product . '-en', 'desc' => $product . '-en-desc'],
                'category_id' => '1',
                'purches_price' => '100',
                'sale_price' => '101',
                'stock' => '100',
            ]);
        }
    }
}
