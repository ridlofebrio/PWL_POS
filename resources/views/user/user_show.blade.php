@include('template.layoutapp2')
@include('template.navbar')
@include('template.sidebar')

    <div class="main-content">
         <section class="section">
      <div class="section-header">
            <h1>Show User</h1>
      </div>
      <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
              <a class="btn btn-success" href="{{ route('m_user.index') }}">
                <i class="fas fa-arrow-left"></i> Kembali 
              </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>User_id:</strong>
                {{ $useri->user_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Level_id:</strong>
                {{ $useri->level_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username:</strong>
                {{ $useri->username }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama:</strong>
                {{ $useri->nama }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                {{ $useri->password }}
            </div>
        </div>
    </div>
    </section>
    </div>
@include('template.footer')
@include('templateJS.general')
