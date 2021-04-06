@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Chalet ({{ $chalet->title }})</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.chalets.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Chalets</span>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <td colspan="4"><a href="{{ route('dashboard.chalets.show', $chalet->id) }}">{{ $chalet->title }}</a></td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td>{{ $chalet->comments->count()  }}</td>
                    <th>Status</th>
                    <td>{{ $chalet->status() }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $chalet->category->name }}</td>
                    <th>City</th>
                    <td>{{ $chalet->city->name }}</td>
                </tr>
                <tr>
                    <th>Created date</th>
                    <td>{{ $chalet->created_at->format('d-m-Y h:i a') }}</td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="row">
                            @if($chalet->media->count() > 0)
                                @foreach($chalet->media as $media)
                                    <div class="col-2">
                                        <img src="{{ asset('assets/chalets/' . $media->file_name) }}" class="img-fluid">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Comments</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Author</th>
                    <th width="40%">comment</th>
                    <th>Status</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($chalet->comments as $comment)
                    <tr>
                        <td>{{ $comment->name }}</td>
                        <td>{!! $comment->comment !!}</td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y h:i a') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No comments found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
