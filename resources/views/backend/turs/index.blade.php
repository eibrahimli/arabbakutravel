@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Turlar')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}... <a href="{{ url('/admin/turlar/create') }}" class="alert-link">Burdan </a>yeni tur əlavə edə bilərsiniz.
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
                <th>Açıqlama</th>
                <th>Ayarlar</th>
              </tr>
              </thead>

              <tbody>

              @foreach($turs as $tur)

                <tr>
                  <td><a target="_blank" href="{{ url('/storage/'.$tur->turP) }}"><img src="{{ url('/storage/'.$tur->turP) }}" class="avatar img-circle" alt="Avatar">{{ mb_substr(strip_tags($tur->turBas), 0 ,30) }}</a></td>
                  <td>{{ $tur->categorie->name}}</td>
                  <td>{{ $tur->turQiy }}</td>
                  <td>{{ mb_substr(strip_tags($tur->turAciq), 0 ,30) }}</td>
                  <td>
                    <a href="{{ url('/admin/turlar/'.$tur->id.'/edit') }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>
                    <a href="{{ url('/admin/turlar/'.$tur->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                  </td>
                </tr>

              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{ $turs->links() }}
    </div>

  </div>

@endsection