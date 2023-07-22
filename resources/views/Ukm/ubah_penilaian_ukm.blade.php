@extends('template.partials')
@php
    use App\User;
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

            {{-- card content --}}
                <div class="card">   
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
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
                                        @foreach ($list_penilaian as $penilaian => $val)
                                            <tr>
                                                <td>{{$val[0]->ukm->kode_ukm}}</td>
                                                <td>{{$val[0]->ukm->nama_ukm}}</td>
                                                @foreach ($list_kriteria as $key => $kriteria)
                                                    <td class="text-center">
                                                        @if ($kriteria->jenis_kriteria ===  'Benefit')
                                                            <select class="custom-select form-control" id="nilai" name="nilai[]">
                                                                <option value="0">Pilih Nilai</option>
                                                                @foreach ($nilaiTingkatKepentingan as $keyTk => $tingkatKepentingan)
                                                                    <option value="{{$tingkatKepentingan['nilai_kpt']}}"  @if ($tingkatKepentingan['nilai_kpt'] == $val[$key]->nilai) selected @endif>{{$tingkatKepentingan['nama_kpt']}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <select class="custom-select form-control" id="nilai" name="nilai[]">
                                                                <option value="0">Pilih Nilai</option>
                                                                @foreach ($nilaiStandarKriteria as $keyTk => $standarKriteria)
                                                                    <option value="{{$standarKriteria['nilai_krt']}}" @if ($standarKriteria['nilai_krt'] == $val[$key]->nilai) selected @endif>{{$standarKriteria['nama_krt']}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                        <input value="{{$val[$key]->kode_ukm}}" type="hidden" class="form-control" name="kode_ukm[]">
                                                        <input value="{{$kriteria->kode_kriteria}}" type="hidden" class="form-control" name="kode_kriteria[]">
                                                        {{-- <input max="5" min="1" value="{{$val[$key]->nilai}}" type="number" class="form-control" name="nilai[]" id="nilai" required> --}}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 float-right">
                                    <button type="submit" id="btn-simpan" name="aksi" value="ubah" class="btn btn-grd-success btn-sm">Simpan</button>
                                    <button type="reset" id="btn-reset" class="btn btn-grd-danger btn-sm">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- end card content--}}

        </div>
    </div>
@endsection
{{-- end section conten --}}

{{-- section costum js --}}
@section('costum-js')
    <script>
    </script>
@endsection
{{-- end section costum js --}}