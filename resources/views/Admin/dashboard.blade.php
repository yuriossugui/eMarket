@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('content')

<div class="d-flex justify-content-center mb-4">
    <h2>Dashboard</h2>
</div>

<div class="container">
    <div class="row">
        <!-- Gráfico de Quantidade em Estoque -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Produtos por Quantidade em Estoque
                </div>
                <div class="card-body">
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Gráfico de Valor em Estoque -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    Produtos por Valor em Estoque
                </div>
                <div class="card-body">
                    <canvas id="valueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const products = @json(json_decode($products));

        const labels = products.map(p => p.name);
        const stockData = products.map(p => p.stock);
        const valueData = products.map(p => p.stock * p.price);

        // Gráfico de Estoque
        const stockChart = new Chart(document.getElementById('stockChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantidade em Estoque',
                    data: stockData,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Gráfico de Valor
        const valueChart = new Chart(document.getElementById('valueChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Valor em Estoque (R$)',
                    data: valueData,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection