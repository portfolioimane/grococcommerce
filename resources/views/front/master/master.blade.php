<!DOCTYPE html>
<html lang="en-us">

<head>
  @include('front.include.header_asset')

  @stack('style')

  <style>
    /* this style are dynamic with theme  */
   .theme-background
   {
      background: {{ $shop_info->theme_color }} !important;
   }
   .theme-color
   {
     color : {{ $shop_info->theme_color }} !important;
   }
   .theme-hover-bg : hover {

    background: {{ $shop_info->theme_color }} !important;
   }
   .theme-hover-color : hover {
    color : {{ $shop_info->theme_color }} !important;
   }
   .initially_selected .parent_a
   {
     color : {{ $shop_info->theme_color }} ;
   }
   .active_color  > a
   {
     color : {{ $shop_info->theme_color }} ;
   }

   .my-radio
    {
        display: none;
    }



  </style>
 @if($shop_info->sidemenu_status == 0)
  <style>
      .sidebar {
        margin-left: -250px !important;
      }
      .sidebar.active {
          margin-left: 0px !important;
          transition: all ease 1s;
      }
      </style>
      @endif
  <!-- google analytics  -->
<!-- coming from app/Helpers/helper -->
@php
$google_analytics = googleAnalytics();
@endphp

@if($google_analytics && $google_analytics->status == 1)
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytics->app_id }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $google_analytics->app_id }}');
</script>
@endif
  <!-- google analytics  -->
</head>

<body id="app_body" >
  <div id="front-wrapper">
    <header class="header theme-background">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-lg-1 col-sm-1">
                    <div class="left-menu-toggle">
                        <a id="sidebarCollapse" href="#" class="toggle-nav btn-nav nav-toggle-btn">
                            <i class="lni-menu"></i>
                        </a>
                    </div>
                </div>
                <div class="col col-lg-2 col-sm-2 ">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ url('images/logo/'.$shop_info->logo_header) }}" alt="logo" class="img-fluid"></a>
                    </div>
                </div>
              <!-- for mobile  -->
                <div class="d-sm-none d-md-none d-lg-none col col-lg-3 col-sm-3 text-center">
                    <div class="user-menu">
                        <a href="#">
                            <i class="lni lni-user" style="font-size: 20px"></i>
                        </a>
                        <ul class="dropdown-menu1">
                            @auth
                            <li><a href="{{ route('user.profile') }}"><span>Profile</span></a></li>
                            <li><a href="{{ route('user.order') }}"><span>My Orders</span></a></li>
                            <li><a href="{{ route('user.logout') }}"><span>Logout</span></a></li>
                            @endauth
                            @guest
                            <li><a href="{{ route('login') }}"><span>Sign in</span></a></li>
                            <!-- <li><a href="{{ route('register') }}"><span>Sign up</span></a></li>                             -->
                            @endguest
                            <li><a href="{{ route('order.track') }}">Track Order</a></li>
                        </ul>
                    </div>
            </div>
            <!-- end mobile profile  -->
            <div class="col-12 col-lg-6 col-sm-6">
              <search-box></search-box>
            </div>
            <div class="d-none d-sm-block col-3 col-lg-3 col-sm-3 text-center">
                    <div class="user-menu">
                        <a href="#">
                            <i class="lni lni-user" style="font-size: 20px"></i>
                        </a>
                        <ul class="dropdown-menu1">
                            @auth
                            <li><a href="{{ route('user.profile') }}"><span>Profile</span></a></li>
                            <li><a href="{{ route('user.logout') }}"><span>Logout</span></a></li>
                            @endauth
                            @guest
                            <li><a href="{{ route('login') }}"><span>Sign in</span></a></li>
                            <li><a href="{{ route('register') }}"><span>Sign up</span></a></li>
                            @endguest
                            <li><a href="{{ route('order.track') }}">Track Order</a></li>
                        </ul>
                    </div>
            </div>
        </div>
    </div>

@include('front.include.cart')

</header>
    

