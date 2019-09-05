@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Əlaqə Səhifəsi')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->contactP) }}" data-naotelal-width="1400" data-naotelal-height="470">
    <div class="parallax-content-1">
      <div class="animated fadeInDown">
        <h1>@lang('frontend.contactTitle')</h1>
        <p>@lang('frontend.contactSubTitle')</p>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <div class="container margin_60">
    @if(session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <div class="row">
      <div class="col-md-8">
        <div class="form_title">
          <h3><strong><i class="icon-pencil"></i></strong>@lang('frontend.contactFill')</h3>
        </div>
        <div class="step">

          <div id="message-contact"></div>
          <form method="post" action="{{ url('/contact') }}" id="contactform">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>@lang('frontend.fName')</label>
                  <input type="text" class="form-control" id="name_contact" name="fName">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>@lang('frontend.lName')</label>
                  <input type="text" class="form-control" id="lastname_contact" name="lName">
                </div>
              </div>
            </div>
            <!-- End row -->
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>@lang('frontend.Email')</label>
                  <input type="email" id="email_contact" name="email" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>@lang('frontend.phone')</label>
                  <input type="text" id="phone_contact" name="phone" class="form-control">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>@lang('frontend.context')</label>
                  <input type="text" id="phone_contact" name="context" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>@lang('frontend.message')</label>
                  <textarea rows="5" id="message_contact" name="message" class="form-control" style="height:200px;"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <input type="submit" value="@lang('frontend.send')" class="btn_1" id="submit-contact">
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- End col-md-8 -->

      <div class="col-md-4">
        <div class="box_style_1">
          <span class="tape"></span>
          <h4>@lang('frontend.adress') <span><i class="icon-pin pull-right"></i></span></h4>
          <p>
            {{ $setting->siteAdress }}
          </p>
          <hr>
          <h4>@lang('frontend.helpcenter') <span><i class="icon-help pull-right"></i></span></h4>
          <ul id="contact-info">
            <li><a href="tel:+994{{$setting->siteNum }}">+994{{ $setting->siteNum }}</a></li>
            <li><a href="mailto:{{ $setting->siteMail }}">{{ $setting->siteMail }}</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- End col-md-4 -->
    </div>
    <!-- End row -->
  </div>
@endsection