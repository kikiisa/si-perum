<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operator::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'operator',
            'name' => 'Operator',
            'email' => 'operator@gmail',
            'password' => bcrypt("operator123"),
        ]);
    }
}
