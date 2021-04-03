@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit comment</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.comments.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Comments</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            {!! Form::model($comment, ['route' => ['dashboard.comments.update', $comment->id], 'method' => 'patch']) !!}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('comment', 'Comment') !!}
                        {!! Form::textarea('comment', old('comment', $comment->comment), ['class' => 'form-control summernote']) !!}
                </div>
            </div>

                <div class="col-4">
                    {!! Form::label('status', 'status') !!}
                    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status', $comment->status), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>


            <div class="form-group pt-4">
                {!! Form::submit('Update comment', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

        });
    </script>
@endsection
