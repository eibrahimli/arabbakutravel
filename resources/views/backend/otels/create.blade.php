@extends('backend.layouts.myapp')

@section('whereiam', 'Yeni Otel Əlavə Et')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}... <a href="{{ url('/admin/oteller') }}" class="alert-link">Burdan </a>bütün otelləri görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/oteller') }}" method="POST" enctype="multipart/form-data">
        @include('backend.otels.form')

      </form>
    </div>
  </div>


@endsection