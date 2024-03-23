@extends('Layout\app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

@section('content')
        <div class="container">
            <div class="card card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Edit Kategori</h3>
                 </div>
                <form action="{{ url('kategori/ganti_simpan', $kategori->kategori_id) }}" method="POST">

                    @csrf

                    <div class="card-body">
                        <div class="form-group">
                              <label>Kategori Kode <br></label>
                               <input type="text" id="kodekategori" name="kodekategori" placeholder="Masukkan Kode Kategori" value="{{ $kategori->kategori_kode}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Kategori <br></label>
                            <input type="text" id="namakategori" name="namakategori" placeholder="Masukkan Nama Kategori" value="{{ $kategori->kategori_nama }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </form>
            </div>
        </div>
@endsection