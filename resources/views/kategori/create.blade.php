@extends('Layout\app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

@section('content')
        <div class="container">
            <div class="card card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Buat Kategori Baru</h3>
                 </div>
                 <form action="../kategori" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kodekategori">Kode Kategori</label>
                            <input type="text" class="form-control" id="kodekategori" name="kodekategori" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="namakategori">Nama Kategori</label>
                            <input type="text" class="form-control" id="namakategori" name="namakategori" placeholder="">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
@endsection