@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Otellər')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}... <a href="{{ url('/admin/oteller/create') }}" class="alert-link">Burdan </a>yeni otel əlavə edə bilərsiniz.
    </div>
  @endif

  <div class="row">
    <!-- Area Chart -->
    <div class="col-md-12 col-sm-12">
      <div class="card">
        <div class="card-body padd-0">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
              <tr>
                <th>Başlıq</th>
                <th>Kateqoriya</th>
                <th>Qiymət</th>
                <th>Adress</th>
                <th>Şəhər</th>
                <th>Yeri</th>
                <th>Ayarlar</th>
              </tr>
              </thead>

              <tbody>

              @foreach($otels as $otel)

                <tr>
                  <td><a target="_blank" href="{{ url('/storage/'.$otel->singlePhoto) }}"><img src="{{ url('/storage/'.$otel->singlePhoto) }}" class="avatar img-circle" alt="Avatar">{{ mb_substr(strip_tags($otel->name), 0 ,20) }}</a></td>
                  <td>{{ $otel->categorie}}</td>
                  <td>{{ $otel->price }}</td>
                  <td>{{ $otel->adress }}</td>
                  <td>{{ $otel->city }}</td>
                  <td>{{ $otel->district }}</td>
                  <td>
                    <a href="{{ url('/admin/oteller/'.$otel->id.'/edit') }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>
                    <a href="{{ url('/admin/oteller/'.$otel->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                  </td>
                </tr>

              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{ $otels->links() }}
    </div>

  </div>

@endsection