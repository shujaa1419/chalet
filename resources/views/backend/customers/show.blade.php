@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $customer->name }}</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.customers.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Customers</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $customer->email }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $customer->mobile }}</td>
                </tr>
                <tr>
                    <th>Chalet</th>
                    <td>{{$customer->chalet->title}}</td>
                </tr>
                <tr>
                    <th>Check in</th>
                    <td>{{$customer->cin}}</td>
                </tr>
                <tr>
                    <th>Check out</th>
                    <td>{{$customer->cout}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
