    <section class="bgcolor p-top-100 p-bottom-40">
        <div class="shortcode_wrapper">
            <div class="container">
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>Nuestro <span class="highlighted">equipo de trabajo</span></h1>
                    </div>
                </div><!-- ends: .col-md-12 -->
            </div><!-- ends: .row -->
                <div class="row">
                    @foreach($staff as $sta)
                    <div class="col-lg-3 col-md-6">

                        <div class="team-single">
                            <figure>
                                  @if(File::exists(public_path("/images/staff/".$sta->image)))
                                    <img src="{{ asset('/images/staff/' . $sta->image) }}" alt="" class="img-fluid rounded-circle">
                                  @endif
                                <figcaption>
                                    <h5>{{ ucwords(strtolower($sta->name)) }}</h5>
                                    <span class="member-title">{{ ucwords(strtolower($sta->job)) }}</span>
                                    <ul class="list-unstyled team-social">
                                        {{-- <li>
                                            <a href="#">
                                                <span class="icon-envelope-open"></span>
                                            </a>
                                        </li> --}}
                                        @if($sta->facebook)
                                        <li>
                                            <a href="{{ $sta->facebook }}" target="_blank">
                                                <span class="icon-social-facebook"></span>
                                            </a>
                                        </li>
                                        @endif
                                        @if($sta->twitter)
                                        <li>
                                            <a href="{{ $sta->twitter }}" target="_blank">
                                                <span class="icon-social-twitter"></span>
                                            </a>
                                        </li>
                                        @endif
                                        @if($sta->instagram)
                                        <li>
                                            <a href="{{ $sta->instagram }}" target="_blank">
                                                <span class="icon-social-instagram"></span>
                                            </a>
                                        </li>
                                        @endif
                                        @if($sta->youtube)
                                        <li>
                                            <a href="{{ $sta->youtube }}" target="_blank">
                                                <span class="icon-social-youtube"></span>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </figcaption>
                            </figure>
                        </div><!-- ends: .team-single -->

                    </div><!-- ends: .col-lg-3 -->
                    @endforeach

                </div>
            </div><!-- end .container -->
        </div><!-- ends: .shortcode_wrapper -->
    </section>
