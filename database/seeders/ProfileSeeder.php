<?php

namespace Database\Seeders;

use App\Models\ProfilePemetaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfilePemetaan::create([
            'uuid' => Uuid::uuid4()->toString(),
            'user_id' => 1,
            'nama_perumahan' => 'Nama Perumahan 1',
            'alamat_perumahan' => 'Alamat Perumahan 1',
            'deskripsi' => 'Deskripsi Perumahan 1',
            'luas_lahan' => 5000,
            'longitude' => '123.050161666728',
            'latitude' => '0.5636571324883441',
            'izin_lingkungan_setempat' => 'Izin Lingkungan 1',
            'rutr' => 'RUTR 1',
            'izin_pemanfaatan_tanah' => 'Izin Pemanfaatan Tanah 1',
            'izin_prinsip' => 'Izin Prinsip 1',
            'izin_lokasi' => 'Izin Lokasi 1',
            'izin_badan_lingkungan_hidup' => 'Izin Lingkungan Hidup 1',
            'izin_dampak_lalu_lintas' => 'Izin Dampak Lalu Lintas 1',
            'status' => 'pending',
            'note' => 'Catatan 1',
            'profile' => 'default'
        ]);
    }
}
