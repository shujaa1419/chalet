@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary"> Customers</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->mobile }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('dashboard.customers.show', $customer->id) }}"
                                   class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="javascript:void(0)"
                                   onclick="if (confirm('Are you sure to delete this customer?') ) { document.getElementById('customer-delete-{{ $customer->id }}').submit(); } else { return false; }"
                                   class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('dashboard.customers.destroy', $customer->id) }}" method="post"
                                      id="message-delete-{{ $customer->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Customers found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $customers->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection
