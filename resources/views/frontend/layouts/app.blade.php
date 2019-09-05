<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="@yield('desc')">
  <meta name="keyword" content="@yield('key')">
  <meta name="author" content="Elvir Ibrahimli">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

  <!-- GOOGLE WEB FONT -->
  <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Lato:300,400|Montserrat:400,700" rel="stylesheet">

  <!-- COMMON CSS -->
  <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/css/vendors.css') }}" rel="stylesheet">
  @yield('css')

  <!-- CUSTOM CSS -->
  <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

</head>
<body>

<div id="preloader">
  <div class="sk-spinner sk-spinner-wave">
    <div class="sk-rect1"></div>
    <div class="sk-rect2"></div>
    <div class="sk-rect3"></div>
    <div class="sk-rect4"></div>
    <div class="sk-rect5"></div>
  </div>
</div>
<!-- End Preload -->

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<!-- Header================================================== -->
<header>
  @include('frontend.inc.nav')
</header><!-- End Header -->

@yield('menualt')
<!-- End hero -->

<main>

  @yield('content')

</main>
<!-- End main -->

<footer class="revealed">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h3>{{ __('frontend.contact') }}</h3>
        <a href="tel://+994{{ $setting->siteNum }}" id="phone">+994{{ $setting->siteNum }}</a>
        <a href="mailto:{{ $setting->siteMail }}" id="email_footer">{{ $setting->siteMail }}</a>
      </div>
      <div class="col-md-5">
        <h3>Haqqımızda</h3>
        <ul>
          <li><a href="{{ url('/aboutus') }}">{{ __('frontend.about') }}</a></li>
          <li><a href="{{url('/login')}}">{{ __('frontend.giris') }}</a></li>
          <li><a href="{{url('/register')}}">{{ __('frontend.Register') }}</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <h3>Sayt Dili</h3>
        <div class="styled-select">
            <select name="lang" onchange="yonlendir();" id="lang">
              <option value="az" {{ App::getLocale() == 'az' ? 'selected' : null }}><a href="{{ url('/language/az') }}"> {{__('frontend.lang')}}</a></option>
              <option value="en" {{ App::getLocale() == 'en' ? 'selected' : null }}><a href="{{ url('/language/en') }}">{{__('frontend.lang2')}}</a></option>
              <option value="ae" {{ App::getLocale() == 'ae' ? 'selected' : null }}><a href="{{ url('/language/ae') }}">{{__('frontend.lang3')}}</a></option>
            </select>
        </div>
      </div>
    </div><!-- End row -->
    <div class="row">
      <div class="col-md-12">
        <div id="social_footer">
          <ul>
            <li><a href="{{ explode('|||', $setting->siteSocial)[0] }}"><i class="icon-facebook"></i></a></li>
            <li><a href="{{ explode('|||', $setting->siteSocial)[2] }}"><i class="icon-twitter"></i></a></li>
            <li><a href="{{ explode('|||', $setting->siteSocial)[3] }}"><i class="icon-google"></i></a></li>
            <li><a href="{{ explode('|||', $setting->siteSocial)[1] }}"><i class="icon-instagram"></i></a></li>
            <li><a href="{{ explode('|||', $setting->siteSocial)[4] }}"><i class="icon-youtube-play"></i></a></li>
          </ul>
          <p>© {{ $setting->siteFooterCopy }}</p>
        </div>
      </div>
    </div><!-- End row -->
  </div><!-- End container -->
</footer><!-- End footer -->

<div id="toTop"></div><!-- Back to top button -->

<!-- Common scripts -->
<script src="{{ asset('frontend/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('frontend/js/common_scripts_min.js') }}"></script>
<script src="{{ asset('frontend/js/functions.js') }}"></script>
@yield('js')

<script>
    $('input.date-pick').datepicker('setDate', 'today');
    $('input.time-pick').timepicker({
        minuteStep: 15,
        showInpunts: false
    })
</script>

<script src="{{ asset('frontend/js/jquery.ddslick.js') }}"></script>
<script>
    $("select.ddslick").each(function() {
        $(this).ddslick({
            showSelectedHTML: true
        });
    });

    yonlendir = function () {
        let x = document.getElementById('lang').value
        let y = "<?php echo url('/lang') ?>"+'/'+x;
        window.location.replace(y);
    }
</script>

<!-- Check box and radio style iCheck -->
<script>
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
    });
</script>


</body>
</html>