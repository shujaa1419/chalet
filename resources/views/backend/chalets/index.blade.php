@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Chalets</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.chalets.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new chalet</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>City</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($chalets as $chalet)
                    <tr>
                        <td><a href="{{ route('dashboard.chalets.show', $chalet->id) }}">{{ $chalet->title }}</a></td>
                        <td>{{$chalet->comments_count}}</td>
                        <td>{{ $chalet->status() }}</td>
                        <td>{{ $chalet->category->name }}</a></td>
                        <td>{{ $chalet->city->name }}</a></td>
                        <td>{{ $chalet->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('dashboard.chalets.edit', $chalet->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this chalet?') ) { document.getElementById('chalet-delete-{{ $chalet->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('dashboard.chalets.destroy', $chalet->id) }}" method="post" id="chalet-delete-{{ $chalet->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No chalets found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="float-right">
                            {!! $chalets->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection
