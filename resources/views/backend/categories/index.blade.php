@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Kateqoriyalar')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}... <a href="{{ url('/admin/kateqoriyalar/create') }}" class="alert-link">Burdan </a>yeni kateqoriya əlavə edə bilərsiniz.
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
                <th>Kateqoriya Nömrəsi</th>
                <th>Kateqoriya Adı</th>
                <th>Ayarlar</th>
              </tr>
              </thead>

              <tbody>

              @foreach($categories as $categorie)

                <tr>
                  <td>{{ $categorie->id }}</td>
                  <td>{{ $categorie->name }}</td>
                  <td>
                    <a href="{{ url('/admin/kateqoriyalar/'.$categorie->id.'/edit') }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>
                    <a href="{{ url('/admin/kateqoriyalar/'.$categorie->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                  </td>
                </tr>

              @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{ $categories->links() }}
    </div>

  </div>

@endsection