@extends('frontend.layouts.app2')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('content')

    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-contents">
                        <h2 class="page-title">@lang('labels.frontend.contact.box_title')</h2>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="#">@lang('navs.general.home')</a>
                                </li>
                                <li class="active">
                                    <a href="#">@lang('labels.frontend.contact.box_title')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end .col-md-12 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .breadcrumb-area -->

    <section class="contact-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h1><span class="highlighted">@lang('validation.attributes.frontend.how_can_we_')</span></h1>
                                {{-- <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis
                                    fugats. Lid est laborum dolo rumes fugats untras.</p> --}}
                            </div>
                        </div><!-- ends: .col-md-12 -->
                    </div><!-- ends: .row -->

                    <div class="row">
                        <div class="col-md-4">
                            
    <div class="contact_tile">
        <span class="tiles__icon icon-location-pin"></span>
        <h4 class="tiles__title">@lang('validation.attributes.frontend.address')</h4>
        <div class="tiles__content">
            <p>
Hernando de Martel (Interior calle de los naranjos) #30
47400 Lagos de Moreno</p>
        </div>
    </div><!-- ends: .contact_tile -->

                        </div><!-- ends: col-md-4 -->

                        <div class="col-md-4">
                            
    <div class="contact_tile">
        <span class="tiles__icon icon-earphones"></span>
        <h4 class="tiles__title">@lang('validation.attributes.frontend.phone')</h4>
        <div class="tiles__content">
            <p><p>474 742 1696</p></p>
        </div>
    </div><!-- ends: .contact_tile -->

                        </div><!-- ends: col-md-4 -->

                        <div class="col-md-4">
                            
    <div class="contact_tile">
        <span class="tiles__icon icon-envelope-open"></span>
        <h4 class="tiles__title">@lang('validation.attributes.frontend.email')</h4>
        <div class="tiles__content">
            <p><p></p> <p></p></p>
        </div>
    </div><!-- ends: .contact_tile -->

                        </div><!-- ends: .col-md-4 -->

                        <div class="col-md-12">
                            <div class="contact_form cardify">
                                <div class="contact_form__title">
                                    <h2>@lang('validation.attributes.frontend.leave_your_')</h2>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="container p-top-10">
                                            @include('includes.partials.messages')
                                        </div>
                                        
                                        <div class="contact_form--wrapper">
                                            {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            {{ html()->text('name', optional(auth()->user())->name)
                                                            ->class('form-control')
                                                            ->placeholder(__('validation.attributes.frontend.name'))
                                                            ->attribute('maxlength', 191)
                                                            ->autofocus()
                                                            ->required() }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            {{ html()->text('phone')
                                                            ->class('form-control')
                                                            ->placeholder(__('validation.attributes.frontend.phone'))
                                                            ->attribute('maxlength', 191)
                                                            ->required() }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            {{ html()->email('email', optional(auth()->user())->email)
                                                            ->class('form-control')
                                                            ->placeholder(__('validation.attributes.frontend.email'))
                                                            ->attribute('maxlength', 191)
                                                            ->required() }}
                                                        </div>
                                                    </div>
                                                </div>

                                                {{ html()->textarea('message')
                                                ->class('form-control')
                                                ->placeholder(__('validation.attributes.frontend.message'))
                                                ->attribute('rows', 3)
                                                ->required() }}

                                                @if(config('access.captcha.contact'))
                                                    <div class="row">
                                                        <div class="col">
                                                            @captcha
                                                            {{ html()->hidden('captcha_status', 'true') }}
                                                        </div><!--col-->
                                                    </div><!--row-->
                                                @endif


                                                <div class="sub_btn">
                                                    {{ form_submit(__('labels.frontend.contact.button')) }}
                                                </div>
                                            {{ html()->form()->close() }}
                                        </div>
                                    </div><!-- ends: .col-md-8 -->
                                </div><!-- ends: .row -->
                            </div><!-- ends: .contact_form -->
                        </div><!-- ends: .col-md-12 -->
                    </div>
                </div>
            </div>
        </div><!-- ends: .container -->
    </section><!-- ends: .contact-area -->
@endsection

@push('after-scripts')
    @if(config('access.captcha.contact'))
        @captchaScripts
    @endif
@endpush