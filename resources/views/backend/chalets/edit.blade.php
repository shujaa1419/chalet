@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit chalet ({{ $chalet->title }})</h6>
            <div class="ml-auto">
                <a href="{{ route('dashboard.chalets.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Chalets</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            {!! Form::model($chalet, ['route' => ['dashboard.chalets.update', $chalet->id], 'method' => 'patch', 'files' => true]) !!}
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', old('title', $chalet->title), ['class' => 'form-control']) !!}
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::textarea('description', old('description', $chalet->description), ['class' => 'form-control summernote']) !!}
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    {!! Form::label('category_id', 'category_id') !!}
                    {!! Form::select('category_id', ['' => '---'] + $categories->toArray(), old('category_id', $chalet->category_id), ['class' => 'form-control']) !!}
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-4">
                    {!! Form::label('city_id', 'city_id') !!}
                    {!! Form::select('city_id', ['' => '---'] + $cities->toArray(), old('city_id', $chalet->city_id), ['class' => 'form-control']) !!}
                    @error('city_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="col-4">
                    {!! Form::label('status', 'status') !!}
                    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status', $chalet->status), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('Sliders', 'images') !!}
                    <br>
                    <div class="file-loading">
                        {!! Form::file('images[]', ['id' => 'chalet-images', 'class' => 'file-input-overview', 'multiple' => 'multiple']) !!}
                        <span class="form-text text-muted">Image width should be 800px x 500px</span>
                        @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                {!! Form::submit('Update chalet', ['class' => 'btn btn-primary']) !!}
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

            $('#chalet-images').fileinput({
                theme: "fas",
                maxFileCount: {{ 5 - $chalet->media->count() }},
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($chalet->media->count() > 0)
                        @foreach($chalet->media as $media)
                        "{{ asset('assets/chalets/' . $media->file_name) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($chalet->media->count() > 0)
                        @foreach($chalet->media as $media)
                    {caption: "{{ $media->file_name }}", size: {{ $media->file_size }}, width: "120px", url: "{{ route('dashboard.chalet.media.destroy', [$media->id, '_token' => csrf_token()]) }}", key: "{{ $media->id }}"},
                    @endforeach
                    @endif
                ],
            });
        });
    </script>
@endsection
