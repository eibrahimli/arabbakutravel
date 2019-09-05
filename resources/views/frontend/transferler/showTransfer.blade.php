
@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | '.$transfer->name. ' başlıqlı transfer')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$transfer->singlePhoto) }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1>{{ $transfer->name }}</h1>
            <span>{{ $transfer->adress }}</span>
          </div>
          <div class="col-md-4">
            <div id="price_single_main">
              {{ __('frontend.person') }} <span><sup>$</sup>{{ $transfer->price }}</span>
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
            <?=$transfer->description?>
          </div>
        </div>

        <hr>

      </div>
      <!--End  single_tour_desc-->

      <aside class="col-lg-4">
        <div class="box_style_1 expose">
          <h3 class="inner">- {{ __('frontend.booking') }} -</h3>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>{{ __('frontend.adults') }}</label>
                <div class="numbers-row">
                  <form action="" onsubmit="return false;">
                    <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>{{ __('frontend.children') }}</label>
                <div class="numbers-row">
                  <input type="text" value="0" id="children" class="qty2 form-control" name="quantity">
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Pick Up address</label>
                <select id="address_2" class="form-control" name="addres_2">
                  <option value="Gar du Nord Station">Gar du Nord Station</option>
                  <option value="Place Concorde">Place Concorde</option>
                  <option value="Hotel Rivoli">Hotel Rivoli</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Drop off address</label>
                <select id="address_2" class="form-control" name="addres_2">
                  <option value="Gar du Nord Station">Gar du Nord Station</option>
                  <option value="Place Concorde">Place Concorde</option>
                  <option value="Hotel Rivoli">Hotel Rivoli</option>
                </select>
              </div>
            </div>

          </div>
          <br>
          <table class="table table_summary">
            <tbody>
            <tr>
              <td>
                {{ __('frontend.adults') }}
              </td>
              <td class="text-right">
                2
              </td>
            </tr>
            <tr>
              <td>
                {{ __('frontend.children') }}
              </td>
              <td class="text-right">
                0
              </td>
            </tr>
            <tr>
            </tr>
            <tr class="total">
              <td>
                {{ __('frontend.totalCost') }}
              </td>
              <td class="text-right">
                $154
              </td>
            </tr>
            </tbody>
          </table>
          <a class="btn_full" href="cart.html">{{ __('frontend.book') }}</a>
        </div>
        <!--/box_style_1 -->

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