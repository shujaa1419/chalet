@extends('layouts.app')
@section('content')
    <div class="page-blog-details section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="blog-details content">
                        <article class="blog-post-details">
                            <div class="post_wrapper">
                                <div class="post_header">
                                    <h2>{{__('frontend.About Us')}}</h2>
                                </div>
                                <div class="post_content">
                                    <p>{{__('frontend.Hello')}}</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
