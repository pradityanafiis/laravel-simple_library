@extends('layouts.base')

@section('title', 'Home')

@push('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="small-box bg-gradient-navy">
                <div class="inner">
                    <h3>{{ $books }}</h3>

                    <p>Books</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{ route('book.index') }}" class="small-box-footer">Manage Books <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-gradient-navy">
                <div class="inner">
                    <h3>{{ $members }}</h3>

                    <p>Members</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('member.index') }}" class="small-box-footer">Manage Members <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-box bg-gradient-navy">
                <div class="inner">
                    <h3>{{ $transactions }}</h3>

                    <p>Transactions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <a href="{{ route('transaction.index') }}" class="small-box-footer">Manage Transactions <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Last 30 Days (Number of Transactions)
                </div>
                <div class="card-body">
                    <canvas id="number-of-transactions-chart">

                    </canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Last 30 Days (Total Fines)
                </div>
                <div class="card-body">
                    <canvas id="total-fines-chart">

                    </canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
    <script>
        const numberOfTransaction = document.getElementById('number-of-transactions-chart');
        const totalFines = document.getElementById('total-fines-chart');
        const firstChart = new Chart(numberOfTransaction, {
            type: 'line',
            data: {
                labels: {!! $labels !!},
                datasets: [
                    {
                        label: 'Number of Transactions',
                        data: {!! $numberOfTransactions !!},
                        borderColor: 'rgb(0, 31, 63)',
                        fill: false
                    }
                ]
            }
        })
        const secondChart = new Chart(totalFines, {
            type: 'line',
            data: {
                labels: {!! $labels !!},
                datasets: [
                    {
                        label: 'Total Fines',
                        data: {!! $totalFines !!},
                        borderColor: 'rgb(0, 31, 63)',
                        fill: false
                    }
                ]
            }
        })
    </script>
@endpush
