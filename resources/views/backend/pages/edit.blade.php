@extends('backend.layouts.myapp')

@section('whereiam', 'Haqqımızda Səhifəsini Redaktə Et')

@section('content')

  <div class="row">
    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}...
        </div>
      @endif
      <form action="{{ url('/admin/sehifeler/aboutus/'.$page->id) }}" method="POST" >
        @method("PATCH")
        @csrf
        <div class="col-md-12 col-12">
          <div class="form-group">
            <label for="ckeditor">Haqqımızda Səhifəsini Açıqlaması *</label>
            <textarea name="description" class="form-control" id="ckeditor" rows="6">{{ old('description') ?? $page->description }}</textarea>
          </div>
          {{ $errors->first('description') }}
        </div>
        <div class="col-12">
          <div class="form-group">
            <div class="text-center">
              <button type="submit" class="btn gredient-btn disabled">Yenilə</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>


@endsection