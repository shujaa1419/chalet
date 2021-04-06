@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-12">
        <div class="blog-page">
            @forelse($all_chalets as $chalet)
                <article class="blog__post d-flex flex-wrap">
                    <div class="thumb">
                        <a href="{{route('chalet.frontend.show',$chalet->id)}}">
                            @if($chalet->media->count() > 0)
                                <img src="{{ asset('assets/chalets/' . $chalet->media->first()->file_name) }}" alt="{{ $chalet->title }}">
                            @else
                                <img src="{{ asset('assets/chalets/default.jpg') }}" alt="blog images">
                            @endif
                        </a>
                    </div>
                    <div class="content">
                        <h4><a href="{{route('chalet.frontend.show',$chalet->id)}}">{{ $chalet->title }}</a></h4>
                        <ul class="post__meta">
                            <li>{{ $chalet->created_at->format('M d Y') }}</li>
                        </ul>
                        <p>{!! \Illuminate\Support\Str::limit($chalet->description, 145, '...') !!}</p>
                        <div class="blog__btn">
                            <a href="{{route('chalet.frontend.show',$chalet->id)}}">{{__('frontend.read more')}}</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-center">{{__('frontend.No Chalets found')}}</div>
            @endforelse
                {!! $all_chalets->appends(request()->input())->links() !!}

        </div>
    </div>

    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.sidebar')
    </div>
@endsection
