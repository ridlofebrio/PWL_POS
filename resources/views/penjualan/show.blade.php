@extends('layout.template')

@section('content')
<div class="invoice-container mx-4">
  <div class="invoice-header">
    <h2>Penjualan {{ $penjualan->penjual_code }}</h2>
    <p>Tanggal Penjualan: {{ $penjualan->penjualan_tanggal }}</p>
  </div>

  <div class="invoice-info">
    <div class="customer-info">
        <p> <h5>Pembeli</h5> {{ $penjualan->pembeli }}</p>
     
    </div>
    <div class="cashier-info">
        <p><h4>Kasir</h4> {{ $penjualan->user->nama }}</p>
    </div>
  </div>

  @empty($penjualan)
  <div class="alert alert-danger alert-dismissible">
    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
    <p>Data penjualan tidak ditemukan.</p>
  </div>
  @else
  <div class="invoice-items">
    <h3>Detail Barang Penjualan</h3>
    <table class="table table-bordered table-striped table-hover table-sm">
      <thead>
        <tr>
          <th>No</th>
          <th>Barang</th>
          <th>Harga</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php $idx = 1; ?>
        @foreach ($penjualan_detail as $dt)
        <tr>
          <td>{{ $idx++ }}</td>
          <td>{{ $dt->barang->barang_nama }}</td>
          <td>{{ $dt->harga }}</td>
          <td>{{ $dt->jumlah }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endempty

  <div class="invoice-actions">
    <a href="{{ url('penjualan') }}" class="btn btn-primary">Kembali</a>
  </div>
</div>
@endsection

@push('css')
  <style>
    .invoice-container {
      padding: 2rem;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .invoice-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    .invoice-items h3 {
      margin-bottom: 0.5rem;
    }
  </style>
@endpush

@push('js')
  @endpush
