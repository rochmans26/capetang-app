@extends('layouts.main')
@section('content')
    <div class="container mb-3">
        <div class="p-5 text-white rounded text-center shadow-md"
            style="background-image: url('{{ asset('img/newbanner-capetang.png') }}'); 
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <h1 class="text-white" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); font-size: 2.5rem; font-weight: bold;">
                Selamat Datang! <br> Di Bank Sampah Capetang
            </h1>
            <p><i>"Mari Bersama Wujudkan Lingkungan yang Lebih Bersih dan Hijau!"</i></p>
        </div>
    </div>

    <div class="title my-3">
        <h1>Dashboard</h1>
        <hr>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title"><span><img src="{{ asset('img/leatherboard-logo.png') }}" alt=""
                            width="20" srcset=""></span> Leatherboard</h5>
                <div class="row justify-content-center">
                    <div class="col-sm-4 mb-3">
                        <div class="card">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                #1
                            </span>
                            <div class="d-flex justify-content-center mt-3">
                                <img src="{{ asset('img/lb-user-1.png') }}" class="" width="100" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="title text-center">Udin</h5>
                                <hr>
                                <span class="d-flex align-item-center justify-content-center">
                                    <div class="p-1">
                                        <i class="bi bi-coin text-warning" style="font-size: 18pt"></i>
                                    </div>
                                    <div class="p-1">
                                        <h3>7000</h3>
                                    </div>
                                </span>
                                <p class="text-center fw-bold"><span class="badge text-bg-warning">Point</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                #2
                            </span>
                            <div class="d-flex justify-content-center mt-3">
                                <img src="{{ asset('img/lb-user-1.png') }}" class="" width="100" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="title text-center">Irwin</h5>
                                <hr>
                                <span class="d-flex align-item-center justify-content-center">
                                    <div class="p-1">
                                        <i class="bi bi-coin text-warning" style="font-size: 18pt"></i>
                                    </div>
                                    <div class="p-1">
                                        <h3>5000</h3>
                                    </div>
                                </span>
                                <p class="text-center fw-bold"><span class="badge text-bg-warning">Point</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                #3
                            </span>
                            <div class="d-flex justify-content-center mt-3">
                                <img src="{{ asset('img/lb-user-1.png') }}" class="" width="100" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="title text-center">Reliska</h5>
                                <hr>
                                <span class="d-flex align-item-center justify-content-center">
                                    <div class="p-1">
                                        <i class="bi bi-coin text-warning" style="font-size: 18pt"></i>
                                    </div>
                                    <div class="p-1">
                                        <h3>2000</h3>
                                    </div>
                                </span>
                                <p class="text-center fw-bold"><span class="badge text-bg-warning">Point</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table caption-top">
                        <caption>List of users</caption>
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jumlah Point</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>700</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>600</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow mb-3">
            <div class="card-body">
                <h5 class="card-title"><span><i class="bi bi-bookmark-star-fill text-success"></i></span> Quest Anda
                </h5>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card text-bg-light">
                            <div class="card-body">
                                <h5 class="card-title text-center">Total Quest</h5>
                                <h1 class="text text-center">20</h1>
                                <div class="d-flex justify-content-center">
                                    <a href="" class="btn btn-success">Tap for More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-bg-light">
                            <div class="card-body">
                                <h5 class="card-title text-center">Quest Aktif</h5>
                                <h1 class="text text-center">5</h1>
                                <div class="d-flex justify-content-center">
                                    <a href="" class="btn btn-success">Tap for More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-bg-light">
                            <div class="card-body">
                                <h5 class="card-title text-center">Quest Selesai</h5>
                                <h1 class="text text-center">15</h1>
                                <div class="d-flex justify-content-center">
                                    <a href="" class="btn btn-success">Tap for More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-3">
            <div class="card-body">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('customize-script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Konfigurasi Chart.js
        console.log(window.Chart);
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Jenis chart: bar, line, pie, dll.
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei'],
                datasets: [{
                    label: 'Setor Sampah',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
