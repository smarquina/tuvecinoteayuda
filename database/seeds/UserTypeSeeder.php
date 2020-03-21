<?php

use Illuminate\Database\Seeder;
use App\Models\User\UserType;

class UserTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        collect(['Solicitante', 'Voluntario', 'Entidad', 'Coordinador Regional'])->each(function ($name) {
            (new UserType(['name' => $name]))->save();
        });
    }
}
