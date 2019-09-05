@extends('backend.layouts.myapp')

@section('whereiam', 'Yeni İstifadəçi Yarat')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          Yeni istifadəçi əlavə edildi... <a href="{{ url('/admin/users') }}" class="alert-link">Burdan </a>bütün İstifadəçiləri görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/users') }}" method="POST" enctype="multipart/form-data">
        @include('backend.users.form')

      </form>
    </div>
  </div>


@endsection