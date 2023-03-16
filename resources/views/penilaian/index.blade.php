@extends('template.partials')
@php
    use App\User;
@endphp
{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">UKM</h5>
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
                    <div class="card-header">
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
                                        <th class="text-center">Jumlah Penilaian <br> Mahasiswa</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_ukm as $key => $value)
                                        <tr>
                                            <td class="align-middle text-center">{{$key + 1}}</td>
                                            <td class="align-middle">{{$value->kode_ukm}}</td>
                                            <td class="align-middle">{{$value->nama_ukm}}</td>
                                            <td class="align-middle text-center">{{count($value->PemilihanUkms)}}</td>
                                            <td class="align-middle text-center" style="width: 18%">
                                                <a 
                                                    href="{{route('penilaian.mhs', "$value->kode_ukm")}}" 
                                                    class="btn btn-grd-info btn-sm" 
                                                    id="edit-button">
                                                    Data Mahasiswa
                                                </a>
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
@endsection
{{-- end section costum js --}}