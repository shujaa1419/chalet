@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $message->title }}</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.contacts.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Messages</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Title</th>
                    <td>{{ $message->title }}</td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td>{{ $message->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $message->email }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{!! $message->message !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
