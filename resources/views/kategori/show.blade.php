@extends('layout.template')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header">
    <h3 class="card-title">{{ $page->title }}</h3>
    <div class="card-tools"></div>
  </div>
  <div class="card-body">
    @empty($kategori)
      <div class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
        Data yang Anda cari tidak ditemukan.
      </div>
    @else
      <table class="table table-bordered table-striped table-hover table-sm">
        <tbody>
          <tr>
            <th scope="row">ID</th>
            <td>{{ $kategori->kategori_id }}</td>
          </tr>
          <tr>
            <th scope="row">Kode kategori</th>
            <td>{{ $kategori->kategori_kode }}</td>
          </tr>
          <tr>
            <th scope="row">Nama kategori</th>
            <td>{{ $kategori->kategori_nama }}</td>
          </tr>
        </tbody>
      </table>
      <br>
    @endempty
    <a href="{{ url('kategori') }}" class="btn btn-sm btn-default mt2">Kembali</a>
  </div>
</div>
@endsection

@push('css')
  <style>
    .table td, .table th {
      padding: 10px 15px; /* Adjust padding values as needed */
    }
  </style>
@endpush

@push('js')
@endpush
