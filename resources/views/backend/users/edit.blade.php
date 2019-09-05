@extends('backend.layouts.myapp')

@section('whereiam', 'İstifadəçini Redaktə Et')

@section('content')

  <div class="row">

    <div class="col-md-12">
      @if(session('status'))
        <div class="alert alert-success" role="alert">
          {{ session("status") }}... <a href="{{ url('/admin/users') }}" class="alert-link">Burdan </a>bütün İstifadəçiləri görüntülüyə bilərsiniz.
        </div>
      @endif
      <form action="{{ url('/admin/users/'.$user->id) }}" method="POST" enctype="multipart/form-data">
        @include('backend.users.form')
        @method('PATCH')
      </form>
    </div>
  </div>


@endsection