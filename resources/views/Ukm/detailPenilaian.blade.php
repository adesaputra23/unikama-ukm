@extends('template.partials')
@php
    use App\User;
    use App\Ukm;
    use App\Kriteria;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">Penilaian</h5>
        <p class="text-muted m-b-10">Data Penilaian</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Detail Penilaian</li>
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
                            <table class="table table-hover table-bordered">
                                <thead>
                                    {{-- row kriteria label --}}
                                    <tr style="background-color: rgba(231, 220, 220, 0.782)">
                                        <th class="text-center" colspan="{{$kriteria_count + 2}}">Penilaian </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center align-middle" rowspan="2">Kode UKM</th>
                                        <th class="text-center align-middle" rowspan="2">Nama UKM</th>
                                        <th class="text-center align-middle" colspan="{{$kriteria_count}}">Kriteria</th>
                                    </tr>
                                    @foreach ($list_kriteria as $key => $kriteria)
                                        <td class="text-center">
                                            <b>{{$kriteria->nama_kriteria}}</b>
                                            <br>
                                            <i>{{"($kriteria->jenis_kriteria)"}}</i>
                                            <br>
                                            <small style="font-size: 14px;"><b>{{$kriteria->nilai}}</b></small>
                                        </td>
                                    @endforeach
                                </thead>
                                <tbody>

                                    {{-- kriteria --}}
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

                                    {{-- row kriteria label --}}
                                    <tr style="background-color: rgba(231, 220, 220, 0.782)">
                                        <th class="text-center" colspan="{{$kriteria_count + 2}}">Nilai</th>
                                    </tr>

                                    {{-- Nilai --}}
                                    @foreach ($list_penilaian as $penilaian => $val)
                                        <tr>
                                            <td>{{$val[0]->ukm->kode_ukm}}</td>
                                            <td>{{$val[0]->ukm->nama_ukm}}</td>
                                            @foreach ($list_kriteria as $key => $kriteria)
                                                <td class="text-center">
                                                    {{$val[$key]->nilai}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    {{-- max/min --}}
                                    <tr>
                                        <th class="text-center align-middle" colspan="2">Nilai (max/min)</th>
                                        @foreach ($list_kriteria as $key => $kriteria)
                                            <td class="text-center align-middle"><b>{{Ukm::GetMaxMin($kriteria)}}</b></td>
                                        @endforeach
                                    </tr>

                                    {{-- row normalisasi --}}
                                    <tr style="background-color: rgba(231, 220, 220, 0.782)">
                                        <th class="text-center" colspan="{{$kriteria_count + 2}}">Normalisasi</th>
                                    </tr>
                                     @foreach ($list_normalisasi as $normalisasi_key => $normalisasi)
                                        <tr>
                                            <td>{{$normalisasi['kode_ukm']}}</td>
                                            <td>{{$normalisasi['nama_ukm']}}</td>
                                            @foreach ($normalisasi['nilai'] as $nilai)
                                                <td class="text-center">
                                                    {{Str::substr($nilai, 0, 3)}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                    {{-- row perangkingan --}}
                                    <tr style="background-color: rgba(231, 220, 220, 0.782)">
                                        <th class="text-center" colspan="{{$kriteria_count + 2}}">Nilai Akhir</th>
                                    </tr>
                                     @foreach ($list_nilai_akhir as $nilai_akhir)
                                        <tr>
                                            <td>{{$nilai_akhir['kode_ukm']}}</td>
                                            <td>{{$nilai_akhir['nama_ukm']}}</td>
                                            <td colspan="{{$kriteria_count}}">
                                                {{Str::substr($nilai_akhir['nilai_akhir'], 0, 5)}}
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

{{-- section costum js --}}
@section('costum-js')
    <script>
    </script>
@endsection
{{-- end section costum js --}}