<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CityController extends Controller
{
    //
    public function index()
    {
        //
        $cities = City::paginate(10);
        return view('city.index', ['cities' => $cities]);
    }

    public function sync_city()
    {
        $client = new Client();
        $err_message = '';

        try {
            // Mengirim request ke API RajaOngkir
            $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
                'headers' => [
                    'key' => env('RAJAONGKIR_KEY'),
                ],
            ]);

            // Mendecode response JSON
            $json = json_decode($response->getBody()->getContents(), true);

            // dd($json);

            foreach ($json['rajaongkir']['results'] as $result) {
                City::updateOrCreate(
                    ['city_id' => $result['city_id']], // Kondisi untuk menentukan apakah record ada
                    [
                        'city_id' => $result['city_id'],
                        'province_id' => $result['province_id'], // Kolom primary key atau unik
                        'province' => $result['province'],  // Data baru untuk kolom lainnya
                        'type' => $result['type'],
                        'city_name' => $result['city_name'],
                        'postal_code' => $result['postal_code'],
                    ]
                );
            }

            // Redirect dengan pesan sukses
            return redirect('/city')->with(
                'status_message',
                ['type' => 'info', 'text' => 'City synced!']
            );
        } catch (\Exception $e) {
            // Tangkap error dan tampilkan pesan
            $err_message = 'Error: "' . $e->getMessage() . '"';

            return redirect('/city')->with(
                'status_message',
                ['type' => 'danger', 'text' => $err_message]
            );
        }
    }
}
