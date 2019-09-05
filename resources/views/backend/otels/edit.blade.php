@extends('backend.layouts.myapp')

@section('whereiam', 'Otel Redaktə Et')

@section('content')

  <div class="row">
    <div class="col-md-12">
      @if(session('message'))
        <div class="alert alert-success" role="alert">
          {{ session('message') }}... <a href="{{ url('/admin/oteller') }}" class="alert-link">Burdan </a>bütün otelləri görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/oteller/'.$otel->id) }}" method="POST" enctype="multipart/form-data">
        @include('backend.otels.form')
        @method("PATCH")
      </form>
    </div>
  </div>


@endsection