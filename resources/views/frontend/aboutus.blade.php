@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Bütün otellar')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->aboutP) }}" data-naotelal-width="1400" data-naotelal-height="470">
    <div class="parallax-content-1">
      <div class="animated fadeInDown">
        <h1>@lang('frontend.aboutTitle')</h1>
        <p>@lang('frontend.aboutSubTitle')</p>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <div class="container margin_60">

    <div class="main_title">
      <h2>{{ $about->title }}</h2>
      <p>{{ $about->subTitle }}.</p>
    </div>

    <div class="row">
      <?=$about->description?>
    </div>
  </div>
@endsection