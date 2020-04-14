@extends('backend.layouts.myapp')

@section('whereiam', 'DreamTur Görüntülə')

@section('content')

  <div class="row">

    <div class="col-md-12">

        <div class="alert alert-success" role="alert">
          @if($tur->status == '1')          
            <a href="{{ route('activedreamtours') }}" class="alert-link">Burdan </a>bütün dreamturları görüntülüyə bilərsiniz.
          @else
          <a href="{{ route('deactivedreamtours') }}" class="alert-link">Burdan </a>bütün təsdiqsiz dreamturları görüntülüyə bilərsiniz.
          @endif

        </div>
        @if(session('status'))
          <div class="alert alert-success" role="alert">

            {{ session('status') }}..

          </div>
        @endif  

      <form action="{{ route('dreamtourupdate',[$tur->id]) }}" method="POST" enctype="multipart/form-data">        

        @method("PATCH")

        <div class="card">

          <div class="row">
        
            <!-- col-md-6 -->
        
            <div class="col-md-12 col-12 padd-top-20">
        
              @csrf
                        
              <div class="col-md-12">
        
                <div class="form-group">
        
                  <label>Tur Başlığı *</label>
        
                  <input type="text" name="title" class="form-control" value="{{ old('title') ?? $tur->title}}">
        
                  {{ $errors->first('title') }}
        
                </div>                
        
              </div>
        
              {{-- <div class="col-md-12 col-12">
        
                <div class="form-group">
        
                  <label for="exampleSelect1">Tur Kateqoriyası *</label>
        
                  <select name="turKat" class="form-control" id="exampleSelect1">
        
                    @foreach($categories as $categorie)
        
                      <option value="{{ $categorie->id }}" {{ $categorie->id == $tur->turKat ? 'selected' : null }}>{{ ucfirst($categorie->name) }}</option>
        
                    @endforeach
        
                  </select>
        
                  {{ $errors->first('turKat') }}
        
                </div>
        
              </div>
         --}}
              <div class="col-md-12">
        
                <div class="form-group">
        
                  <label>Tur Qiyməti *</label>
        
                  <input type="number" name="price" class="form-control" value="{{ old('price') ?? $tur->price}}">
        
                  {{ $errors->first('price') }}
        
                </div>
        
              </div>

              <div class="col-md-12 col-12">
        
                <div class="form-group">
        
                  <label for="ckeditor">Tur Şəhər *</label>
        
                  <input type="text" name="city" class="form-control" value="{{ old('city') ?? $tur->city}}">
        
                </div>  
        
                {{ $errors->first('city') }}
        
              </div>
        
              <div class="col-md-12 col-12">
        
                <div class="form-group">
        
                  <label for="ckeditor">Tur Açıqlaması *</label>
        
                  <textarea name="desc" class="form-control" id="ckeditor" rows="3">{{ old('desc') ?? $tur->desc }}</textarea>
        
                </div>
        
                {{ $errors->first('desc') }}
        
              </div>
        
              <div class="col-md-12 col-12">
        
                <div class="form-group">
        
                  <label for="exampleTextarea1">Tur Cədvəli *</label>
        
                  <textarea name="schedule" class="form-control ckeditor" id="ckeditor" rows="3">{{ old('schedule') ?? $tur->schedule }}</textarea>
        
                </div>
        
                {{ $errors->first('schedule') }}
        
              </div>
        
            </div>
        
          </div>
        
            <div class="col-12">
        
              <div class="form-group">
        
                <div class="text-center">
        
                  <button type="submit" class="btn gredient-btn disabled">Yenilə</button>
        
                </div>
        
              </div>
        
            </div>                
        
          </div>
        
        </div>              

      </form>

    </div>

  </div>

@endsection