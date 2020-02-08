@extends('frontend.layouts.app2')

@section('content')

    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-contents">
                        <h2 class="page-title">@lang('navs.frontend.user.account')</h2>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="#">@lang('navs.general.home')</a>
                                </li>
                                <li class="active">
                                    <a href="#">@lang('navs.frontend.user.account')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end .col-md-12 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .breadcrumb-area -->


 <section class="author-profile-area">
        <div class="container">
            <div class="row">
            	<div class="col-lg-12">
            		<div class="author-profile">
            			<div class="row">
            				<div class="col-lg-5 col-md-7">

            					<div class="author-desc">
            						<img src="{{ $logged_in_user->picture }}" width="120px" alt="">
            						<div class="infos">
            							<h4>{{ $logged_in_user->name }}</h4>
            							<span>{{ timezone()->convertToLocal($logged_in_user->created_at, 'd-m-Y, g:i:s a') }}</span>
            							<ul>
            								{{-- <li>
            									<a href="#" class="btn btn-primary btn--xs">Follow</a>
            								</li>
            								<li>
            									<a href="#" class="btn btn-danger btn--xs" data-toggle="modal" data-target="#author-contact">
            										<span class="icon-envelope-open"></span>
            									</a>
            								</li>
            								<li>
            									<a href="#" class="btn btn-secondary btn--xs">
            										<span class="icon-globe"></span>
            									</a>
            								</li> --}}
            							</ul>
            						</div>
            					</div><!-- ends: .author-desc -->

            				</div><!-- ends: .col-lg-5 -->
            				<div class="col-lg-4 order-lg-1 col-md-12 order-md-2">

            					<div class="author-social social social--color--filled">
            						<ul>
            							{{-- <li>
            								<a href="#">
            									<span class="fa fa-facebook"></span> Facebook
            								</a>
            							</li>
            							<li>
            								<a href="#">
            									<span class="fa fa-twitter"></span> Twitter
            								</a>
            							</li>
            							<li>
            								<a href="#">
            									<span class="fa fa-dribbble"></span> Dribble
            								</a>
            							</li>
            							<li>
            								<a href="#">
            									<span class="fa fa-facebook"></span> Facebook
            								</a>
            							</li>
            							<li>
            								<a href="#">
            									<span class="fa fa-twitter"></span> Twitter
            								</a>
            							</li>
            							<li>
            								<a href="#">
            									<span class="fa fa-dribbble"></span> Dribble
            								</a>
            							</li> --}}
            						</ul>
            					</div><!-- ends: .author-social -->

            				</div><!-- ends: .col-lg-3 -->
            				<div class="col-lg-3 order-lg-2 col-md-5 order-md-1">

            					<div class="author-stats">
            						<ul>
            							{{-- <li class="t_items">
            								<span>146</span>
            								<p>Total Items</p>
            							</li> --}}
            							<li class="t_sells">
                                              <a class="btn btn-primary btn--xs" href="{{ route('frontend.regulation.reglamento') }}" target="_blank">
                                                reglamento
                                              </a>
            							</li>
            							{{-- <li class="t_reviews">
            								<div>
            									<span class="ratings">
            										<i class="fa fa-star"></i>
            										<i class="fa fa-star"></i>
            										<i class="fa fa-star"></i>
            										<i class="fa fa-star"></i>
            										<i class="fa fa-star"></i>
            									</span>
            									<span class="avg_r">5.0</span>
            									<span>(226 reviews)</span>
            								</div>
            								<p>Author Ratings</p>
            							</li> --}}
            						</ul>
            					</div><!-- ends: .author-stats -->

            				</div><!-- ends: .col-lg-4 -->
            			</div>
            		</div>
            	</div><!-- ends: .col-lg-12 -->

                <div class="col-md-12 author-info-tabs">
                    <ul class="nav nav-tabs" id="author-tab" role="tablist">
                        <li>
                            <a class="active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="true">@lang('navs.frontend.user.profile')</a>
                        </li>
                        <li>
                            <a id="items-tab" data-toggle="tab" href="#items" role="tab" aria-controls="items"
                               aria-selected="false">@lang('labels.frontend.user.profile.update_information')</a>
                        </li>
                        @if($logged_in_user->canChangePassword())
                        <li>
                            <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                               aria-selected="false">@lang('navs.frontend.user.change_password')</a>
                        </li>
                        @endif
                    </ul><!-- Ends: .nav-tabs -->

                    <div class="p-top-10">
                        @include('includes.partials.messages')
                    </div>


<div class="tab-content" id="author-tab-content">
	<div class="tab-pane fade show active" id="profile" role="tabpanel"
	     aria-labelledby="profile-tab">
	    <div class="author_module about_author">
	        <h3>@lang('labels.frontend.user.profile.hi')
	            <span> {{ $logged_in_user->name }}</span>
	        </h3>
                @include('frontend.user.account.tabs2.profile')

        </div>
	   
	</div><!-- Ends: .profile-tab -->

	<div class="tab-pane fade" id="items" role="tabpanel" aria-labelledby="items-tab">
		<div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>@lang('labels.frontend.user.profile.update_information')</h3>
                            </div><!-- end .login_header -->

                            <div class="login--form">
                                @include('frontend.user.account.tabs2.edit')
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                </div><!-- end .col-md-6 -->
		</div>
		<!-- Start Pagination -->
	</div><!-- Ends: .items-tab -->

    @if($logged_in_user->canChangePassword())
    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
    	<div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>@lang('navs.frontend.user.change_password')</h3>
                            </div><!-- end .login_header -->

                            <div class="login--form">
                                @include('frontend.user.account.tabs2.change-password')
                            </div><!-- end .login--form -->
                        </div><!-- end .cardify -->
                </div><!-- end .col-md-6 -->
    	</div><!-- ends: .row -->
    </div><!-- Ends: reviews-tab -->
    @endif
                        
</div><!-- ends: .tab-content -->
                </div><!-- Ends: .author-info-tabs -->
            </div>
        </div>
    </section><!-- ends: .author-profile-area -->


     

@endsection
