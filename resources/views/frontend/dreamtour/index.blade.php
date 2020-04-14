@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | Yeni Dreamtur')

@section('content')
<section id="search_container" style="background: url({{ url('storage/'.$siteAyar->menuP) }}) no-repeat center top; background-size: cover">
  <div id="search">
    <ul class="nav nav-tabs">
      <li><a href="#tours" data-toggle="tab" class="active show">{{ __('frontend.dreamTour') }}</a></li>      
    </ul>
    <div class="tab-content">
      <div class="tab-pane active show" id="tours">
        @if(session('status'))
          <div class="alert alert-success alert-dismissable fade show" role="alert">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="close" data-dismiss='alert' aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @else

        @endif
        <h3>@lang('frontend.searchTour2')...</h3>
        <form action="{{ route('dreamtour') }}" method="post">
          @csrf
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.dreamTour') *</label>
                <input required type="text" class="form-control" id="firstname_booking" name="title" placeholder="{{ __('frontend.dreamTourName') }}">
              </div>
              {{ $errors->first('title') }}
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.city2') *</label>
                <input required type="text" class="form-control" id="firstname_booking" name="city">
              </div>
              {{ $errors->first('city') }}
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.desc') *</label>
                <textarea required class="form-control" name="desc" rows="3">{{ old('desc') }}</textarea>
              </div>
              {{ $errors->first('desc') }}
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.schedule') *</label>
                <textarea required class="form-control" name="schedule" rows="3">{{ old('schedule') }}</textarea>
              </div>
              {{ $errors->first('schedule') }}
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>@lang('frontend.price') *</label>{ $ }
                <input required type="number" class="form-control" name="price">
              </div>
              {{ $errors->first('price') }}
            </div>

        </div>

        <hr>
        <button type="submit" class="btn_1 green"><i class="icon-plus"></i>{{ __('frontend.create') }}</button>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection