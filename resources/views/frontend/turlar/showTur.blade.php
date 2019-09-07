@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | '.ucfirst($tur->turBas).' başlıqlı tur')
@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{url('storage/'.$tur->turSingleP)}}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <h1 style="margin-top: 15px;">{{ $tur->turBas }}</h1>
          </div>
          <div class="col-md-4">
            <div id="price_single_main">
              {{ __('frontend.person') }} <span><sup>$</sup>{{ $tur->turQiy }}</span>
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
            <?=$tur->turAciq?>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-lg-3">
            <h3>{{ __('frontend.turCedvel') }}</h3>
          </div>
          <div class="col-lg-9">
            <?=$tur->turCedvel?>
          </div>
        </div>

        <hr>

      </div>
      <!--End  single_tour_desc-->

      <aside class="col-lg-4">
        @if(Auth::check())
          <form action="{{ url('/sifaris/'.auth()->user()->id) }}" method="post">
            @csrf
            <div class="box_style_1 expose">
              <h3 class="inner">- {{ __('frontend.booking') }} -</h3>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>{{ __('frontend.adults') }}</label>
                    <div class="numbers-row">
                      <input type="text" value="1" id="adults" class="qty2 form-control" name="adults">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="tur_id" value="{{ $tur->id }}">
                    <input type="hidden" name="title" value="{{ $tur->turBas }}">
                    <input type="hidden" name="price" value="{{ $tur->turQiy }}">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>{{ __('frontend.children') }}</label>
                    <div class="numbers-row">
                      <input type="text" value="0" id="children" class="qty2 form-control" name="child">
                    </div>
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
                    <span id="adults"></span>
                  </td>
                </tr>
                <tr>
                  <td>
                    {{ __('frontend.children') }}
                  </td>
                  <td class="text-right">
                    <span id="child"></span>
                  </td>
                </tr>
                <tr>
                </tr>
                <tr class="total">
                  <td>
                    {{ __('frontend.totalCost') }}
                  </td>
                  <td class="text-right totalCost">
                    <span>{{ $tur->turQiy }}</span>$
                  </td>
                </tr>
                </tbody>
              </table>
              <button type="submit" class="btn_full">{{ __('frontend.book') }}</button>
            </div>
            <!--/box_style_1 -->
            <div class="box_style_4">
              <i class="icon_set_1_icon-90"></i>
              <h4><span>{{ __('frontend.bookbyphone') }}</span></h4>
              <a href="tel://+994{{ $setting->siteNum }}" class="phone">+994{{ $setting->siteNum }}</a>
            </div>
          </form>
        @else
          <div class="alert alert-warning" role="alert">
            Please for booking this tour You have to login <a href="{{ url('/login') }}">From here </a> or register
            <a href="{{ url('/register') }}">From here</a> to our website
          </div>
          <div class="box_style_4">
            <i class="icon_set_1_icon-90"></i>
            <h4><span>{{ __('frontend.bookbyphone') }}</span></h4>
            <a href="tel://+994{{ $setting->siteNum }}" class="phone">+994{{ $setting->siteNum }}</a>
          </div>
          @endif
      </aside>
    </div>
    <!--End row -->
  </div>
@endsection

@section('js')

  <script type="text/javascript">
      $(function(){
          $('.inc,.dec').on('click',function () {
              let adults = $('#adults').val();
              let child = $('#children').val();
              let turQiymet = "<?=$tur->turQiy?>";

              let x = parseInt(adults);
              x = x*turQiymet;
              $('td.totalCost span').text(x);
          })
      });
  </script>

@endsection
