<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //получаем роли из константы
        $roles = collect(config('constants.db.roles'));
        //получение роль по заданому массиву
        $roles->each(fn ($role) => Role::firstOrCreate(['name' => $role]));
    }
}
