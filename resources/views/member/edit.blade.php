@extends('layouts.base')

@section('title', 'Edit Member')

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
                    <form action="{{ route('member.update', $member) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $member->name }}" autofocus required>
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" @if($member->gender == 'Male') checked @endif>
                                <label class="form-check-label">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female" @if($member->gender == 'Female') checked @endif>
                                <label class="form-check-label">Female</label>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="num" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $member->phone }}" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="float-right">
                            <button type="reset" class="btn btn-outline-danger">Reset</button>
                            <button type="submit" class="btn btn-outline-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
