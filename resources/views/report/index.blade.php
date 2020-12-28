@extends('layouts.base')

@section('title', 'Reports')

@section('content')
    <div class="row">
        <div class="offset-md-3 col-md-6">
            @if(session()->has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="offset-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('report.download') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Month</label>
                            <input type="month" class="form-control" name="month" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-block btn-outline-info">Generate Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
