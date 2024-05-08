@extends('layout.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">User</label>
                <div class="col-11">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">- Pilih User -</option>
                        @foreach($user as $item)
                        <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Pembeli</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ old('pembeli') }}" required>
                    @error('pembeli')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            {{-- <div class="form-group row">
                <label class="col-1 control-label col-form-label">Kode Penjualan</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="penjual_code" name="penjual_code" required>
                    @error('penjual_code')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div> --}}

        <div class="col-11">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Barang</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="barang-rows">
                <tr id="barang-row">
                  <td>
                    <select class="form-control barang0" id="barang_id" onchange="getHarga()"  name="barang_id[]" required>
                      <option value="">- Pilih Barang -</option>
                      @foreach($barang as $item)
                     
                      <option data-harga="{{$item->harga_jual}}" value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                      @endforeach

                    </select>
                  </td>
                  <td>
                 <input type="text" class="form-control" id="harga_jual" name="harga[]" required> 
                  </td>
                  <td>
                    <input type="text" class="form-control" id="jumlah-1" name="jumlah[]" required>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeBarangRow(this)">
                        Hapus
                    </button>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
          <button type="button" class="btn btn-sm btn-success mb-2" onclick="addBarangRow()">
            <i class="fas fa-plus"></i> Tambah Barang
          </button>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-12 text-right">
          <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
          <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    let barang_input = document.querySelectorAll('#barang-row');
console.log(barang_input);

function getHarga(){
    barang_input.forEach((input) => {
        input.addEventListener('change', () => {
            const harga = input.querySelector('#harga_jual');
            const hargaInput = input.querySelector('#barang_id').selectedOptions[0].getAttribute('data-harga');
            console.log(hargaInput);
            console.log(harga);
            harga.value=hargaInput
        })
    })
}

  let barangRowCount = 1;


  function addBarangRow() {
    barangRowCount++;
    const rowHtml = `
      <tr id="barang-row">
        <td>
            <select class="form-control barang0" id="barang_id" onchange="getHarga()"  name="barang_id[]" required>
                      <option value="">- Pilih Barang -</option>
                      @foreach($barang as $item)
                     
                      <option data-harga="{{$item->harga_jual}}" value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                      @endforeach

                    </select>
        </td>
        <td>
          <input type="text" class="form-control" id="harga_jual" name="harga[]" required>
        </td>
        <td>
          <input type="text" class="form-control" id="jumlah-${barangRowCount}" name="jumlah[]" required>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeBarangRow(this)">
             Hapus
            </button>
        </td>
      </tr>
    `;
    document.getElementById('barang-rows').insertAdjacentHTML('beforeend', rowHtml);
    barang_input=document.querySelectorAll('#barang-row');
  }

  function removeBarangRow(button) {
    const row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}


 
</script>
@endpush
