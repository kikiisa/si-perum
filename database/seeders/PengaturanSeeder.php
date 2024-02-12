<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaturan::create([
            "title" => "SI-PERUM",
            "subtitle" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel, inventore soluta consequuntur laudantium quasi vero earum nobis facere? Quia ipsam ut neque vitae assumenda molestias asperiores quasi maxime temporibus incidunt.",
            "email" => "perkim@gmail.com",
            "phone" => "085932961131",
            "address" => "Jl. Cempaka No. 2",
            "deskripsi" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dolores corrupti rerum iste fuga sapiente similique ratione magnam voluptatum, odit aspernatur, optio labore officia! Accusamus architecto quisquam nobis quod error deserunt? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Libero laboriosam, veritatis maxime laudantium sit provident. Culpa in architecto quas? Ducimus eligendi delectus nemo, id assumenda facilis odio aliquid et architecto.",
            "logo" => "default",
            "strukture" => "default"
        ]);
    }
}
