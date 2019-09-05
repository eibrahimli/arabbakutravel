@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Bütün transferlar')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->transfersP) }}" data-natransferal-width="1400" data-natransferal-height="470">
    <div class="parallax-content-1">
      <div class="animated fadeInDown">
        <h1>@lang('frontend.transferTitle')</h1>
        <p>@lang('frontend.transferSubTitle')</p>
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

          @foreach($transfers as $transfer)

            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
              <div class="transfer_container">
                <div class="img_container">
                  <a href="{{ $transfer->path() }}">
                    <img src="{{ url('storage/'.$transfer->photo) }}" width="800" height="533" class="img-fluid" alt="Image">
                    <div class="short_info htransfer">
                      From/Per person<span class="price"><sup>$</sup>{{ $transfer->price }}</span>
                    </div>
                  </a>
                </div>
                <div class="transfer_title">
                  <h3><strong>{{ mb_substr($transfer->name,0,40) }}</strong></h3>
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
            {{ $transfers->links() }}
          </ul>
        </nav>
        <!-- end pagination-->

      </div>
      <!-- End col lg 9 -->
    </div>
    <!-- End row -->
  </div>
@endsection