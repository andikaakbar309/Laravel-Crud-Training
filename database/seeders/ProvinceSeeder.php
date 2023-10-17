<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Province;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::withHeaders([
            'key' => '5a30f98975c2de59fb0f5323d38a416c'
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

    foreach ($provinces as $province) {
            $data_province[] = [
                'id' => $province['province_id'],
                'province' => $province['province'],
            ];
        }

        Province::insert($data_province);
    }
}
