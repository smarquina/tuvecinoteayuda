<?php

use Illuminate\Database\Seeder;
use App\Models\User\UserStatus;

class UserStatusSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        collect(['activo', 'deshabilitado', 'baja'])->each(function ($name) {
            (new UserStatus(['name' => $name]))->save();
        });
    }
}
