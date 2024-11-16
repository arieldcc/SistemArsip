<!-- resources/views/dashboard.blade.php -->
@extends('layouts.master')

@section('css')
<style>
    .card {
        border-radius: 10px;
    }
    .card-header {
        font-weight: bold;
        display: flex;
        align-items: center;
    }
    .card-header i {
        margin-right: 8px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Info Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-inbox"></i> Total Surat Masuk
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalSuratMasuk }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-paper-plane"></i> Total Surat Keluar
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalSuratKeluar }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <i class="fas fa-clipboard-list"></i> Total Disposisi
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalDisposisi }}</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-archive"></i> Total Arsip
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalArsip }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Surat Masuk -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            Statistik Surat Masuk Bulanan
        </div>
        <div class="card-body">
            <canvas id="chartSuratMasuk" width="400" height="150"></canvas>
        </div>
    </div>

    <!-- Grafik Surat Keluar -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            Statistik Surat Keluar Bulanan
        </div>
        <div class="card-body">
            <canvas id="chartSuratKeluar" width="400" height="150"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var chartLabels = {!! json_encode($data['labels']) !!};
    var chartDataSuratMasuk = {!! json_encode($data['valuesSuratMasuk']) !!};
    var chartDataSuratKeluar = {!! json_encode($data['valuesSuratKeluar']) !!};

    // Grafik Surat Masuk
    var ctxMasuk = document.getElementById('chartSuratMasuk').getContext('2d');
    var chartSuratMasuk = new Chart(ctxMasuk, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Surat Masuk',
                data: chartDataSuratMasuk,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafik Surat Keluar
    var ctxKeluar = document.getElementById('chartSuratKeluar').getContext('2d');
    var chartSuratKeluar = new Chart(ctxKeluar, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Jumlah Surat Keluar',
                data: chartDataSuratKeluar,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
