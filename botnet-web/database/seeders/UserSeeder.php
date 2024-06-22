<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{


    public function run(): void
    {

        //si l'utilisateur serviceuser existe alors on le supprime
        if (Schema::hasTable('users')) {
            User::where('email', 'serviceuser@bot.net')->delete();
        }

        $user = new User();
        $user->lastname = 'bot';
        $user->firstname = 'net';
        $user->email = 'serviceuser@bot.net';
        $user->password = bcrypt('grandsexeayannis');
        $user->role = 'admin';
        $user->save();
    }

}
