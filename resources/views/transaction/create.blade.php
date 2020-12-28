@extends('layouts.base')

@push('stylesheet')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('title', 'Create Transaction')

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
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Member</label>
                            <select name="member" class="form-control @error('member') is-invalid @enderror" id="select2member" style="width: 100%;">
                                <option></option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                            @error('member')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Book</label>
                            <select name="book" class="form-control @error('book') is-invalid @enderror" id="select2book" style="width: 100%;">
                                <option></option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                            @error('book')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Period</label>
                            <input type="range" name="period" class="custom-range custom-range-navy" min="1" max="7" value="4">
                        </div>
                        <div class="float-right">
                            <button type="reset" class="btn btn-outline-danger">Reset</button>
                            <button type="submit" class="btn btn-outline-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#select2member').select2({
                theme: "bootstrap4",
                placeholder: "Select a member",
            });
            $('#select2book').select2({
                theme: "bootstrap4",
                placeholder: "Select a book",
            });
        });
    </script>
@endpush

