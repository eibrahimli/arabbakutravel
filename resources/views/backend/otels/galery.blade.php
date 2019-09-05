@extends('backend.layouts.myapp')

@section('whereiam', '{ '.ucfirst($otel->name)." } adlı otelin qaleriyası")

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}... <a href="{{ url('/admin/oteller/'.@$galeries->otel_id.'/edit') }}" class="alert-link">Burdan </a> otelin qaleriyasına şəkil əlavə edə bilərsiniz.
    </div>
  @endif

  <div class="row">

    @foreach($galeries as $galerie)
      <div class="col-md-3 col-sm-6">
        <div class="card">
          <img class="card-img-top" src="{{ url('storage/'.$galerie->name) }}" alt="Resim">
          <div class="card-block">
            <a href="{{ url('/admin/oteller/qaleriya/sil/'.$galerie->id) }}" class="btn btn-radius btn-primary">Şəkili Sil</a>
          </div>
        </div>
      </div>
    @endforeach
    {{ @$galeries->links() }}
  </div>

@endsection