<?php
  $menu = [
    "index" => [
      "id" => "anasehife",
      "title" => "AnaSəhifə",
      "icon" => "ti-dashboard"
    ],
    'settings' => [
      'id' => 'settings',
      'title' => 'Ayarlar',
      'icon' => 'ti-settings'
    ],
    'sehifeler' => [
      'id' => 'sehifeler',
      'title' => 'Səhifələr',
      'icon' => ' ti-view-grid',
      'submenu' => [
        'aboutus' => 'Haqqımızda',
      ]
    ],
    'users' => [
      'id' => 'users',
      'title' => 'İstifadəçilər',
      'icon' => ' fa fa-users',
      'submenu' => [
        '/' => 'Bütün İstifadəçilər',
        'create' => 'Yeni İstifadəçi'
      ]
    ],
    'turlar' => [
      'id' => 'turlar',
      'title' => 'Turlar',
      'icon' => ' ti-view-grid',
      'submenu' => [
        '/' => 'Bütün Turlar',
        'create' => 'Yeni Tur'
      ]
    ],
    'sifarisler' => [
      'id' => 'sifarisler',
      'title' => 'Sifarişlər',
      'icon' => ' ti-view-grid',
      'submenu' => [
        'turaktivsifarisler' => 'Tur Aktiv Sifarişlər',
        'turdeaktivsifarisler' => 'Tur Aktiv Olmayan Sifarişlər'
      ]
    ],
    'kateqoriyalar' => [
      'id' => 'kateqoriyalar',
      'title' => 'Kateqoriyalar',
      'icon' => ' ti-view-grid',
      'submenu' => [
        '/' => 'Kateqoriyalar',
        'create' => 'Yeni Kateqoriya'
        ]
      ],
      'oteller' => [
        'id' => 'oteller',
        'title' => 'Otellər',
        'icon' => 'ti-view-grid',
        'submenu' => [
          '/' => 'Bütün Otellər',
          'create' => 'Yeni Otel'
        ]
    ],
    'transferler' => [
      'id' => 'transferler',
      'title' => 'Transferlər',
      'icon' => 'ti-view-grid',
      'submenu' => [
        '/' => 'Bütün Transferlər',
        'create' => 'Yeni Transfer'
      ]
    ],
    'restoranlar' => [
      'id' => 'restoranlar',
      'title' => 'Restoranlar',
      'icon' => 'ti-view-grid',
      'submenu' => [
        '/' => 'Bütün Restoranlar',
        'create' => 'Yeni Restoran'
      ]
    ],

  ];
?>
<nav class="navbar navbar-expand-lg bb-1 navbar-light br-full-dark bg-dark fixed-top" id="mainNav">

  <!-- Start Header -->
  <header class="header-logo bg-dark bb-1 br-1 br-light-dark">
    <a class="nav-link text-center mr-lg-3 hidden-xs" id="sidenavToggler"><i class="ti-align-left"></i></a>
    <a class="gredient-cl navbar-brand" href="{{ url('/admin') }}">Admin Panel</a>
  </header>
  <!-- End Header -->

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="ti-align-left"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarResponsive">
<?php
  $url = url()->full();
  $url = explode('/', $url);

?>
    <!-- =============== Start Side Menu ============== -->
    <div class="navbar-side">
      <ul class="navbar-nav navbar-sidenav bg-light-dark" id="exampleAccordion">
        @foreach($menu as $key => $value)
          <li class="nav-item <?php if(@$url[4] == $key || !isset($url[4]) && $key == 'index')  echo 'active';?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
              @if(@$value['submenu'])
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#{{$value['id']}}" data-parent="#exampleAccordion">
              @else
                <a class="nav-link" href="/admin/{{$key}}">
              @endif
              <i class="ti i-cl-1 {{ $value['icon'] }}"></i>
              <span class="nav-link-text">{{ $value['title'] }}</span>
            </a>
            @if(@$value['submenu'])
               <ul class="sidenav-second-level collapse" id="{{ $value['id'] }}">
                  @foreach($value['submenu'] as $subKey => $subValue)
                     <li>
                       <a href="{{ url('/admin/'.$key.'/'.$subKey)  }}">{{ $subValue }}</a>
                     </li>
                  @endforeach
               </ul>
            @endif
          </li>
        @endforeach

      </ul>
    </div>
    <!-- =============== End Side Menu ============== -->

    <!-- =============== Header Rightside Menu ============== -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-0 user-img a-topbar__nav a-nav" id="userDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ url('storage/'.Auth::user()->photo) }}" alt="user-img" width="36" class="img-circle">
          <b class="f-size-17">{{ Auth::user()->name }}</b>
        </a>

        <ul class="dropdown-menu dropdown-user animated flipInX" aria-labelledby="userDropdown">
          <li class="dropdown-header green-bg">
            <div class="header-user-det">
              <span class="a-dropdown__header-title">{{ Auth::user()->name }}</span>
              <span class="a-dropdown__header-subtitle">Saytın Admini</span>
            </div>
          </li>
           <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </ul>
      </li>
    </ul>
    <!-- =============== End Header Rightside Menu ============== -->
  </div>
</nav>