@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            <div class="ml-auto">
                <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new category</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</a></td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this category?') ) { document.getElementById('category-delete-{{ $category->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post" id="category-delete-{{ $category->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No categories found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="float-right">
                            {!! $categories->links() !!}

                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection
