<?php

use Illuminate\Database\Seeder;
use App\Models\User\ActivityAreas;

class ActivityAreasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        collect(['Local',
                 'Provincial',
                 'Nacional',
                ])
            ->each(function ($name) {
                (new ActivityAreas(['name' => $name]))->save();
            });
    }
}
