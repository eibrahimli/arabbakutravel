@extends('backend.layouts.myapp')

@section('whereiam', 'Yeni Tur Əlavə Et')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}... <a href="{{ url('/admin/turlar') }}" class="alert-link">Burdan </a>bütün turları görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/turlar') }}" method="POST" enctype="multipart/form-data">
        @include('backend.turs.form')

      </form>
    </div>
  </div>


@endsection