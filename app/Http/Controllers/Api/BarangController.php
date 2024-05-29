<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $fileName = $request->image->hashName();
            $request->file('image')->storeAs('public/posts', $fileName);
            $data['image'] = $fileName;
        }
    
        $barang = BarangModel::create($data);
        return response()->json($barang, 201);
    }
    
    public function show($barang)
    {
        $barang = BarangModel::where('barang_id', $barang)->first();
    
        if (!$barang) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        return response()->json($barang, 200);
    }
    

    public function update(Request $request, BarangModel $barang){
        dd($request->image->hashName());
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->hashName();
            $request->image->store('posts');
        }
        $barang->update([
            'kategori_id' => $request->kategori_id ? $request->kategori_id : $barang->kategori_id,
            'barang_nama' => $request->barang_nama ? $request->barang_nama : $barang->barang_nama,
            'barang_kode' => $request->barang_kode ? $request->barang_kode : $barang->barang_kode,
            'harga_beli' => $request->harga_beli ? $request->harga_beli : $barang->harga_beli,
            'harga_jual' => $request->harga_jual ? $request->harga_jual : $barang->harga_jual,
            'image' => $data['image']
        ]);
        return $barang;
    }

    public function destroy(BarangModel $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus'
        ]);
    }
}