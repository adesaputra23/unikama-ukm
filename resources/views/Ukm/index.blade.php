@extends('template.partials')
@php
    use App\User;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">UKM</h5>
        <p class="text-muted m-b-10">Data UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">UKM</li>
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
                        @if (User::Is_Admin() || User::Is_Kepala_BAK())
                            <button class="btn btn-grd-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
                        @endif
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
                                        <th class="text-center">Kode UKM</th>
                                        <th class="text-center">Nama UKM</th>
                                        <th class="text-center">Foto</th>
                                        @if (User::Is_Admin() || User::Is_Kepala_BAK())
                                            <th class="text-center">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_ukm as $item => $value)
                                        <tr>
                                            <td class="align-middle text-center">{{$item + 1}}</td>
                                            <td class="align-middle">{{$value->kode_ukm}}</td>
                                            <td class="align-middle">{{$value->nama_ukm}}</td>
                                            <td class="align-middle text-center">
                                                 <img style="width: 5rem;" 
                                                    src="{{(!empty($value->foto_ukm)) ? asset('file_foto_ukm').'/'.$value->foto_ukm : asset('assets/images/ukm-default.jpg')}}" 
                                                class="rounded" alt="...">
                                            </td>
                                            @if (User::Is_Admin() || User::Is_Kepala_BAK())
                                                <td class="align-middle text-center" style="width: 18%">
                                                    <div class="btn-group btn-sm">
                                                        <button type="button" class="btn btn-grd-warning btn-sm" id="edit-button" 
                                                            data-kode_ukm={{$value->kode_ukm}}
                                                            data-toggle="modal" 
                                                            data-target=".bd-example-modal-lg">
                                                            Ubah
                                                        </button>
                                                        <button 
                                                            type="button" 
                                                            id="btn-hapus"
                                                            data-kode_ukm={{$value->kode_ukm}}
                                                            class="btn btn-grd-danger btn-sm"
                                                            data-toggle="modal" 
                                                            data-target=".bd-example-modal-hapus">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            @endif
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
        <h5 class="modal-title">Hapus Data UKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('ukm.hapus')}}" method="post">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="hapus_ukm_kode" id="hapus_ukm_kode">
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
        <h5 class="modal-title">Tambah Data UKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('ukm.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kode</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="kode_ukm" id="kode_ukm" required>
                </div>
                @error('kode_ukm')
                    <small class="text-danger">&ensp;&ensp;
                        <i class="fa fa-warning"></i>
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="nama_ukm" id="nama_ukm" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Terbentuk</label>
                <div class="col-sm-9">
                    <input value="" type="date" class="form-control" name="tgl_terbentuk" id="tgl_terbentuk" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                    <textarea rows="5" cols="5" class="form-control" name="deskripsi" id="deskripsi"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="foto" id="foto">
                    <small class="foto-name mt-2" style="display: none;"><i>Nama Foto</i></small>
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

        $(document).on('click', '#btn-tambah' ,function(e){
            $('.modal .modal-title').text('Tambah Data UKM');
            $('#kode_ukm').attr('readonly', false);
            $('#kode_ukm').val('');
            $('#nama_ukm').val('');
            $('#tgl_terbentuk').val('');
            $('#deskripsi').val('');
            $('.foto-name').css('display', 'none');
            $('.foto-name').text('');
            $('#btn-simpan').val('tambah');
        });

        $(document).on('click', '#edit-button' ,function(e){
            $('.modal .modal-title').text('Ubah Data UKM');
            var kode_ukm = $(this).data('kode_ukm');
            var list_data = $.get("{{url('ukm/ajax-get')}}/" + kode_ukm);
            list_data.done(function(response){
                $('#kode_ukm').attr('readonly', true);
                $('#kode_ukm').val(response.kode_ukm);
                $('#nama_ukm').val(response.nama_ukm);
                $('#tgl_terbentuk').val(response.tgl_terbentuk);
                $('#deskripsi').val(response.deskripsi);
                $('.foto-name').css('display', 'block');
                $('.foto-name').text(response.foto_ukm);
                $('#btn-simpan').val('update');
            })
        });

        $(document).on('click', '#btn-hapus', function(e){
            var kode_ukm = $(this).data('kode_ukm');
            $('#hapus_ukm_kode').val(kode_ukm);
        });

    </script>
@endsection
{{-- end section costum js --}}