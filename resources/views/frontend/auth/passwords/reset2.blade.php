@extends('frontend.layouts.app2')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')

    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-contents">
                        <h2 class="page-title">@lang('labels.frontend.passwords.reset_password_box_title')</h2>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="#">@lang('navs.general.home')</a>
                                </li>
                                <li class="active">
                                    <a href="#">@lang('labels.frontend.passwords.reset_password_box_title')</a>
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
                    {{ html()->form('POST', route('frontend.auth.password.reset'))->class('form-horizontal')->open() }}
                        {{ html()->hidden('token', $token) }}

                        <div class="cardify signup_form">
                            <div class="login--header">
                                <h3>@lang('labels.frontend.passwords.reset_password_box_title')</h3>
                            </div><!-- end .login_header -->

                            <div class="login--form">

                                @if(session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="p-top-10">
                                    @include('includes.partials.messages')
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

                                    {{ form_submit(__('labels.frontend.passwords.reset_password_button')) }}

                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                    {{ html()->form()->close() }}
                </div><!-- end .col-md-6 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .signup_area -->



@endsection
