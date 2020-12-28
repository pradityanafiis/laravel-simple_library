@extends('layouts.base')

@section('title', 'Transactions')

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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Book</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $transaction)
                                <tr>
                                    <td>{{ $transaction->member->name }}</td>
                                    <td>{{ $transaction->book->title }}</td>
                                    <td>{{ $transaction->return }}</td>
                                    <td>{!! $transaction->status_display !!}</td>
                                    <td>
                                        <a href="{{ route('transaction.show', $transaction) }}" class="btn btn-outline-info"><i class="fas fa-external-link-alt"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No active transactions found!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
