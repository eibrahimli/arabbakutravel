
@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | '.$restoran->name. ' başlıqlı restoran')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$restoran->singlePhoto) }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1>{{ $restoran->name }}</h1>
            <span>{{ $restoran->adress }}</span>
          </div>
          <div class="col-md-4">
            <div id="price_single_main">
              {{ __('frontend.person') }} <span><sup>$</sup>{{ $restoran->price }}</span>
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

        <div class="row">
          <div class="col-lg-3">
            <h3>{{ __('frontend.turAciq') }}</h3>
          </div>
          <div class="col-lg-9">
            <?=$restoran->description?>
          </div>
        </div>

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
@endsection