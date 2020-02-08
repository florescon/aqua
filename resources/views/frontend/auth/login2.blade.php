@extends('frontend.layouts.app2')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')

    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-contents">
                        <h2 class="page-title">@lang('labels.frontend.auth.login_box_title')</h2>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="#">@lang('navs.general.home')</a>
                                </li>
                                <li class="active">
                                    <a href="#">@lang('labels.frontend.auth.login_box_title')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end .col-md-12 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .breadcrumb-area -->


{{--    <section class="bgcolor p-top-20 p-bottom-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="shortcode_modules">
                        
                        <div class="alert alert-primary" role="alert">
                            <strong>Hello World!</strong> This is default alert message box style.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="icon-close" aria-hidden="true"></span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
 --}}

    <section class="login_area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>@lang('validation.attributes.frontend.welcome_back')</h3>
                                <p>@lang('labels.frontend.auth.login_box_title')</p>
                            </div><!-- end .login_header -->
                            <div class="container p-top-10">
                                @include('includes.partials.messages')
                            </div>
                            <div class="login--form">
                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                                    {{ html()->email('email')
                                        ->class('text_field')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}

                                </div>

                                <div class="form-group">
                                    {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                                    {{ html()->password('password')
                                        ->class('text_field')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div>

                                <div class="form-group">
                                    <div class="custom_checkbox">
                                        <input type="checkbox" id="ch2">
                                        <label for="ch2">
                                            <span class="shadow_checkbox"></span>
                                            {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                        </label>
                                    </div>
                                </div>

                                {{-- <button class="btn btn--md btn-primary" type="submit">Login Now</button> --}}
                                {{ form_submit(__('labels.frontend.auth.login_button')) }}

                                <div class="login_assist">
                                    <p class="recover">
                                        <a href="{{ route('frontend.auth.password.reset') }}">
                                            @lang('labels.frontend.passwords.forgot_password')
                                        </a>
                                    </p>
                                    <p class="signup">
                                        <a href="{{ route('frontend.auth.register') }}">@lang('labels.frontend.auth.register_box_title')</a></p>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-center">
                                            {!! $socialiteLinks !!}
                                        </div>
                                    </div><!--col-->
                                </div><!--row-->

                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    {{ html()->form()->close() }}


                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .login_area -->
@endsection
