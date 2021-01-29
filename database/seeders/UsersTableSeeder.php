<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = [
            'name' => 'Noor Qidam',
            'email' => 'noorqidam@gmail.com',
            'password' => bcrypt('Aguero20')
        ];

        if (!User::where('email', $adminUser['email'])->exists()) {
            User::create($adminUser);
        }
    }
}
