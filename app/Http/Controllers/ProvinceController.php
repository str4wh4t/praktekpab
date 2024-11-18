<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProvinceController extends Controller
{
    //
    public function index()
    {
        //
        $provinces = Province::paginate(10);
        return view('province.index', ['provinces' => $provinces]);
    }

    public function sync_province()
    {
        $client = new Client();
        $err_message = '';

        try {
            // Mengirim request ke API RajaOngkir
            $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
                'headers' => [
                    'key' => env('RAJAONGKIR_KEY'),
                ],
            ]);

            // Mendecode response JSON
            $json = json_decode($response->getBody()->getContents(), true);

            // Menyimpan atau memperbarui data province dari response API
            foreach ($json['rajaongkir']['results'] as $result) {
                Province::updateOrCreate(
                    ['province_id' => $result['province_id']], // Kondisi untuk menentukan apakah record ada
                    [
                        'province_id' => $result['province_id'], // Kolom primary key atau unik
                        'province' => $result['province'],  // Data baru untuk kolom lainnya
                    ]
                );
            }

            // Redirect dengan pesan sukses
            return redirect('/province')->with(
                'status_message',
                ['type' => 'info', 'text' => 'Province synced!']
            );
        } catch (\Exception $e) {
            // Tangkap error dan tampilkan pesan
            $err_message = 'Error: "' . $e->getMessage() . '"';

            return redirect('/province')->with(
                'status_message',
                ['type' => 'danger', 'text' => $err_message]
            );
        }
    }
}
