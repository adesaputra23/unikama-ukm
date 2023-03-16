@extends('template.partials')
@php
    use App\User;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">Mahasiswa</h5>
        <p class="text-muted m-b-10">Data Mahasiswa</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
                <li class="breadcrumb-item">Mahasiswa</li>
                <li class="breadcrumb-item"><a href="{{url()->current()}}">Mahasiswa</a></li>
        </ul>
    </div>
@endsection
{{-- end content-breadcrumb --}}

{{-- section content --}}
@section('content')
    <div class="row">
        <div class="col-sm-12">

            @if (Session::Has('success'))
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>Berhasil!</strong> {{Session::get('success')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
           @endif

            @if (Session::Has('error'))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Gagal!</strong> {{Session::get('error')}}
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
           @endif

            {{-- card content --}}
                <div class="card">   
                    <div class="card-header">
                        <button class="btn btn-grd-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-times close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        @if (User::Is_Admin() || User::Is_Kepala_BAK())
                                            <th class="text-center">Fakultas</th>
                                            <th class="text-center">Prodi</th>
                                            <th class="text-center">Agama</th>
                                            <th class="text-center">Jenis Kelamin</th>
                                        @elseif(User::Is_Kaprodi())
                                            <th class="text-center">UKM Pilihan</th>
                                        @endif
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_mahasiswa as $item => $value)
                                        <tr>
                                            <td class="text-center align-middle">{{$item + 1}}</td>
                                            <td class="align-middle">{{$value->npm}}</td>
                                            <td class="align-middle">{{$value->nama_mhs}}</td>
                                            @if (User::Is_Admin() || User::Is_Kepala_BAK())    
                                                <td class="align-middle">{{$map_fakultas[$value->fakultas]}}</td>
                                                <td class="align-middle">{{$map_prodi[$value->prodi]}}</td>
                                                <td class="align-middle">{{ $agama[$value->agama] ?? '-'}}</td>
                                                <td class="align-middle">{{$jenis_kelamin[$value->jenis_kelamin] ?? '-'}}</td>
                                            @elseif(User::Is_Kaprodi())
                                                <td class="align-middle text-center">
                                                    @if (!$value->PilihanUkm)
                                                        {{'-'}}
                                                    @else
                                                        {{'('.$value->PilihanUkm->Ukm->kode_ukm.') - ' .$value->PilihanUkm->Ukm->nama_ukm}}
                                                    @endif
                                                </td>
                                            @endif
                                            <td class="text-center align-middle" style="width: 12%">
                                                <div class="btn-group btn-group-vertical btn-sm">
                                                    <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                        data-npm={{$value->npm}}
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-lg">
                                                        Ubah
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        id="btn-hapus"
                                                        data-id_user={{$value->user->id}}
                                                        class="btn btn-grd-danger btn-sm"
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-hapus">
                                                        Hapus
                                                    </button>
                                                    <a href="{{route('ukm.penilaian.detail',['npm' => $value->npm ])}}" class="btn btn-grd-info btn-sm">Detail</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            {{-- end card content--}}

        </div>
    </div>
@endsection
{{-- end section conten --}}

{{-- modal hapus --}}
<div class="modal fade bd-example-modal-hapus" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('pengguna.pegawai.hapus')}}" method="post">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id_user" id="id_user">
            <div class="text-center">
                <p>Anda yakin ingin hapus data ini?</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-grd-primary btn-sm">Hapus</button>
            <button type="button" class="btn btn-grd-danger btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- end modal view --}}

{{-- modal view --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('pengguna.mahasiswa.save')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">NPM</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="npm" id="npm" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama_mhs" id="nama_mhs" required>
                </div>
            </div>
             <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input value="" type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Fakultas</label>
                <div class="col-sm-9">
                    <select class="form-control" name="fakultas" id="fakultas" required>
                        <option value="" selected disabled>Pilih Fakultas</option>
                        @if (User::Is_Kaprodi())
                            @foreach ($fakultas as $item => $value)
                                <option value="{{$value['id']}}">{{$value['nama']}}</option>
                            @endforeach
                        @elseif(User::Is_Admin() || User::Is_Kepala_BAK())
                            @foreach ($fakultas as $item => $value)
                                <option value="{{$value['id']}}">{{$value['nama']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Prodi</label>
                <div class="col-sm-9">
                    <select class="form-control" name="prodi" id="prodi" required>
                        <option value="" selected disabled>Pilih Prodi</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Agama</label>
                <div class="col-sm-9">
                    <select class="form-control" name="agama" id="agama" required>
                        <option value="" selected disabled>Pilih Agama</option>
                        @foreach ($agama as $item => $agm)
                            <option value="{{$item}}">{{$agm}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <select class="form-control" name="jk" id="jk" required>
                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                        @foreach ($jenis_kelamin as $item_jk => $jk)
                            <option value="{{$item_jk}}">{{$jk}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-grd-primary btn-sm">Simpan</button>
            <button type="button" class="btn btn-grd-danger btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- end modal view --}}


{{-- section costum js --}}
@section('costum-js')
    <script>
        var prodi = @json($prodi);
        $(document).on('change', '#fakultas', function(e){
            var fakultas = $(this).val();
            var html_prodi = '';
            $('#prodi').empty();
            html_prodi += `<option selected disabled>Pilih Prodi</option>`;
            $('#prodi').append(html_prodi);
            $.each(prodi[fakultas], function (key, val) { 
                $('#prodi').append($('<option>', {
                    value: val.id,
                    text: val.nama
                }));
            });
        });

        $(document).on('click', '#btn-tambah', function(e){
            $('.modal .modal-title').text('Tambah Data Mahasiswa');
            $('#npm').attr('readonly', false);
            var html_prodi = '';
            $('#npm').val('');
            $('#nama_mhs').val('');
            $('#email').val('');
            $('#fakultas').val('');
            $('#prodi').empty();
            html_prodi += `<option selected disabled>Pilih Prodi</option>`;
            $('#prodi').append(html_prodi);
        });

        $(document).on('click', '#edit-button', function(e){
            $('.modal .modal-title').text('Ubah Data Mahasiswa');
            $('#npm').attr('readonly', true);
            var npm = $(this).data('npm');
            var list_data = $.get("{{url('mahasiswa/ajax-get')}}/" + npm);
            list_data.done(function(data){
                var mahasiswa = data;
                var html_prodi = '';
                $('#npm').val(mahasiswa.npm);
                $('#nama_mhs').val(mahasiswa.nama_mhs);
                $('#email').val(mahasiswa.user.email);
                $('#fakultas').val(mahasiswa.fakultas);
                $('#prodi').empty();
                html_prodi += `<option selected disabled>Pilih Prodi</option>`;
                $.each(prodi[mahasiswa.fakultas], function (key, val) { 
                    html_prodi += `
                        <option value="${val.id}" ${(val.id == mahasiswa.prodi) ? 'selected' : ''}>${val.nama}</option>
                    `;
                });
                $('#prodi').append(html_prodi);
                $('#agama').val(mahasiswa.agama);
                $('#jk').val(mahasiswa.jenis_kelamin);
            });
        });

        $(document).on('click', '#btn-hapus', function(e){
            var id_user = $(this).data('id_user');
            $('#id_user').val(id_user);
        });

    </script>

@endsection
{{-- end section costum js --}}