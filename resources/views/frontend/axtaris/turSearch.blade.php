@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Bütün Turlar')

@section('menualt')
  <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->tursP) }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
      <div class="animated fadeInDown">
        <h1>Paris tours</h1>
        <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <div class="container margin_60">
    <div class="row">
      <aside class="col-lg-3">

        <div class="box_style_cat">
          <ul id="cat_nav">
            <li><a href="{{ url('/turlar') }}" id="active"><i class="icon_set_1_icon-51"></i>Bütün Turlar</a>
            </li>
            @if(count($categories) > 0)
              @foreach($categories as $categorie)
                <li><a href="{{ url('/kateqoriyalar/'.$categorie->id) }}"><i></i>{{$categorie->name}}</a>
                  @endforeach
                  @endif
                </li>
          </ul>
        </div>

        <div id="filters_col">
          <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Filters</a>
          <div class="collapse show" id="collapseFilters">
            <div class="filter_type">
              <h6>Price</h6>
              <input onchange="alert('ok')" type="submit" id="range" name="range" value="">
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

          @foreach($turs as $tur)

            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
              <div class="tour_container">
                <div class="img_container">
                  <a href="{{ $tur->path() }}">
                    <img src="{{ url('storage/'.$tur->turP) }}" width="800" height="533" class="img-fluid" alt="Image">
                    <div class="short_info">
                      <i style="margin-left: 12px;"></i>{{ $tur->categorie->name }}<span class="price"><sup>$</sup>{{$tur->turQiy}}</span>
                    </div>
                  </a>
                </div>
                <div class="tour_title">
                  <h3><strong>{{ $tur->turBas }}</strong></h3>
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
            {{ $turs->links() }}
          </ul>
        </nav>
        <!-- end pagination-->

      </div>
      <!-- End col lg 9 -->
    </div>
    <!-- End row -->
  </div>
@endsection