@extends('backend.layouts.myapp')

@section('whereiam', 'Yeni Transfer Əlavə Et')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}... <a href="{{ url('/admin/transferler') }}" class="alert-link">Burdan </a>bütün transferləri görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/transferler') }}" method="POST" enctype="multipart/form-data">
        @include('backend.transfers.form')

      </form>
    </div>
  </div>


@endsection