@extends('backend.layouts.myapp')

@section('whereiam', 'Bütün Transferlər')

@section('content')

  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}... <a href="{{ url('/admin/transferler/create') }}" class="alert-link">Burdan </a>yeni transfer əlavə edə bilərsiniz.
    </div>
  @endif

 @if(count($transfers) > 0)
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
                 <th>Götürüləcək Adres</th>
                 <th>Aparılacaq Adres</th>
                 <th>Ayarlar</th>
               </tr>
               </thead>

               <tbody>

               @foreach($transfers as $transfer)

                 <tr>
                   <td><a target="_blank" href="{{ url('storage/'.$transfer->singlePhoto) }}"><img src="{{ url('storage/'.$transfer->singlePhoto) }}" class="avatar img-circle" alt="Avatar">{{ mb_substr(strip_tags($transfer->name), 0 ,30) }}</a></td>
                   <td>{{ $transfer->price}}</td>
                   <td>{{ mb_substr(strip_tags($transfer->description), 0 ,30) }}</td>
                   <td>{{ mb_substr(strip_tags($transfer->pickUpAdress), 0 ,20) }}</td>
                   <td>{{ mb_substr(strip_tags($transfer->dropOffAdress), 0 ,20) }}</td>
                   <td>
                     <a href="{{ url('/admin/transferler/'.$transfer->id.'/edit') }}" class="settings" title="Redaktə Et" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings"></i></a>
                     <a href="{{ url('/admin/transferler/'.$transfer->id) }}" class="delete" title="Sil" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a>
                   </td>
                 </tr>

               @endforeach

               </tbody>
             </table>
           </div>
         </div>
       </div>

       {{ $transfers->links() }}
     </div>

   </div>
 @else
   <div class="alert alert-danger" role="alert">
     Hələki sayta transfer əlavə edilməyib... <a href="{{ url('/admin/transferler/create') }}" class="alert-link">Burdan </a>yeni transfer əlavə edə bilərsiniz.
   </div>
 @endif


@endsection