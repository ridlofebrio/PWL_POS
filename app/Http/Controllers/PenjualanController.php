<?php
namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\select;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan'
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('penjualan.index', compact('breadcrumb', 'page', 'activeMenu', 'user'));
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'penjual_code', 'penjualan_tanggal', 'user_id', 'pembeli')->with('detail', 'user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm mr-2">Detail</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field()
                    . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>'
                    . '</form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $penjualan_detail = PenjualanDetailModel::where('penjualan_id', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan';

        $total = 0;
        foreach ($penjualan_detail as $dt) {
            $total += $dt->jumlah * $dt->harga;
        }

        return view('penjualan.show', compact('breadcrumb', 'page', 'activeMenu', 'penjualan', 'penjualan_detail', 'total'));
    }

    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);

        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terikat dengan data ini');
        }
    }

    public function create(){
        $breadcrumb =(object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home','Penjualan','Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Transaksi',
        ];
        $barang = barangModel::all();
        $user = UserModel::all();

        $activeMenu = 'Stok';
    
        return view('penjualan.create', ['breadcrumb' => $breadcrumb,'page'=> $page, 'barang' => $barang, 'activeMenu'=> $activeMenu,'user'=> $user]);
    }
    
        public function store(Request $request)
        {
            //melakukan validasi data
            $request->validate([
                'jumlah' => 'required|integer',
                'user_id' => 'required|integer',
                'barang_id' => 'required|integer',
                'pembeli' => 'required|string',
                'penjual_code' => 'required|string', // Added validation rule
                'harga' => 'required|integer',
            ]);
            
            $penjualan = PenjualanModel::create([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjual_code' => $request->penjual_code,
                'penjualan_tanggal' => now(),
            ]);
            
            $penjualan_id = PenjualanModel::select('penjualan_id')->orderBy('penjualan_id', 'desc')->first();

            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan_id->pluck('penjualan_id')->first(),
                'barang_id' => $request->barang_id,
                'harga' => $request->harga,
                'jumlah' => $request->jumlah
              ]);

            $barang_id = $request->barang_id;
            $jumlah = $request->jumlah;
            $date = now();
            $stok = (StokModel::where('barang_id', $barang_id)->value('stok_jumlah')) - $jumlah;
            StokModel::where('barang_id', $barang_id)->update(['stok_jumlah' => $stok, 'stok_tanggal' => $date, 'user_id' => $request->user_id]);
    
            return redirect('/stok')->with('success', 'Data berhasil ditambahkan');
        }

       
}