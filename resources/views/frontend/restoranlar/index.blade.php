@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Bütün Restoranlar')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->restoransP) }}" data-narestoranal-width="1400" data-narestoranal-height="470">
    <div class="parallax-content-1">
      <div class="animated fadeInDown">
        <h1>@lang('frontend.restoranTitle')</h1>
        <p>@lang('frontend.restoranSubtitle')</p>
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
        @include('frontend.inc.help')
      </aside>
      <!--End aside -->

      <div class="col-lg-9">

        <div class="row">

          @foreach($restorans as $restoran)

            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
              <div class="tour_container">
                <div class="img_container">
                  <a href="{{ $restoran->path() }}">
                    <img src="{{ url('storage/'.$restoran->photo) }}" width="800" height="533" class="img-fluid" alt="Image">
                    <div class="short_info hrestoran">
                      From/Per person<span class="price"><sup>$</sup>{{ $restoran->price }}</span>
                    </div>
                  </a>
                </div>
                <div class="tour_title">
                  <h3><strong>{{ mb_substr($restoran->name,0,40) }}</strong></h3>
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
            {{ $restorans->links() }}
          </ul>
        </nav>
        <!-- end pagination-->

      </div>
      <!-- End col lg 9 -->
    </div>
    <!-- End row -->
  </div>
@endsection