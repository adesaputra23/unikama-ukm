@extends('template.partials')
@php
    use App\User;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">Kriteria</h5>
        <p class="text-muted m-b-10">Data Kriteria</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Kriteria</li>
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
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Cost/Benefit</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_kriteria as $item => $value)    
                                        <tr>
                                            <td class="align-middle text-center">{{$item + 1}}</td>
                                            <td class="align-middle">{{$value->kode_kriteria}}</td>
                                            <td class="align-middle">{{$value->nama_kriteria}}</td>
                                            <td class="align-middle text-center">{{$value->jenis_kriteria}}</td>
                                            <td class="align-middle text-center">{{$value->nilai}}</td>
                                            <td class="align-middle text-center" style="width: 18%">
                                                <div class="btn-group btn-sm">
                                                    <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                        data-id={{$value->id_kriteria}}
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-lg">
                                                        Ubah
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        id="btn-hapus"
                                                        data-id={{$value->id_kriteria}}
                                                        class="btn btn-grd-danger btn-sm"
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-hapus">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">   
                    <div class="card-block table-border-style">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2">Tingkat Nilai Kepentingan</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Kepentingan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_tingkat_kepentingan as $item => $tingkat_kepentingan)
                                                <tr>
                                                    <td class="text-center">{{$tingkat_kepentingan['nilai_kpt']}}</td>
                                                    <td class="text-center">{{$tingkat_kepentingan['nama_kpt']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                     <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2">Standar Nilai Kriteria</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Nilai</th>
                                                <th class="text-center">Kriteria</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($list_standar_kriteria as $key => $standar_kriteria)
                                                <tr>
                                                    <td class="text-center">{{$standar_kriteria['nilai_krt']}}</td>
                                                    <td class="text-center">{{$standar_kriteria['nama_krt']}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        <h5 class="modal-title">Hapus Data UKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('kriteria.hapus')}}" method="post">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id_kriteria" id="id_kriteria">
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
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('kriteria.save')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kode</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="kode_kriteria" id="kode_kriteria" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kriteria</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis</label>
                <div class="col-sm-9">
                    <select class="form-control" name="jenis" id="jenis" required>
                        <option value="" selected disabled>Pilih Jenis</option>
                        <option value="Benefit">Benefit</option>
                        <option value="Cost">Cost</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nilai</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nilai" id="nilai" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="btn-simpan" name="aksi" class="btn btn-grd-primary btn-sm">Simpan</button>
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
        $(document).on('click', '#btn-tambah', function(e){
            $('.modal .modal-title').text('Tambah Data Kriteria');
            $('#kode_kriteria').attr('readonly', false);
            $('#kode_kriteria').val('');
            $('#nama_kriteria').val('');
            $('#jenis').val('');
            $('#nilai').val('');
            $('#btn-simpan').val('tambah');
        });
        $(document).on('click', '#edit-button', function(e){
            $('.modal .modal-title').text('Ubah Data Kriteria');
            $('#kode_kriteria').attr('readonly', true);
            var id = $(this).data('id');
            var list_data = $.get("{{url('kriteria/ajax-get')}}/" + id);
            list_data.done(function(response){
                var kriteria = response;
                $('#kode_kriteria').val(kriteria.kode_kriteria);
                $('#nama_kriteria').val(kriteria.nama_kriteria);
                $('#jenis').val(kriteria.jenis_kriteria);
                $('#nilai').val(kriteria.nilai);
                $('#btn-simpan').val('ubah');
            });
        });
        $(document).on('click', '#btn-hapus', function(e){
            var id = $(this).data('id');
            $('#id_kriteria').val(id);
        });
    </script>
@endsection
{{-- end section costum js --}}