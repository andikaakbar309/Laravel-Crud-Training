<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\City;
use Illuminate\Support\Facades\Http;

class ApiRaja extends Controller
{
    public function index(Request $request)
    {
        if($request->origin && $request->destination && $request->weight && $request->courier) {
            $origin = $request->origin;
            $destination = $request->destination;
            $weight = $request->weight;
            $courier = $request->courier;

            $response = Http::asForm()->withHeaders([
                'key' => '5a30f98975c2de59fb0f5323d38a416c'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination, 
                'weight' => $weight,
                'courier' => $courier
            ]);
            
            $cekongkir = $response['rajaongkir']['results'][0]['costs'];
        }
        else {
            $origin = '';
            $destination = '';
            $weight = '';
            $courier = '';
            $cekongkir = null;
        }

        $provinsi = Province::all();
        return view('basic.ongkir', compact('provinsi', 'cekongkir'));
    }

    public function ajax($id)
    {
        $cities = City::where('province_id',$id)->pluck('city_name', 'id');

        return response()->json($cities);
    }
}
