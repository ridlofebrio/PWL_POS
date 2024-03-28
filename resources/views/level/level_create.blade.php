@extends('layout.app')

@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data Level</h3>
        </div>

        <form action="../level" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="level_kode">Level Kode</label>
                    <input type="text" name="level_kode" class="form-control" id="level_kode"
                        placeholder="Masukan level kode">
                </div>
                <div class="form-group">
                    <label for="level_nama">Level Nama</label>
                    <input type="text" name="level_nama" class="form-control" id="level_nama"
                        placeholder="Masukan level kode">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
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
    </div>
@endsection