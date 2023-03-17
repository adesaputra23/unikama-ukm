@extends('template.partials')
@php
    use App\User;
    use App\Ukm;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">Rekomendasi UKM</h5>
        <p class="text-muted m-b-10">Rekomendasi UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Rekomendasi UKM</li>
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
                    <div class="card-block table-border-style">

                        @if ($first_ukm != null)

                            <div class="mb-3">
                                <span>
                                    Rekomendasi UKM sesuai dengan keriteria penilaian yang anda inputkan.
                                </span>
                                <li>
                                    <span>
                                        Lihat beberapa rekomendasi UKM, dengan klik <b>"Tampilkan beberapa rekomendasi UKM lain."</b> di bawah.
                                    </span>
                                </li>
                            </div>

                            @php
                                $ukm = Ukm::GetUkmByKode($first_ukm['kode_ukm']);
                            @endphp

                            <div class="card page-header p-0">
                                <div class="card-block front-icon-breadcrumb row align-items-end" style="border: 2px solid #2534d5;">
                                    <div class="breadcrumb-header col">
                                        <div class="big-icon">
                                            <img style="width: 6rem; margin-top: -50px;" 
                                                src="{{(!empty($ukm->foto_ukm)) ? asset('file_foto_ukm').'/'.$ukm->foto_ukm : asset('assets/images/avatar-0.png')}}" 
                                            class="icofont rounded" alt="...">
                                        </div>
                                        <div class="d-inline-block" style="margin-left: 16px; margin-top: 10px;">
                                            <h5>{{$first_ukm['nama_ukm']}}</h5>
                                            <span>
                                                {{substr($ukm->deskripsi, 0, 25).'...'}}
                                                <br>
                                                {{$ukm->tgl_terbentuk}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="align-middle float-right" style="margin-left: 10rem;">
                                            <h3 style="font-size: 2.4rem"><label class="badge badge-warning">{{substr($first_ukm['nilai_akhir'], 0, 5)}}</label></h3>
                                            {{-- Auth::user()->Mahasiswa->PilihanUkm->kode_ukm == $first_ukm['kode_ukm'] --}}
                                            @if (!Auth::user()->Mahasiswa->PilihanUkm)
                                                 <button 
                                                    data-npm="{{Auth::user()->user_name}}"
                                                    data-kode_ukm="{{$first_ukm['kode_ukm']}}"
                                                    data-nama_ukm="{{$first_ukm['nama_ukm']}}"
                                                    data-nilai="{{substr($first_ukm['nilai_akhir'], 0, 5)}}"
                                                    data-type="pilih"
                                                    data-toggle="modal" 
                                                    data-target=".bd-example-modal-hapus" 
                                                    type="button" 
                                                    id="btn-simpan" 
                                                    class="btn btn-grd-warning btn-sm">
                                                    Pilih UKM
                                                </button>
                                            @else    
                                                @if (Auth::user()->Mahasiswa->PilihanUkm->kode_ukm == $first_ukm['kode_ukm'])
                                                    <button 
                                                        data-npm="{{Auth::user()->user_name}}"
                                                        data-kode_ukm="{{$first_ukm['kode_ukm']}}"
                                                        data-nama_ukm="{{$first_ukm['nama_ukm']}}"
                                                        data-type="batal"
                                                        data-nilai="{{substr($first_ukm['nilai_akhir'], 0, 5)}}"
                                                        data-toggle="modal" 
                                                        data-target=".bd-example-modal-hapus" 
                                                        type="button" 
                                                        id="btn-simpan" 
                                                        class="btn btn-grd-danger btn-sm">
                                                        Batal Pilih UKM
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="show-data" style="display: none;">
                                @foreach ($other_ukm as $item => $value)
                                    @php
                                        $ukm = Ukm::GetUkmByKode($value['kode_ukm']);
                                    @endphp
                                    <div class="card page-header p-0">
                                        <div class="card-block front-icon-breadcrumb row align-items-end" style="border: 2px solid #2534d5;">
                                            <div class="breadcrumb-header col">
                                                <div class="big-icon">
                                                    <img style="width: 6rem; margin-top: -50px;" 
                                                        src="{{(!empty($ukm->foto_ukm)) ? asset('file_foto_ukm').'/'.$ukm->foto_ukm : asset('assets/images/avatar-0.png')}}" 
                                                    class="icofont rounded" alt="...">
                                                </div>
                                                <div class="d-inline-block" style="margin-left: 16px; margin-top: 10px;">
                                                    <h5>{{$value['nama_ukm']}}</h5>
                                                    <span>
                                                        {{substr($ukm->deskripsi, 0, 25).'...'}}
                                                        <br>
                                                        {{$ukm->tgl_terbentuk}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="align-middle float-right" style="margin-left: 10rem;">
                                                    <h3 style="font-size: 2.4rem"><label class="badge badge-warning">{{substr($value['nilai_akhir'], 0, 5)}}</label></h3>
                                                    @if (!Auth::user()->Mahasiswa->PilihanUkm)
                                                        <button 
                                                            data-npm="{{Auth::user()->user_name}}"
                                                            data-kode_ukm="{{$value['kode_ukm']}}"
                                                            data-nama_ukm="{{$value['nama_ukm']}}"
                                                            data-nilai="{{substr($value['nilai_akhir'], 0, 5)}}"
                                                            data-type="pilih"
                                                            data-toggle="modal" 
                                                            data-target=".bd-example-modal-hapus" 
                                                            type="button" id="btn-simpan" 
                                                            class="btn btn-grd-warning btn-sm">
                                                            Pilih UKM
                                                        </button>
                                                    @else
                                                        @if (Auth::user()->Mahasiswa->PilihanUkm->kode_ukm == $value['kode_ukm'])
                                                            <button 
                                                                data-npm="{{Auth::user()->user_name}}"
                                                                data-kode_ukm="{{$value['kode_ukm']}}"
                                                                data-nama_ukm="{{$value['nama_ukm']}}"
                                                                data-nilai="{{substr($value['nilai_akhir'], 0, 5)}}"
                                                                data-type="batal"
                                                                data-toggle="modal" 
                                                                data-target=".bd-example-modal-hapus" 
                                                                type="button" id="btn-simpan" 
                                                                class="btn btn-grd-danger btn-sm">
                                                                Batal Pilih UKM
                                                            </button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="float-right">
                                <button type="button" id="show-other-ukm" class="btn btn-link btn-sm" value="show">Tampilkan beberapa rekomendasi UKM lain.</button>
                            </div>
                        
                        @else

                         <div class="mb-3">
                            <span>
                                Belum ada rekomendasi UKM, karena anda belum input penilaian.
                                <br>
                                Silahkan masuk ke menu <b>"Penilaian UKM"</b> atau klik button di bawah.
                            </span>
                            <br>
                            <a href="{{route('ukm.penilaian')}}" class="btn btn-out btn-primary btn-square btn-sm mt-2">Penilaian UKM</a>
                        </div>

                        @endif


                    </div>
                </div>
            {{-- end card content--}}

        </div>
    </div>

    {{-- modal pilih ukm --}}
    <div class="modal fade bd-example-modal-hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Pilih UKM</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('ukm.rekomendasi.save')}}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="npm" id="npm">
                <input type="hidden" name="ukm_kode" id="ukm_kode">
                <input type="hidden" name="nilai_akhir" id="nilai_akhir">
                <div class="text-center">
                    <p id="text-conten">...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-simpan-modal" name="aksi" value="" class="btn btn-grd-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-grd-danger btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    {{-- end modal --}}

@endsection
{{-- end section conten --}}


{{-- section costum js --}}
@section('costum-js')
    <script>
        $(document).on('click', '#show-other-ukm', function(e){
            var get_val = $(this).val();
            if (get_val === 'show') {
                $('#show-data').css('display', 'block');
                $('#show-other-ukm').text('Sembuyikan beberapa rekomendasi UKM lain.');                
                get_val = $(this).val('hide');
            }else{
                $('#show-other-ukm').text('Tampilkan beberapa rekomendasi UKM lain.');
                $('#show-data').css('display', 'none');
                get_val = $(this).val('show');
            }
        });

        $(document).on('click', '#btn-simpan', function(e){
            var npm = $(this).data('npm');
            var kode_ukm = $(this).data('kode_ukm');
            var nama_ukm = $(this).data('nama_ukm');
            var nilai = $(this).data('nilai');
            var type = $(this).data('type');
            $('#npm').val(npm);
            $('#ukm_kode').val(kode_ukm);
            $('#nilai_akhir').val(nilai);
            if (type == 'pilih') {
                $('#text-conten').html('Anda memilih UKM <b>"' + nama_ukm + '"</b><br>Simpan untuk melanjutkan meimilih UKM');
                $('#btn-simpan-modal').val(type);
            } else {
                $('#text-conten').html('Anda yakin ingin membatalkan,<br>Simpan untuk melanjutkan pembatalan');
                $('#btn-simpan-modal').val(type);
            }
        })

    </script>
@endsection
{{-- end section costum js --}}