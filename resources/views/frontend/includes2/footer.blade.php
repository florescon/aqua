    <footer class="footer-area footer--light">
        <div class="footer-big">
            <!-- start .container -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">

                            <div class="widget-about">
                                <img src=" {{ asset('/pro/img/aquaticazul162.png') }}" alt="" class="img-fluid">
                                <p>Nadar es mi pasión.</p>
                                <ul class="contact-details">
                                    <li>
                                        <span class="icon-earphones"></span>
                                        @lang('navs.frontend.call_us'):
                                        <a href="tel:4747421696">474 742 1696</a>
                                    </li>
                                    {{-- <li>
                                        <span class="icon-envelope-open"></span>
                                        <a href="mailto:support@aazztech.com">support@aazztech.com</a>
                                    </li> --}}
                                </ul>
                            </div>

                        </div>
                        <!-- Ends: .footer-widget -->
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-menu footer-menu--1">
                                <h5 class="footer-widget-title">Acceso directo</h5>
                                <ul>
                                    @guest
                                    <li>
                                        <a href="{{route('frontend.auth.login')}}">@lang('navs.frontend.login')</a>
                                    </li>
                                    <li>
                                        <a href="{{route('frontend.auth.register')}}">@lang('navs.frontend.register')</a>
                                    </li>
                                    @endguest
                                    <li>
                                        <a href="{{route('frontend.contact')}}">@lang('navs.frontend.contact')</a>
                                    </li>
                                    {{-- <li>
                                        <a href="#">Admin Template</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML Template</a>
                                    </li> --}}
                                </ul>
                            </div>
                            <!-- end /.footer-menu -->
                        </div>
                        <!-- Ends: .footer-widget -->
                    </div>
                    <!-- end /.col-md-3 -->

                    @if(App\CmsPage::whereType('2')->count())
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-menu">
                                <h5 class="footer-widget-title">Nosotros</h5>
                                <ul>
                                    @foreach(App\CmsPage::orderBy('updated_at','asc')->whereType('2')->get() as $menuFooterUs)
                                    <li>
                                        <a href="#">{{ $menuFooterUs->page_title }}</a>
                                    </li>
                                    @endforeach
                                    {{-- <li>
                                        <a href="#">How It Works</a>
                                    </li>
                                    <li>
                                        <a href="#">Affiliates</a>
                                    </li>
                                    <li>
                                        <a href="#">Testimonials</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="#">Plan & Pricing</a>
                                    </li>
                                    <li>
                                        <a href="#">Blog</a> --}}
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.footer-menu -->
                        </div>
                        <!-- Ends: .footer-widget -->
                    </div>
                    <!-- end /.col-lg-3 -->
                    @endif
                    @if(App\CmsPage::whereType('1')->count())
                    <div class="col-lg-3 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-menu no-padding">
                                <h5 class="footer-widget-title">Soporte de ayuda</h5>
                                <ul>
                                    @foreach(App\CmsPage::orderBy('updated_at','asc')->whereType('1')->get() as $menuFooterSupport)
                                    <li>
                                        <a href="{{ route('frontend.page.show', $menuFooterSupport) }}">{{ $menuFooterSupport->page_title }}</a>
                                    </li>
                                    @endforeach
                                    {{-- <li>
                                        <a href="#">Refund Policy</a>
                                    </li>
                                    <li>
                                        <a href="#">FAQs</a>
                                    </li>
                                    <li>
                                        <a href="#">Buyers Faq</a>
                                    </li>
                                    <li>
                                        <a href="#">Sellers Faq</a>
                                    </li> --}}
                                </ul>
                            </div>
                            <!-- end /.footer-menu -->
                        </div>
                        <!-- Ends: .footer-widget -->
                    </div>
                    <!-- Ends: .col-lg-3 -->
                    @endif
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.footer-big -->

        <div class="mini-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text">
                            <p>&copy; {{ now()->year }}
                                <a href="#">Aquática azul</a>. @lang('navs.frontend.copyright') @lang('navs.frontend.created_with') <i class="fa fa-heart text-danger"></i>
                            </p>
                        </div>

                        <div class="go_top">
                            <span class="icon-arrow-up"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
