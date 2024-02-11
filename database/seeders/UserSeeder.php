<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'perum',
            'name' => 'PT DULOMO PERMAI',
            'email' => 'perum@gmail.com',
            'password' => bcrypt("perum123"),
            'profile' => 'default'
        ]);
        
        User::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'default',
            'name' => 'default',
            'email' => 'default@gmail.com',
            'password' => bcrypt("default"),
            'profile' => 'default'
        ]);

    }
}
