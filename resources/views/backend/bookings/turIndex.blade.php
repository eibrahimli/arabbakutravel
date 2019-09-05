@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Aktiv Tur Sifarişləri')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}...
    </div>
  @endif

  @if(count($sifarisler) == 0)
    <div class="alert alert-warning" role="alert">
      Hələki saytda aktif edilən bir tur yoxdur..
    </div>
  @else

  <!-- row -->
  <div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="data-table-advance" class="table table-lg table-hover">
                <thead>
                <tr>
                  <th>Tur Başlıq</th>
                  <th>Sifarişçi</th>
                  <th>Email</th>
                  <th>Nömrə</th>
                  <th>Yetkin | Uşaq</th>
                  <th>Qiymət</th>
                  <th>Tarix</th>
                  <th>Ayarlar</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($sifarisler as $sifaris)

                    <tr>
                      <td>{{ mb_substr($sifaris->title,0 ,12) }}</td>
                      <td>{{ $sifaris->customer }}</td>
                      <td>{{ $sifaris->email }}</td>
                      <td>{{ $sifaris->phone }}</td>
                      <td>{{ $sifaris->adults }} | {{ $sifaris->child }}</td>
                      <td>$ {{ $sifaris->price }}</td>
                      <td>{{ date("d/m/Y", strtotime($sifaris->created_at)) }}</td>
                      <td><a href="{{ url('/admin/sifaris/sil/'.$sifaris->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Sil"><i class="ti-trash"></i></a></td>
                    </tr>

                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
    </div>
  </div>
  <!-- /.row -->

  @endif

@endsection

@section('js')

  <!-- Data Table Js -->
  <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
  <script>
      $(document).ready(function() {
          $('#data-table-advance').DataTable();
      } );
  </script>

@endsection

@section('css')

  <!-- Page level plugin CSS -->
  <link href="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

@endsection