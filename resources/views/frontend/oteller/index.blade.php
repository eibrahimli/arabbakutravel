@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Bütün otellər')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->otelsP) }}" data-naotelal-width="1400" data-naotelal-height="470">
    <div class="parallax-content-1">
      <div class="animated fadeInDown">
        <h1>@lang('frontend.otelTitle')s</h1>
        <p>@lang('frontend.otelSubTitle')</p>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <div class="container margin_60">
    <div class="row">
      <aside class="col-lg-3">

        <div id="filters_col">
          <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Filters</a>
          <div class="collapse show" id="collapseFilters">
            <div class="filter_type">
              <h6>Price</h6>
              <input type="submit" id="range" name="range" value="">
            </div>
          </div>
          <!--End collapse -->
        </div>
        <!--End filters col-->
        <div class="box_style_2">
          <i class="icon_set_1_icon-57"></i>
          <h4><span>Yardım</span> Üçün</h4>
          <a href="tel://994{{ $setting->siteNum }}" class="phone">+994{{ $setting->siteNum }}</a>
        </div>
      </aside>
      <!--End aside -->

      <div class="col-lg-9">

        <div class="row">

          @foreach($otels as $otel)

            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
              <div class="otel_container">
                <div class="img_container">
                  <a href="{{ $otel->path() }}">
                    <img src="{{ url('storage/'.$otel->photo) }}" width="800" height="533" class="img-fluid" alt="Image">
                    <div class="short_info hotel">
                      From/Per night<span class="price"><sup>$</sup>{{ $otel->price }}</span>
                    </div>
                  </a>
                </div>
                <div class="hotel_title">
                  <h3><strong>{{ $otel->name }}</strong></h3>
                  <div class="rating">
                    @for($i = 1; $i <= $otel->category; $i++)
                      <i class="icon-star voted"></i>
                    @endfor
                    @if(5 - $otel->category > 0)
                      @for($a = 0; $a<5 - $otel->category; $a++)
                        <i class="icon-star-empty"></i>
                      @endfor
                     @endif
                  </div>
                </div>
              </div>
              <!-- End box tour -->
            </div>

          @endforeach

        </div>
        <!-- End row -->
        <hr>

        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            {{ $otels->links() }}
          </ul>
        </nav>
        <!-- end pagination-->

      </div>
      <!-- End col lg 9 -->
    </div>
    <!-- End row -->
  </div>
@endsection