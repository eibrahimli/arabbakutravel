@extends('frontend.layouts.app')

@section('title', 'Travel Site')

@section('menualt')

  @include('frontend.inc.search', compact('categories'))

@endsection

@section('content')

  <div class="container margin_60">
    <?php $i = 1; ?>
    <div class="main_title">
      <h2>Ən <span>Yenİ</span> Turlar</h2>
      <p style="font-family: Nunito,sans-serif;">İstədiyiniz turu girib sifariş edə bilərsiniz.</p>
    </div>

    <div class="row">

      @foreach($turs as $tur)

        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.{{$i++}}s">
          <div class="tour_container">
            <div class="img_container">
              <a href="{{ $tur->path() }}">
                <img src="{{ asset('storage/'.$tur->turP) }}" width="800" height="533" class="img-fluid" alt="Image">
                <div class="short_info">
                  <i style="margin-left: 12px;"></i>{{ $tur->categorie->name }}<span class="price"><sup>$</sup>{{ $tur->turQiy }}</span>
                </div>
              </a>
            </div>
            <div class="tour_title">
              <h3><strong>{{ $tur->turBas }}</strong></h3>
            </div>
          </div><!-- End box tour -->
        </div><!-- End col -->

      @endforeach

    </div><!-- End row -->

    <p class="text-center nopadding">
      <a href="{{ url('/turlar') }}" class="btn_1 medium"><i class="icon-eye-7"></i>Bütün Turları Göstər </a>
    </p>
  </div><!-- End container -->

  <div class="container margin_60">

    <div class="main_title">
      <h2>Ən <span>Yenİ</span> Oteller</h2>
      <p style="font-family: Nunito,sans-serif;">Xəyallarınızdakı oteli seçin və seçdiyiviz otelin otaqlarındakı konfortdan həzz alın.</p>
    </div>

    <div class="row">
      <?php $i = 1; ?>
      @foreach($otels as $otel)

        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.{{ $i++ }}s">
          <div class="tour_container">
            <div class="img_container">
              <a href="{{ $otel->path() }}">
                <img src="{{ asset('storage/'.$otel->photo) }}" width="800" height="533" class="img-fluid" alt="Image">
                <div class="short_info">
                  <span class="price"><sup>$</sup>{{ $otel->price }}</span>
                </div>
              </a>
            </div>
            <div class="tour_title">
              <h3><strong>{{ $otel->name }}</strong></h3>
            </div>
          </div><!-- End box tour -->
        </div><!-- End col -->

      @endforeach

    </div><!-- End row -->

    <p class="text-center nopadding">
      <a href="{{ url('/oteller') }}" class="btn_1 medium"><i class="icon-eye-7"></i>Bütün Otellərİ Göstər </a>
    </p>
  </div><!-- End container -->

  <section class="promo_full" style="background: url({{ url('storage/'.$siteAyar->videoP) }}) no-repeat center center;
    background-attachment: fixed;">
    <div class="promo_full_wp magnific">
      <div>
        <h3>{{ $siteAyar->videoTitle }}</h3>
        <p>
          {{ $siteAyar->videoSubTitle }}
        </p>
        <a href="{{ $siteAyar->videoUrl }}" class="video"><i class="icon-play-circled2-1"></i></a>
      </div>
    </div>
  </section>
  <!-- End section -->

  <div class="container margin_60">

    <hr>

    <div class="row">
      <div class="col-md-6">
        <img src="{{ url('storage/'.$siteAyar->gsP) }}" alt="Laptop" class="img-fluid laptop">
      </div>
      <div class="col-md-6">
        <h3>Bizimlə <span>Başlayın</span></h3>
        <p>
          Aşağıdakıları edərək saytımızdan yararlanın...
        </p>
        <ul class="list_order">
          <li><span>1</span>İstədiyiniz turu seçin</li>
          <li><span>2</span>Bileti sifariş edin</li>
          <li><span>3</span>Ofisimizdən bileti götürün</li>
        </ul>
        <a href="{{ url('/turlar') }}" class="btn_1">Həmən başla</a>
      </div>
    </div>
    <!-- End row -->

  </div>
  <!-- End container -->
@endsection
