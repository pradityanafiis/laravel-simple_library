@extends('layouts.base')

@section('title', 'Members')

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
                                <th>Gender</th>
                                <th>Phone</th>
                                <th width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $member)
                                <tr>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->gender }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>
                                        <a href="{{ route('member.edit', $member) }}" class="btn btn-outline-info"><i class="fas fa-edit"></i></a>
                                        <form class="d-inline" method="POST" action="{{ route('member.destroy', $member) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No members found!</td>
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
