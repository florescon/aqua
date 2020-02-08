@extends('frontend.layouts.app2')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
    
    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-contents">
                        <h2 class="page-title">@lang('labels.frontend.auth.register_box_title')</h2>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="#">@lang('navs.general.home')</a>
                                </li>
                                <li class="active">
                                    <a href="#">@lang('labels.frontend.auth.register_box_title')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end .col-md-12 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .breadcrumb-area -->

<section class="signup_area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    {{ html()->form('POST', route('frontend.auth.register.post'))->open() }}
                    @csrf
                        <div class="cardify signup_form">
                            <div class="login--header">
                                <h3>@lang('validation.attributes.frontend.create_account')</h3>
                                <p>@lang('validation.attributes.frontend.please_fill_')
                                </p>
                            </div><!-- end .login_header -->

                            <div class="container p-top-10">
                                @include('includes.partials.messages')
                            </div>

                            <div class="login--form">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}
                                    {{ html()->text('first_name')
                                        ->class('text_field')
                                        ->placeholder(__('validation.attributes.frontend.first_name'))
                                        ->attribute('maxlength', 191)
                                        ->required()}}
                                </div>

                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}
                                    {{ html()->text('last_name')
                                        ->class('text_field')
                                        ->placeholder(__('validation.attributes.frontend.last_name'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div>

                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
                                    {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div>
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                                    {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div>

                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                    {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div>

                                @if(config('access.captcha.registration'))
                                    <div class="row">
                                        <div class="col">
                                            @captcha
                                            {{ html()->hidden('captcha_status', 'true') }}
                                        </div><!--col-->
                                    </div><!--row-->
                                @endif
                                
                                {{ form_submit(__('labels.frontend.auth.register_button')) }}


                                <div class="login_assist">
                                    <p>@lang('validation.attributes.frontend.already_have_')
                                        <a href="login.html">@lang('labels.frontend.auth.login_box_title')</a>
                                    </p>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            {!! $socialiteLinks !!}
                                        </div>
                                    </div><!--/ .col -->
                                </div><!-- / .row -->

                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    {{ html()->form()->close() }}
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .signup_area -->
@endsection

@push('after-scripts')
    @if(config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush
