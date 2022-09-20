<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class Adminseeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'mimin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin123'),
        ]);
    }
}
