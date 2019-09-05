@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Restoranlar')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}... <a href="{{ url('/admin/restoranlar/create') }}" class="alert-link">Burdan </a>yeni restoran əlavə edə bilərsiniz.
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
                <th>Qiymət</th>
                <th>Açıqlama</th>
                <th>Yeri</th>
                <th>Adress</th>
                <th>Ayarlar</th>
              </tr>
              </thead>

              <tbody>

              @foreach($restorans as $restoran)

                <tr>
                  <td><a target="_blank" href="{{ url('/storage/'.$restoran->photo) }}"><img src="{{ url('/storage/'.$restoran->photo) }}" class="avatar img-circle" alt="Avatar">{{ mb_substr(strip_tags($restoran->name), 0 ,30) }}</a></td>
                  <td>{{ $restoran->price }}</td>
                  <td>{{ mb_substr(strip_tags($restoran->description), 0 ,30) }}</td>
                  <td>{{ $restoran->district == 'center' ? 'Şəhər Mərkəzi' : 'Şəhər Ətrafı' }}</td>
                  <td>{{ $restoran->adress }}</td>
                  <td>
                    <a href="{{ url('/admin/restoranlar/'.$restoran->id.'/edit') }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>
                    <a href="{{ url('/admin/restoranlar/'.$restoran->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                  </td>
                </tr>

              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{ $restorans->links() }}
    </div>

  </div>

@endsection