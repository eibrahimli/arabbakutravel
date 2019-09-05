@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | '.ucfirst($otel->name).' adlı otel')
@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$otel->singlePhoto) }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <span class="rating">
              @for($i = 1; $i <= $otel->category; $i++)
                <i class="icon-star voted"></i>
              @endfor
              @if(5 - $otel->category > 0)
                @for($a = 0; $a<5 - $otel->category; $a++)
                  <i class="icon-star-empty"></i>
                @endfor
              @endif
            </span>
            <h1>{{ $otel->name }}</h1>
            <span>{{ $otel->adress }}</span>
          </div>
          <div class="col-md-4">
            <div id="price_single_main" class="hotel">
              from/per night <span><sup>$</sup>{{ $otel->price }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <div class="container margin_60">
    <div class="row">
      <div class="col-lg-8" id="single_tour_desc">
        <div id="Img_carousel" class="slider-pro">
          <div class="sp-slides">
            @foreach($galeries as $galery)
              <div class="sp-slide">
                <img alt="Image" class="sp-image" src="{{ url('storage/'.$galery->name) }}" data-src="{{ url('storage/'.$galery->name) }}" data-small="{{ url('storage/'.$galery->name) }}" data-medium="{{ url('storage/'.$galery->name) }}" data-large="{{ url('storage/'.$galery->name) }}" data-retina="{{ url('storage/'.$galery->name) }}">
              </div>
            @endforeach
          <div class="sp-thumbnails">
            @foreach($galeries as $galery)
              <img alt="Image" class="sp-thumbnail" src="{{ url('storage/'.$galery->name) }}">
            @endforeach
          </div>
        </div>
      </div>
        <hr>

        <div class="row">
          <div class="col-lg-3">
            <h3>Description</h3>
          </div>
          <div class="col-lg-9">
            <?=$otel->description?>
          </div>
          <!-- End col-md-9  -->
        </div>
        <!-- End row  -->


        <hr>

      </div>
      <!--End  single_tour_desc-->

      <aside class="col-lg-4">
        <div class="box_style_4">
          <i class="icon_set_1_icon-90"></i>
          <h4><span>{{ __('frontend.bookbyphone') }}</span></h4>
          <a href="tel://+994{{ $setting->siteNum }}" class="phone">+994{{ $setting->siteNum }}</a>
        </div>

      </aside>
    </div>
    <!--End row -->
  </div>
  <!--End container -->
@endsection

@section('js')
  <script src="{{ asset('frontend/js/jquery.sliderPro.min.js') }}"></script>
  <script type="text/javascript">
      $(document).ready(function ($) {
          $('#Img_carousel').sliderPro({
              width: 960,
              height: 500,
              fade: true,
              arrows: true,
              buttons: false,
              fullScreen: false,
              smallSize: 500,
              startSlide: 0,
              mediumSize: 1000,
              largeSize: 3000,
              thumbnailArrows: true,
              autoplay: false
          });
      });
      </script>

      <script src="{{ asset('frontend/assets/validate.js') }}"></script>
  <script>
      $('.carousel-thumbs-2').owlCarousel({
          loop:false,
          margin:5,
          responsiveClass:true,
          nav:false,
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:3
              },
              1000:{
                  items:4,
                  nav:false
              }
          }
      });
  </script>
@endsection