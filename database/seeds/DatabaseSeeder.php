<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(UserStatusSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(NearbyAreasSeeder::class);
        $this->call(ActivityAreasSeeder::class);
    }
}
