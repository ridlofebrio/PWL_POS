@include('template.layoutapp2')
@include('template.navbar')
@include('template.sidebar')

    <div class="main-content">
    <section class="section">
      <div class="section-header">
            <h1>Membuat Daftar User</h1>
      </div>
      <div class="row mt-5 mb-5">
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('m_user.index') }}">
                    <i class="fas fa-arrow-left"></i> Kembali 
                  </a>
                  
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops</strong> Input gagal<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('m_user.store') }}" method="POST">
        @csrf
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Level ID:</strong>
                <input type="number" name="level_id" class="form-control" placeholder="Masukkan level id">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    </section>
    </div>

@include('template.footer')
@include('templateJS.general')
