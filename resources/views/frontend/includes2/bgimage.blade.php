    <section class="about_hero bgimage">
        <div class="bg_image_holder">
            <img src="{{ asset('/pro/img/banner2.jpg') }}" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="about_hero_contents">
                        <h1 class="display-4">@lang('labels.frontend.auth.welcome_to')
                            <span>Aquática Azul</span>
                        </h1>
                        <p class="display-4">{{-- We Help Marketers Build Products --}}</p>
                        <div class="about_hero_btns">
                            {{-- <a href="https://www.youtube.com/watch?v=ElINqEyx7GM" class="play_btn btn btn--lg btn-primary video-iframe">
                                <span class="icon-control-play"></span> @lang('navs.frontend.bgimage.play_quick')</a> --}}
                            @guest
                            <a href="{{route('frontend.auth.register')}}" class="btn btn-light btn--lg">@lang('navs.frontend.bgimage.join_us_today')</a>
                            @endguest
                        </div>
                    </div><!-- end .about_hero_contents -->
                </div><!-- end .col-md-12 -->
            </div><!-- end .row-->
        </div><!-- end .container -->
    </section><!-- ends: .about_hero -->


    <section class="about_mission">