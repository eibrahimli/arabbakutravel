@extends('backend.layouts.myapp')



@section('whereiam', 'İstifadəçilər')



@section('content')



  @if(session('status'))

    <div class="alert alert-success" role="alert">

      {{ session('status') }}... <a href="{{ url('/admin/users/create') }}" class="alert-link">Burdan </a>yeni istifadəçi əlavə edə bilərsiniz.

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

                <th>Ad Soyad</th>

                <th>Login</th>

                <th>Mail</th>

                <th>Rütbə</th>

                <th>Ölkə</th>

                <th>Şəhər</th>

                <th>Ayarlar</th>

              </tr>

              </thead>



              <tbody>



              @foreach($users as $user)



                <tr>

                  <td><a target="_blank" href="{{ url('/storage/'.$user->photo) }}"><img src="{{ url('/storage/'.$user->photo) }}" class="avatar img-circle" alt="Avatar">{{$user->fName.' '.$user->lName}}</a></td>

                  <td>{{ $user->name }}</td>

                  <td>{{ $user->email }}</td>

                  <td>{{ $user->level }}</td>

                  <td>{{ $user->country }}</td>

                  <td>{{ $user->city }}</td>

                  <td>

                    <a href="{{ url('/admin/users/'.$user->id.'/edit') }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>

                    <a href="{{ url('/admin/users/'.$user->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>

                  </td>

                </tr>



              @endforeach



              </tbody>

            </table>

          </div>

        </div>

      </div>



      {{ $users->links() }}

    </div>



  </div>



@endsection
