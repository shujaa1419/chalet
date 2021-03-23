@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $comment->name }}</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.comments.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Comments</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Author</th>
                    <td>{{ $comment->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $comment->email }}</td>
                </tr>
                <tr>
                    <th>Comment</th>
                    <td>{!! $comment->comment !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
