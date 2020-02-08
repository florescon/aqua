    <!-- start menu-area -->
    <div class="menu-area">
        <div class="top-menu-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-fullwidth">
                            <div class="logo-wrapper">
                                <div class="logo logo-top">
                                    <a href="{{ url('/') }}"><img src=" {{ asset('/pro/img/aquaticazul162.png') }}" alt="logo image" width="75" class="img-fluid"></a>
                                </div>
                            </div>

                            <div class="menu-container">
                                <div class="d_menu">
                                    
                                    <nav class="navbar navbar-expand-lg mainmenu__menu">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1"
                                        aria-controls="bs-example-navbar-collapse-1"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon icon-menu"></span>
                                    </button>
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                        <ul class="navbar-nav">
                                            @if(config('locale.status') && count(config('locale.languages')) > 1)
                                            <li class="has_dropdown">
                                                <a href="#">({{ strtoupper(app()->getLocale()) }})</a>
                                                <div class="dropdown dropdown--menu">
                                                    @include('includes.partials.lang2')
                                                </div>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="{{ url('/') }}">@lang('navs.general.home')</a>
                                            </li>
                                            @if(App\Calendar::orderBy('updated_at')->count())
                                            <li>
                                                <a href="{{route('frontend.schedule')}}">@lang('navs.frontend.schedule')</a>
                                            </li>
                                            @endif
                                            @if(App\CmsPage::whereType('3')->count())
                                            <li class="has_dropdown">
                                                <a href="#">@lang('navs.frontend.pages')</a>
                                                <div class="dropdown dropdown--menu">
                                                    <ul>
                                                        @foreach(App\CmsPage::orderBy('updated_at','asc')->whereType('3')->get() as $menuItem)
                                                        <li>
                                                            <a href="{{ route('frontend.page.show', $menuItem) }}">{{ $menuItem->page_title }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="{{route('frontend.contact')}}">@lang('navs.frontend.contact')</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.navbar-collapse -->
                                </nav>

                            </div>
                        </div>

                            
    <div class="author-menu">
        <!-- start .author-area -->
        <div class="author-area">
            <div class="search-wrapper">
                <div class="nav_right_module search_module">
                    <span class="icon-magnifier search_trigger"></span>

                    <div class="search_area">
                        <form action="#">
                            <div class="input-group input-group-light">
                                <span class="icon-left" id="basic-addon1">
                                    <i class="icon-magnifier"></i>
                                </span>
                                <input type="text" class="form-control search_field"
                                       placeholder="Escribe unas palabras y enter...">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @guest     
            <div class="author__access_area">
                <ul class="d-flex">
                    <li><a href="{{route('frontend.auth.login')}}">@lang('navs.frontend.login')</a></li>
                </ul>
            </div>    
                <div class="text-center">
                    <a href="{{route('frontend.auth.register')}}" class="author-area__seller-btn inline">@lang('navs.frontend.register')</a>
                </div>
            @else
            {{-- <div class="author__notification_area">
                <ul>
                    <li class="has_dropdown">
                        <div class="icon_wrap">
                            <span class="icon-bell"></span>
                            <span class="notification_status noti"></span>
                        </div>

                        <div class="dropdown notification--dropdown">

                            <div class="dropdown_module_header">
                                <h6>My Notifications</h6>
                            </div>

                            <div class="notifications_module">
                                <div class="notification">
                                    <div class="notification__info">
                                        <div class="info_avatar">
                                            <img src=" {{ asset('/pro/img/notification_head.png') }}" alt="">
                                        </div>
                                        <div class="info">
                                            <p>
                                                <span>Anderson</span> added to Favourite
                                                <a href="#">Mccarther Coffee Shop</a>
                                            </p>
                                            <p class="time">Just now</p>
                                        </div>
                                    </div>
                                    <!-- end /.notifications -->

                                    <div class="notification__icons ">
                                        <span class="icon-heart loved noti_icon"></span>
                                    </div>
                                    <!-- end /.notifications -->
                                </div>
                                <!-- end /.notifications -->

                                <div class="notification">
                                    <div class="notification__info">
                                        <div class="info_avatar">
                                            <img src=" {{ asset('/pro/img/notification_head2.png') }}" alt="">
                                        </div>
                                        <div class="info">
                                            <p>
                                                <span>Michael</span> commented on
                                                <a href="#">DigiPro Extension Bundle</a>
                                            </p>
                                            <p class="time">Just now</p>
                                        </div>
                                    </div>
                                    <!-- end /.notifications -->

                                    <div class="notification__icons ">
                                        <span class="icon-bubble commented noti_icon"></span>
                                    </div>
                                    <!-- end /.notifications -->
                                </div>
                                <!-- end /.notifications -->

                                <div class="notification">
                                    <div class="notification__info">
                                        <div class="info_avatar">
                                            <img src=" {{ asset('/pro/img/notification_head3.png') }}" alt="">
                                        </div>
                                        <div class="info">
                                            <p>
                                                <span>Khamoka </span>purchased
                                                <a href="#"> Visibility Manager
                                                    Subscriptions</a>
                                            </p>
                                            <p class="time">Just now</p>
                                        </div>
                                    </div>
                                    <!-- end /.notifications -->

                                    <div class="notification__icons ">
                                        <span class="icon-basket-loaded purchased noti_icon"></span>
                                    </div>
                                    <!-- end /.notifications -->
                                </div>
                                <!-- end /.notifications -->

                                <div class="notification">
                                    <div class="notification__info">
                                        <div class="info_avatar">
                                            <img src=" {{ asset('/pro/img/notification_head4.png') }}" alt="">
                                        </div>
                                        <div class="info">
                                            <p>
                                                <span>Anderson</span> added to Favourite
                                                <a href="#">Mccarther Coffee Shop</a>
                                            </p>
                                            <p class="time">Just now</p>
                                        </div>
                                    </div>
                                    <!-- end /.notifications -->

                                    <div class="notification__icons "><span
                                                class="icon-star reviewed noti_icon"></span>
                                    </div>
                                    <!-- end /.notifications -->
                                </div>
                                <!-- end /.notifications -->
                                <div class="text-center m-top-30 p-left-20 p-right-20"><a
                                            href="notification.html"
                                            class="btn btn-primary btn-md btn-block">View
                                        All</a></div>
                                <!-- end /.notifications -->
                            </div>
                            <!-- end /.dropdown -->
                        </div>
                    </li>

                    <li class="has_dropdown">
                        <div class="icon_wrap">
                            <span class="icon-envelope-open"></span>
                            <span class="notification_status msg"></span>
                        </div>

                        <div class="dropdown messaging--dropdown">
                            <div class="dropdown_module_header">
                                <h6>My Messages</h6>
                            </div>

                            <div class="messages">
                                <a href="message.html" class="message recent">
                                    <div class="message__actions_avatar">
                                        <div class="avatar">
                                            <img src=" {{ asset('/pro/img/notification_head4.png') }}" alt="">
                                        </div>
                                    </div>
                                    <!-- end /.actions -->

                                    <div class="message_data">
                                        <div class="name_time">
                                            <div class="name">
                                                <p>NukeThemes</p>
                                                <span class="icon-envelope"></span>
                                            </div>

                                            <span class="time">Just now</span>
                                            <p>Hello John Smith! Nunc placerat mi ...</p>
                                        </div>
                                    </div>
                                    <!-- end /.message_data -->
                                </a>
                                <!-- end /.message -->

                                <a href="message.html" class="message recent">
                                    <div class="message__actions_avatar">
                                        <div class="avatar">
                                            <img src=" {{ asset('/pro/img/notification_head5.png') }}" alt="">
                                        </div>
                                    </div>
                                    <!-- end /.actions -->

                                    <div class="message_data">
                                        <div class="name_time">
                                            <div class="name">
                                                <p>Crazy Coder</p>
                                                <span class="icon-envelope"></span>
                                            </div>

                                            <span class="time">Just now</span>
                                            <p>Hi! Nunc placerat mi id nisi interum ...</p>
                                        </div>
                                    </div>
                                    <!-- end /.message_data -->
                                </a>
                                <!-- end /.message -->

                                <a href="message.html" class="message">
                                    <div class="message__actions_avatar">
                                        <div class="avatar">
                                            <img src=" {{ asset('/pro/img/notification_head2.png') }}" alt="">
                                        </div>
                                    </div>
                                    <!-- end /.actions -->

                                    <div class="message_data">
                                        <div class="name_time">
                                            <div class="name">
                                                <p>Hybrid Insane</p>
                                            </div>

                                            <span class="time">Just now</span>
                                            <p>Hi! Nunc placerat mi id nisi interum ...</p>
                                        </div>
                                    </div>
                                    <!-- end /.message_data -->
                                </a>
                                <!-- end /.message -->

                                <a href="message.html" class="message">
                                    <div class="message__actions_avatar">
                                        <div class="avatar">
                                            <img src=" {{ asset('/pro/img/notification_head3.png') }}" alt="">
                                        </div>
                                    </div>
                                    <!-- end /.actions -->

                                    <div class="message_data">
                                        <div class="name_time">
                                            <div class="name">
                                                <p>ThemeXylum</p>
                                            </div>

                                            <span class="time">Just now</span>
                                            <p>Hi! Nunc placerat mi id nisi interum ...</p>
                                        </div>
                                    </div>
                                    <!-- end /.message_data -->
                                </a>
                                <!-- end /.message -->

                                <a href="message.html" class="message">
                                    <div class="message__actions_avatar">
                                        <div class="avatar">
                                            <img src=" {{ asset('/pro/img/notification_head4.png') }}" alt="">
                                        </div>
                                    </div>
                                    <!-- end /.actions -->

                                    <div class="message_data">
                                        <div class="name_time">
                                            <div class="name">
                                                <p>NukeThemes</p>
                                                <span class="icon-envelope"></span>
                                            </div>

                                            <span class="time">Just now</span>
                                            <p>Hello John Smith! Nunc placerat mi ...</p>
                                        </div>
                                    </div>
                                    <!-- end /.message_data -->
                                </a>
                                <!-- end /.message -->
                            </div>
                            <div class="text-center m-top-30 m-bottom-30 p-left-20 p-right-20">
                                <a href="message.html"
                                   class="btn btn-primary btn-md btn-block">View All</a>
                            </div>
                        </div>
                    </li>
                    <li class="has_dropdown">
                        <div class="icon_wrap">
                            <span class="icon-basket-loaded"></span>
                            <span class="notification_count purch">2</span>
                        </div>

                        <div class="dropdown dropdown--cart">
                            <div class="cart_area">
                                <div class="cart_list">
                                    <div class="cart_product">
                                        <div class="product__info">
                                            <div class="thumbn">
                                                <img src=" {{ asset('/pro/img/capro1.jpg') }}"
                                                     alt="cart product thumbnail">
                                            </div>

                                            <div class="info">
                                                <a class="title" href="single-product.html">Finance
                                                    and Consulting Business Theme</a>
                                                <div class="cat">
                                                    <a href="#">
                                                        <img src=" {{ asset('/pro/img/catword.png') }}"
                                                             alt="">Wordpress</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product__action">
                                            <a href="#">
                                                <span class="icon-trash"></span>
                                            </a>
                                            <p>$60</p>
                                        </div>
                                    </div>
                                    <div class="cart_product">
                                        <div class="product__info">
                                            <div class="thumbn">
                                                <img src=" {{ asset('/pro/img/capro2.jpg') }}"
                                                     alt="cart product thumbnail">
                                            </div>

                                            <div class="info">
                                                <a class="title" href="single-product.html">Flounce
                                                    - Multipurpose OpenCart Theme</a>
                                                <div class="cat">
                                                    <a href="#">
                                                        <img src=" {{ asset('/pro/img/catword.png') }}"
                                                             alt="">Wordpress</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product__action">
                                            <a href="#">
                                                <span class="icon-trash"></span>
                                            </a>
                                            <p>$60</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="total">
                                    <p>
                                        <span>Total :</span>$80</p>
                                </div>
                                <div class="cart_action">
                                    <a class="btn btn-primary" href="cart.html">View
                                        Cart</a>
                                    <a class="btn btn-secondary" href="checkout.html">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> --}}
            <!--start .author-author__info-->
            <div class="author-author__info has_dropdown">
                <div class="author__avatar online">
                    <img src="{{ $logged_in_user->picture }}" width="44px" alt="user avatar"
                         class="rounded-circle">
                </div>

                <div class="dropdown dropdown--author">
                    <div class="author-credits d-flex">
                        <div class="author__avatar">
                            <img src="{{ $logged_in_user->picture }}" width="44px" alt="user avatar"
                                 class="rounded-circle">
                        </div>
                        <div class="autor__info">
                            <p class="name">
                                {{ $logged_in_user->name }}
                            </p>
                            {{-- <p class="amount">$20.45</p> --}}
                        </div>
                    </div>
                    <ul>
                        <li>
                            <a href="{{route('frontend.user.dashboard')}}">
                                <span class="icon-home"></span> @lang('navs.frontend.dashboard')</a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.user.account') }}">
                                <span class="icon-user"></span>@lang('navs.frontend.user.account')</a>
                        </li>
                        @can('ver panel')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" >
                                <span class="icon-settings"></span>@lang('navs.frontend.user.administration')</a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('frontend.auth.logout') }}">
                                <span class="icon-logout"></span>@lang('navs.general.logout')</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endguest
            <!--end /.author-author__info-->
        </div>
        <!-- end .author-area -->

        <!-- author area restructured for mobile -->
        <div class="mobile_content ">
            <span class="icon-user menu_icon"></span>

            <!-- offcanvas menu -->
            <div class="offcanvas-menu closed">
                <span class="icon-close close_menu"></span>
                
                @guest     
                <div class="author-author__info">
                </div>

                <div class="dropdown dropdown--author">
                    <ul>
                        <li>
                            <a href="{{route('frontend.auth.login')}}">
                                <span class="icon-user"></span>@lang('navs.frontend.login')</a>
                        </li>
                    </ul>
                </div>
                <div class="text-center">
                    <a href="{{route('frontend.auth.register')}}" class="author-area__seller-btn inline">@lang('navs.frontend.register')</a>
                </div>
                @else

                <div class="author-author__info">
                    <div class="author__avatar v_middle">
                        <img src="{{ $logged_in_user->picture }}" width="44px" alt="user avatar">
                    </div>
                </div>
                <!--end /.author-author__info-->

                {{-- <div class="author__notification_area">
                    <ul>
                        <li>
                            <a href="notification.html">
                                <div class="icon_wrap">
                                    <span class="icon-bell"></span>
                                    <span class="notification_count noti">25</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="message.html">
                                <div class="icon_wrap">
                                    <span class="icon-envelope"></span>
                                    <span class="notification_count msg">6</span>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a href="cart.html">
                                <div class="icon_wrap">
                                    <span class="icon-basket"></span>
                                    <span class="notification_count purch">2</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div> --}}
                <!--start .author__notification_area -->

                <div class="dropdown dropdown--author">
                    <ul>
                        <li>
                            <a href="{{route('frontend.user.dashboard')}}">
                                <span class="icon-home"></span> @lang('navs.frontend.dashboard')</a>
                        </li> 
                        <li>
                            <a href="{{ route('frontend.user.account') }}">
                                <span class="icon-user"></span>@lang('navs.frontend.user.account')</a>
                        </li>
                        @can('ver panel')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" >
                                <span class="icon-settings"></span>@lang('navs.frontend.user.administration')</a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('frontend.auth.logout') }}">
                                <span class="icon-logout"></span>@lang('navs.general.logout')</a>
                        </li>
                    </ul>
                </div>
                @endguest
            </div>
        </div>
        <!-- end /.mobile_content -->
    </div>


                        </div>
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end  -->
    </div>
    <!-- end /.menu-area -->
