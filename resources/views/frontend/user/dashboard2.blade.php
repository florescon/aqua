@extends('frontend.layouts.app2')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')

     
    
    <!-- Breadcrumb Area -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-contents">
                        <h2 class="page-title">@lang('navs.frontend.dashboard')</h2>
                        <div class="breadcrumb">
                            <ul>
                                <li>
                                    <a href="#">@lang('navs.general.home')</a>
                                </li>
                                <li class="active">
                                    <a href="#">@lang('navs.frontend.dashboard')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end .col-md-12 -->
            </div><!-- end .row -->
        </div><!-- end .container -->
    </section><!-- ends: .breadcrumb-area -->

    <section class="dashboard-area">
        
    
        
    

    {{-- <div class="dashboard_menu_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="menu-toggler d-md-none">
                        <span class="icon-menu"></span> Dashboard Menu
                    </button>
                    <ul class="dashboard_menu">
                        <li >
                            <a href="dashboard.html"><span class="lnr icon-home"></span>Inicio</a>
                        </li>
                        <li class="active">
                            <a href="dashboard-setting.html"><span class="lnr icon-settings"></span>Setting</a>
                        </li>
                        <li >
                            <a href="dashboard-purchase.html"><span class="lnr icon-basket"></span>Purchase</a>
                        </li>
                        <li >
                            <a href="dashboard-add-credit.html"><span class="lnr icon-credit-card"></span>Add Credits</a>
                        </li>
                        <li >
                            <a href="dashboard-statement.html"><span class="lnr icon-chart"></span>Statements</a>
                        </li>
                        <li >
                            <a href="dashboard-upload.html"><span class="lnr icon-cloud-upload"></span>Upload Items</a>
                        </li>
                        <li >
                            <a href="dashboard-manage-item.html"><span class="lnr icon-note"></span>Manage Items</a>
                        </li>
                        <li >
                            <a href="dashboard-withdrawal.html"><span class="lnr icon-briefcase"></span>Withdrawals</a>
                        </li>
                    </ul><!-- ends: .dashboard_menu -->
                </div><!-- ends: .col-md-12 -->
            </div><!-- ends: .row -->
        </div><!-- ends: .container -->
    </div> --}}<!-- ends: .dashboard_menu_area -->


        <div class="dashboard_contents section--padding">
            <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            
    <div class="information_module">
        <div class="information__set profile_images">
            <div class="information_wrapper">
                <div class="profile_image_area">
                    <div>
                        <img src="{{ $logged_in_user->picture }}" width="100px;" alt="Author profile area">
                        <div class="img_info">
                            <p class="bold">{{ $logged_in_user->name }}</p>
                            <p class="subtitle">{{ $logged_in_user->email }}</p>
                            <p class="subtitle">@lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'd-m-Y') }}</p>
                        </div>
                    </div>
                    <label for="cover_photo" class="upload_btn">

                      <a class="btn btn-primary btn--xs" href="{{ route('frontend.regulation.reglamento') }}" target="_blank">
                        reglamento
                      </a>

                        <a href="{{ route('frontend.user.account')}}" class="btn btn-sm btn-info">@lang('navs.frontend.user.account')</a>
                    </label>
                </div>
            </div>
        </div>
    </div><!-- ends: .information_module -->

                        </div><!-- ends: .col-md-12 -->

                        <div class="col-md-12">
                            
    {{-- <div class="information_module">
        <div class="toggle_title">
            <h4>Personal Information</h4>
        </div>

        <div class="information__set">
            <div class="information_wrapper form--fields row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="acname">Account Name
                            <sup>*</sup>
                        </label>
                        <input type="text" id="acname" class="text_field" placeholder="First Name" value="AazzTech">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usrname">Username
                            <sup>*</sup>
                        </label>
                        <input type="text" id="usrname" class="text_field" placeholder="Account name" value="aazztech">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailad">Email Address
                            <sup>*</sup>
                        </label>
                        <input type="text" id="emailad" class="text_field" placeholder="Email address" value="contact@aazztech.com">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="password" id="website" class="text_field" placeholder="Website">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password
                            <sup>*</sup>
                        </label>
                        <input type="password" id="password" class="text_field" placeholder="Enter Password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="conpassword">Confirm Password
                            <sup>*</sup>
                        </label>
                        <input type="password" id="conpassword" class="text_field" placeholder="re-enter password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country
                            <sup>*</sup>
                        </label>
                        <div class="select-wrap select-wrap2">
                            <select name="country" id="country" class="text_field">
                                <option value="">Select one</option>
                                <option value="bangladesh">Bangladesh</option>
                                <option value="india">India</option>
                                <option value="uruguye">Uruguye</option>
                                <option value="australia">Australia</option>
                                <option value="neverland">Neverland</option>
                                <option value="atlantis">Atlantis</option>
                            </select>
                            <span class="lnr icon-arrow-down"></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prohead">Profile Heading</label>
                        <input type="text" id="prohead" class="text_field" placeholder="Ex: Webdesign & Development Service">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="">
                        <label for="authbio">Author Bio</label>
                        <textarea name="author_bio" id="authbio" class="text_field" placeholder="Short brief about yourself or your account..."></textarea>
                    </div>
                </div>
            </div><!-- ends: .information_wrapper -->
        </div><!-- ends: .information__set -->
    </div> --}}<!-- ends: .information_module -->

                        </div><!-- ends: .col-md-12 -->
                       
                    </div><!-- ends: .row -->
            </div><!-- ends: .container -->
        </div><!-- ends: .dashboard_menu_area -->
    </section><!-- ends: .dashboard-area -->



@endsection
