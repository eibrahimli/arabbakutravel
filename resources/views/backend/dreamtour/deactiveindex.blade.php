@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Aktiv Olmayan DreamTurlar')

@section('content')
  

  @if(session('status'))

    <div class="alert alert-success" role="alert">

      {{ session('status') }}

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

                <th>Şəhər</th>

                <th>Açıqlama</th>

                <th>Cədvəl</th>

                <th>Qiymət</th>

                <th>Ayarlar</th>

              </tr>

              </thead>

              <tbody>

              @foreach($turs as $tur)

                <tr>

                  <td>{{ $tur->title }}</td>

                  <td>{{ $tur->city}}</td>

                  <td>{{ mb_substr(strip_tags($tur->desc), 0 ,30) }}</td>

                  <td>{{ mb_substr(strip_tags($tur->schedule), 0 ,30) }}</td>

                  <td>{{ $tur->price }}</td>

                  <td>

                    <a href="{{ url('/admin/dreamtur/'.$tur->id.'/show') }}" class="settings" title="Göstər" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>
                    <a href="{{ route('dreamtouractive',$tur->id) }}" class="Aktiv" title="Aktiv Et" data-toggle="tooltip" data-original-title="Aktiv"><i class="ti-check"></i></a>
                    <a href="{{ route('delete',$tur->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close"></i></a>

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