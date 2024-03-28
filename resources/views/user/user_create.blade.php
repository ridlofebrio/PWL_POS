@extends('layout.app')

@section('subtitle', 'Level')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Data User</h3>
        </div>
        {{ csrf_field() }}

        <form action="/user/tambah_simpan" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="level_nama">Level id</label>
                    <input type="text" name="level_id" class="form-control" id="level_id"
                        placeholder="Masukan level id">
                </div>
                <div class="form-group">
                    <label for="level_nama">Username</label>
                    <input type="text" name="username" class="form-control" id="username"
                        placeholder="Masukan username">
                </div>
                <div class="form-group">
                    <label for="level_nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama"
                        placeholder="Masukan nama">
                </div>
                <div class="form-group">
                    <label for="level_nama">Password</label>
                    <input type="text" name="password" class="form-control" id="password"
                        placeholder="Masukan password">
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