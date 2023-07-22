@extends('template.partials')
@php
    use App\User;
    use App\Kriteria;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">Penilaian UKM</h5>
        <p class="text-muted m-b-10">Penilaian UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Penilaian UKM</li>
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
                        <div class="table-responsive">

                            @if (count($list_penilaian) == 0)
                                <form action="{{route('ukm.penilaian.save')}}" method="post">
                                    @csrf
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                                <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                                <th class="text-center align-middle" colspan="{{$kriteria_count}}">Kriteria Penilaian</th>
                                            </tr>
                                            <tr>
                                                @foreach ($list_kriteria as $key => $kriteria)
                                                    <td class="text-center">
                                                        <b>{{$kriteria->nama_kriteria}}</b>
                                                        <br>
                                                        <i>{{"($kriteria->jenis_kriteria)"}}</i>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_ukm as $item => $ukm)
                                                <tr>
                                                    <td>{{$ukm->kode_ukm}}</td>
                                                    <td>{{$ukm->nama_ukm}}</td>
                                                    @foreach ($list_kriteria as $key => $kriteria)
                                                        <td>
                                                            @if ($kriteria->jenis_kriteria ===  'Benefit')
                                                                <select class="custom-select form-control" id="nilai" name="nilai[]">
                                                                    <option value="0" selected>Pilih Nilai</option>
                                                                    @foreach ($nilaiTingkatKepentingan as $keyTk => $tingkatKepentingan)
                                                                        <option value="{{$tingkatKepentingan['nilai_kpt']}}">{{$tingkatKepentingan['nama_kpt']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                                <select class="custom-select form-control" id="nilai" name="nilai[]">
                                                                    <option value="0" selected>Pilih Nilai</option>
                                                                    @foreach ($nilaiStandarKriteria as $keyTk => $standarKriteria)
                                                                        <option value="{{$standarKriteria['nilai_krt']}}">{{$standarKriteria['nama_krt']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                            <input value="{{$ukm->kode_ukm}}" type="hidden" class="form-control" name="kode_ukm[]">
                                                            <input value="{{$kriteria->kode_kriteria}}" type="hidden" class="form-control" name="kode_kriteria[]">
                                                            {{-- <input max="5" min="1" value="" type="number" class="form-control" name="nilai[]" id="nilai" required> --}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-4 float-right">
                                        <button type="submit" id="btn-simpan" name="aksi" value="simpan" class="btn btn-grd-success btn-sm">Simpan</button>
                                        <button type="reset" id="btn-reset" class="btn btn-grd-danger btn-sm">Batal</button>
                                    </div>
                                </form>
                            @else
                                <span>
                                    Penilaian telah dilakukan, silahkan lihat UKM yang di rekomendasikan untuk anda,
                                    <br>
                                    Klik Button <a href="{{route('ukm.rekomendasi')}}" class="btn btn-out btn-primary btn-square btn-sm">Rekomendasi UKM</a>
                                </span>

                                <div class="mb-2 float-right">
                                    <a href="{{route('ukm.penilaian.ubah')}}" class="btn btn-grd-warning btn-sm">Ubah</a>
                                    <button type="button" class="btn btn-grd-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-hapus">Hapus</button>
                                    <a href="{{route('ukm.penilaian.detail')}}" class="btn btn-grd-info btn-sm">Detail</a>
                                </div>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                            <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                            <th class="text-center align-middle" colspan="{{$kriteria_count}}">Kriteria Penilaian</th>
                                        </tr>
                                        <tr>
                                            @foreach ($list_kriteria as $key => $kriteria)
                                                <td class="text-center">
                                                    <b>{{$kriteria->nama_kriteria}}</b>
                                                    <br>
                                                    <i>{{"($kriteria->jenis_kriteria)"}}</i>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_penilaian as $penilaian => $val)
                                            <tr>
                                                <td>{{$val[0]->ukm->kode_ukm}}</td>
                                                <td>{{$val[0]->ukm->nama_ukm}}</td>
                                                @foreach ($list_kriteria as $key => $kriteria)
                                                    <td class="text-center">
                                                        @if ($kriteria->jenis_kriteria ===  'Benefit')
                                                            @if ($val[$key]->nilai == 0)
                                                                <i style="color: red;">{{Kriteria::MAP_NILAI_TINGKAT_KEPENTINGAN[$val[$key]->nilai]['nama_kpt']}}</i>
                                                            @else       
                                                                <b>{{Kriteria::MAP_NILAI_TINGKAT_KEPENTINGAN[$val[$key]->nilai]['nama_kpt']}}</b>
                                                            @endif
                                                        @else
                                                            @if ($val[$key]->nilai == 0)
                                                                <i style="color: red;">{{Kriteria::MAP_STANDAR_KRITERIA[$val[$key]->nilai]['nama_krt']}}</i>
                                                            @else
                                                                <b>{{Kriteria::MAP_STANDAR_KRITERIA[$val[$key]->nilai]['nama_krt']}}</b>
                                                            @endif
                                                        @endif
                                                        {{-- {{$val[$key]->nilai}} --}}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            {{-- end card content--}}

        </div>
    </div>

    {{-- modal hapus --}}
    <div class="modal fade bd-example-modal-hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Hapus Data Penilaian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('ukm.penilaian.hapus')}}" method="get">
            @csrf
            <div class="modal-body">
                <div class="text-center">
                    <p>Data akan terhapus secara permanen, anda yakin ingin menghapus?</p>
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

@endsection
{{-- end section conten --}}

{{-- section costum js --}}
@section('costum-js')
    <script>
    </script>
@endsection
{{-- end section costum js --}}