@extends('template.partials')

{{-- section content-breadcrumb --}}
@section('content-breadcrumb')
    <div class="card-block">
        <h5 class="m-b-10">Dashboard</h5>
        <ul class="breadcrumb-title b-t-default p-t-10">
            <li class="breadcrumb-item">
                <a href="index.html"> <i class="fa fa-home"></i> Dashboard </a>
            </li>
        </ul>
    </div>
@endsection
{{-- end content-breadcrumb --}}

{{-- section content --}}
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Grafik Pemintan UKM</h5>
                    <span>UKM Paling diminati oleh Mahasiswa Baru adalah : UKM <b>{{$string_ukm_name}}</b></span>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa-chevron-left"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i>
                            </li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-times close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <canvas id="Statistics-chart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- end section conten --}}

{{-- section costum js --}}
@section('costum-js')
    <script>
        $(function() {
            var list_data_ukm = $.get("{{url('ukm/ajax-get-grafik')}}/");
            list_data_ukm.done(function(response){
                var h = document.getElementById("Statistics-chart").getContext("2d");
                var j = h.createLinearGradient(500, 0, 100, 0);
                j.addColorStop(0, "#fd93a8");
                j.addColorStop(1, "#FC6180");
                var g = h.createLinearGradient(500, 0, 100, 0);
                g.addColorStop(1, "#56CCF2");
                g.addColorStop(0, "#2F80ED");
                var i = new Chart(h, {
                    type: "line",
                    data: {
                        labels: response.nama_ukm,
                        datasets: [{
                            label: "Penilaian UKM",
                            borderColor: g,
                            pointBorderColor: g,
                            pointBackgroundColor: g,
                            pointHoverBackgroundColor: g,
                            pointHoverBorderColor: g,
                            pointBorderWidth: 10,
                            pointHoverRadius: 10,
                            pointHoverBorderWidth: 1,
                            pointRadius: 0,
                            fill: false,
                            borderWidth: 4,
                            data: response.nilai
                        }]
                    },
                    options: {
                        legend: {
                            position: "top"
                        },
                        tooltips: {
                            enabled: true,
                            intersect: !1,
                            mode: "nearest",
                            xPadding: 10,
                            yPadding: 10,
                            caretPadding: 10
                        },
                        scales: {
                            yAxes: [ {
                                ticks: {
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold",
                                    beginAtZero: true,
                                    maxTicksLimit: 5,
                                    padding: 20
                                },
                                gridLines: {
                                    drawTicks: false,
                                    display: false
                                }
                            } ],
                            xAxes: [ {
                                gridLines: {
                                    drawTicks: false,
                                    display: false
                                },
                                ticks: {
                                    padding: 20,
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold"
                                }
                            } ]
                        }
                    }
                });
            });
        });
    </script>

@endsection
{{-- end section costum js --}}