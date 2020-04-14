@extends('backend.layouts.myapp')



@section('whereiam', 'Bütün Aktiv DreamTurlar')



@section('content')
  

  @if(session('status'))

    <div class="alert alert-success" role="alert">

      {{ session('status') }}... <a href="{{ route('activedreamtours') }}" class="alert-link">Burdan </a>yeni tur əlavə edə bilərsiniz.

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

                  <td>

                    <a href="{{ route('dreamtourshow',[$tur->id]) }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>

                    <a href="{{ route('delete',[$tur->id]) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>

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