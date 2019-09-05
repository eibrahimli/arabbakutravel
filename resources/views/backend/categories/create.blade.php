@extends('backend.layouts.myapp')

@section('whereiam', 'Yeni Kateqoriya Əlavə Et')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }} <a href="{{ url('/admin/kateqoriyalar') }}" class="alert-link">Burdan </a>bütün kateqoriyaları görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/kateqoriyalar') }}" method="POST" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="form-group">
            <label>Kateqoriya  Adı *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name')}}">
            {{ $errors->first('name') }}
          </div>
        </div>
        @csrf
        <div class="col-12">
          <div class="form-group">
            <div class="text-center">
              <button type="submit" class="btn gredient-btn disabled">Əlavə Et</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>


@endsection