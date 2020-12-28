@extends('layouts.base')

@section('title', 'Show Transaction')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Member
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th width="20%">Name</th>
                                <td>{{ $transaction->member->name }}</td>
                            </tr>
                            <tr>
                                <th width="20%">Gender</th>
                                <td>{{ $transaction->member->gender }}</td>
                            </tr>
                            <tr>
                                <th width="20%">Phone</th>
                                <td>{{ $transaction->member->phone }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Book
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th width="20%">Title</th>
                                <td>{{ $transaction->book->title }}</td>
                            </tr>
                            <tr>
                                <th width="20%">Author</th>
                                <td>{{ $transaction->book->author }}</td>
                            </tr>
                            <tr>
                                <th width="20%">Publisher</th>
                                <td>{{ $transaction->book->publisher }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Transaction
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Return Date</th>
                                <td>{{ $transaction->return }}</td>
                            </tr>
                            @if($transaction->status == 'overdue')
                                <tr>
                                    <th width="40%">Fine</th>
                                    <td>@rupiah($transaction->fine)</td>
                                </tr>
                            @endif
                            <tr>
                                <th width="40%">Status</th>
                                <td>{!! $transaction->status_display !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($transaction->status == 'active')
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('return-book').submit();">Return Book</button>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('cancel-transaction').submit();">Cancel Transaction</button>
                </div>
                <form id="return-book" class="d-none" method="POST" action="{{ route('transaction.return', $transaction) }}">
                    @csrf
                    @method('PUT')
                </form>
                <form id="cancel-transaction" class="d-none" method="POST" action="{{ route('transaction.cancel', $transaction) }}">
                    @csrf
                    @method('PUT')
                </form>
            </div>
        </div>
    @endif
@endsection
