@extends('backend.layouts.myapp')

@section('whereiam', 'Yeni Restoran Əlavə Et')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}... <a href="{{ url('/admin/restoranlar') }}" class="alert-link">Burdan </a>bütün restoranları görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/restoranlar') }}" method="POST" enctype="multipart/form-data">
        @include('backend.restorans.form')

      </form>
    </div>
  </div>


@endsection