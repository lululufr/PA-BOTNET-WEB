<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->lastname = 'bot';
        $user->firstname = 'net';
        $user->email = 'serviceuser@bot.net';
        $user->password = bcrypt('grandsexeayannis');
        $user->role = 'admin';
        $user->save();
    }

}
