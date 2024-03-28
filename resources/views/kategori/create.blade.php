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
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kategori_kode">Kode Kategori</label>
                                <input type="text" 
                                    name="kategori_kode" 
                                    id="kategori_kode" 
                                    class="@error('kategori_kode') is-invalid @enderror form-control" 
                                    placeholder="">
                        
                    @error('kategori_kode')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Ada masalah dengan inputan anda.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
@endsection