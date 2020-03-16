<?php

use Illuminate\Database\Seeder;
use App\Models\User\NearbyAreas;

class NearbyAreasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        collect(['Sólo a mis vecinos',
                 'Sólo en mi barrio',
                 'Sólo en mi ciudad',
                 'Mi ciudad y proximidades',
                ])
            ->each(function ($name) {
                (new NearbyAreas(['name' => $name]))->save();
            });
    }
}
