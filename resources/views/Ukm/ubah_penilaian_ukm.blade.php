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
                                            <th class="text-center align-middle" colspan="{{$kriteria_count}}">Kriteria</th>
                                        </tr>
                                        <tr>
                                            @foreach ($list_kriteria as $key => $kriteria)
                                                <th class="text-center">{{$kriteria->kode_kriteria}} {{"($kriteria->jenis_kriteria)"}}</th>
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
                                                        <input value="{{$val[$key]->kode_ukm}}" type="hidden" class="form-control" name="kode_ukm[]">
                                                        <input value="{{$kriteria->kode_kriteria}}" type="hidden" class="form-control" name="kode_kriteria[]">
                                                        <input max="5" min="1" value="{{$val[$key]->nilai}}" type="number" class="form-control" name="nilai[]" id="nilai" required>
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