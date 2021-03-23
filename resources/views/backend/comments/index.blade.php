@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
            <div class="ml-auto">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Author</th>
                    <th>email</th>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Chalet</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{ $comment->comment }}</td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ $comment->chalet->title }}</a></td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('dashboard.comments.show', $comment->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('dashboard.comments.edit', $comment->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this comment?') ) { document.getElementById('comment-delete-{{ $comment->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('dashboard.comments.destroy', $comment->id) }}" method="post" id="comment-delete-{{ $comment->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No comments found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="float-right">
                            {!! $comments->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection
