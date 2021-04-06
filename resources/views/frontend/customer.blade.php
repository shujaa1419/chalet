@extends('layouts.app')
@section('content')
    <section class="wn_contact_area bg--white pt--80 pb--80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="contact-form-wrap">
                        <h2 class="contact__title">{{__('frontend.Reserve your own chalet')}}</h2>
                        <p></p>
                        <form id="contact-form" action="{{route('chalet.frontend.add_customer')}}" method="post">
                            @csrf
                            <div class="single-contact-form">
                                <input type="text" name="name" value="{{old('name')}}" placeholder="Name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="single-contact-form space-between">
                                <input type="email" name="email" value="{{old('email')}}" placeholder="Email">
                                <input type="text" name="mobile" value="{{old('mobile')}}" placeholder="Mobile">
                            </div>
                            <div class="single-contact-form space-between">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="single-contact-form">
                                {!! Form::label('chalet_id', 'chalet_id') !!}
                                {!! Form::select('chalet_id', ['' => '---'] + $chalets->toArray(), old('chalet_id'), ['class' => 'form-control']) !!}
                                @error('chalet_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="single-contact-form space-between">
                                <input type="date" name="cin" value="{{old('cin')}}">
                                <input type="date" name="cout" value="{{old('cout')}}">
                            </div>
                            <div class="single-contact-form space-between">
                                @error('cin')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                @error('cout')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="contact-btn">
                                <button type="submit">{{__('frontend.Reserve')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
                    <div class="wn__address">
                        <h2 class="contact__title">{{__('frontend.Get office info.')}}</h2>
                        <p>{{__('frontend.Welcome to Chalite, the best site for booking chalets in Saudi Arabia. To contact us, please use the addresses below.')}} </p>
                        <div class="wn__addres__wreapper">

                            <div class="single__address">
                                <i class="icon-location-pin icons"></i>
                                <div class="content">
                                    <span>{{__('frontend.address:')}}</span>
                                    <p>{{__('frontend.2333 al bashur - al hamra RIYADH , SA, Kingdom of Saudi Arabia')}}</p>
                                </div>
                            </div>

                            <div class="single__address">
                                <i class="icon-phone icons"></i>
                                <div class="content">
                                    <span>{{__('frontend.Phone Number:')}}</span>
                                    <p>+966-56-006-8004</p>
                                </div>
                            </div>

                            <div class="single__address">
                                <i class="icon-envelope icons"></i>
                                <div class="content">
                                    <span>{{__('frontend.Email address:')}}</span>
                                    <p>shujaa.work@gmail.com</p>
                                </div>
                            </div>

                            <div class="single__address">
                                <i class="icon-globe icons"></i>
                                <div class="content">
                                    <span>{{__('frontend.website address:')}}</span>
                                    <p>http://cryptic-anchorage-68736.herokuapp.com/</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
