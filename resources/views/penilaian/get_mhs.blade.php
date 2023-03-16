@extends('template.partials')
@php
    use App\User;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">{{$ukm->kode_ukm}} - UKM {{$ukm->nama_ukm}}</h5>
        <p class="text-muted m-b-10">Penilaian UKM</p>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}"> <i class="fa fa-home"></i></a>
            </li>
            <li class="breadcrumb-item">Data Mahasiswa</li>
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
                    <div class="card-header">
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NPM</th>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        <th class="text-center">Fakultas</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Jumlah Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_mhs as $key => $value)
                                        <tr>
                                            <td class="align-middle text-center">{{$key + 1}}</td>
                                            <td class="align-middle">{{$value->mhs->npm}}</td>
                                            <td class="align-middle">{{$value->mhs->nama_mhs}}</td>
                                            <td class="align-middle">{{ $fakultas[$value->mhs->fakultas]}}</td>
                                            <td class="align-middle">{{$prodi[$value->mhs->prodi]}}</td>
                                            <td class="align-middle text-center">{{$value->nilai_akhir}}</td>
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
@endsection
{{-- end section costum js --}}