<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produks = Produk::paginate(10);
        return view('produk.index', ['produks' => $produks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        if ($data['image_url']) {
            $data['image_url'] =
                $request->file('image_url')->store('assets/produk', 'public');
        } else {
            $data['image_url'] = '';
        }
        Produk::create($data);
        return redirect('/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $produk = Produk::find($id);
        return view('produk.edit', ['produk' => $produk]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        if (isset($data['image_url'])) {
            if ($data['image_url']) {
                $data['image_url'] =
                    $request->file('image_url')->store('assets/produk', 'public');
            }
        }
        $produk = Produk::find($id);
        if ($produk->image_url != '')
            unlink(storage_path('app/public/' . $produk->image_url));
        $produk->update($data);
        return redirect('/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produk = Produk::find($id);
        if ($produk->image_url != '') unlink(storage_path('app/public/' . $produk->image_url));
        $produk->delete();
        return redirect('/produk');
    }

    public function destroy_image($id)
    {
        $produk = Produk::find($id);
        unlink(storage_path('app/public/' . $produk->image_url));
        $produk->image_url = '';
        $produk->save();
        return redirect('/produk/edit/' . $id);
    }
}
