<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = ['mohand', 'mohammed'];

        foreach ($clients as $client) {

            \App\Modeles\Client::create([
                'name' => $client,
                'address' => 'omderman',
                'phone' => ['0912101590']
            ]);
        }
    }
}
