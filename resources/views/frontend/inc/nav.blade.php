<div id="top_line">
  <div class="container">
    <div class="row">
      <div class="col-6"><i class="icon-phone"></i><strong>+994{{ $setting->siteNum }}</strong></div>
      <div class="col-6">
        <ul id="top_links">
          @guest
            <li><a id="access_link" href="{{ url('/login') }}">{{ __('frontend.giris') }}</a></li>
          @else
            <li><a id="access_link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @endguest
        </ul>
      </div>
    </div><!-- End row -->
  </div><!-- End container-->
</div><!-- End top line-->

<div class="container">
  <div class="row">
    <div class="col-3">
      <div id="logo_home">
        <h1 style="background-image:url({{ asset('storage/'.$setting->siteLogo) }});background-repeat:no-repeat;"><a href="{{ url('/') }}" title="City tours travel template">{{ $setting->siteTitle }}</a></h1>
      </div>
    </div>
    <nav class="col-9">
      <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
      <div class="main-menu">
        <div id="header_menu">
          <img src="{{ asset('storage/'.$setting->siteLogo) }}" width="160" height="34" alt="City tours" data-retina="true">
        </div>
        <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
        <ul>
          <li>
            <a href="/">{{ __('frontend.home') }} <i></i></a>
          </li>
          <li class="submenu"><a href="{{ url('/turlar')}}" class="show-submenu">{{ __('frontend.turs') }} </a></li>
          <li class="submenu"><a href="{{ url('/oteller')}}" class="show-submenu">{{ __('frontend.otels') }}</a></li>
          <li class="submenu"><a href="{{ url('/transferler')}}" class="show-submenu">{{ __('frontend.transfers') }}</a></li>
          <li class="submenu"><a href="{{ url('/restoranlar')}}" class="show-submenu">{{ __('frontend.restorans') }}</a></li>
          <li class="submenu"><a href="{{ url('/contact')}}" class="show-submenu">{{ __('frontend.contactMenu') }}</a></li>
          @guest
            <li><a href="{{ url('/login') }}">{{ __('frontend.giris') }}</a></li>
            <li><a href="{{ url('/register') }}">{{ __('frontend.Register') }}</a></li>
          @else
            <li class="submenu"><a href="javascript:void(0);" class="show-submenu">{{ __('frontend.profile') }}<i class="icon-down-open-mini"></i></a>
              <ul >
                <li><a href="{{ url('/profile/'.Auth::user()->id) }}">{{ __('frontend.profile') }}</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a></li>
              </ul>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          @endguest
        </ul>
      </div><!-- End main-menu -->
    </nav>
  </div>
</div><!-- container -->
