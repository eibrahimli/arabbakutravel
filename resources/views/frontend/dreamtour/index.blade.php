@extends('frontend.layouts.app')

@section('content')
<section id="search_container" style="background: url({{ url('storage/'.$siteAyar->menuP) }}) no-repeat center top; background-size: cover">
  <div id="search">
    <ul class="nav nav-tabs">
      <li><a href="#tours" data-toggle="tab" class="active show">{{ __('frontend.turs') }}</a></li>
      <li><a href="#hotels" data-toggle="tab">@lang('frontend.otels')</a></li>
      <li><a href="#restaurants" data-toggle="tab">@lang('frontend.restorans')</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active show" id="tours">
        <h3>@lang('frontend.searchTour')...</h3>
        <form action="{{ url('') }}" method="post">
          @csrf
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.tourName')</label>
                <input type="text" class="form-control" id="firstname_booking" name="turBas" placeholder="{{ __('frontend.typeTourName') }}">
              </div>
              {{ $errors->first('title') }}
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.chooseCategory')</label>
                <select class="form-control" name="turKat">
                  <option value="0" selected>@lang('frontend.allTour')</option>
                  @if(count($categories) > 0)
                    @foreach($categories as $categorie)
                      <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              {{ $errors->first('turKat') }}
            </div>

        </div>

        <hr>
        <button type="submit" class="btn_1 green"><i class="icon-search"></i>Axtar</button>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection