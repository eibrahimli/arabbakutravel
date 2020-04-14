@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | '.ucfirst($user->name).' adlı istifadəçinin məlumatları')

@section('menualt')

    <section class="parallax-window" data-parallax="scroll" data-image-src="{{ url('storage/'.$siteAyar->tursP) }}"
             data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>@lang('frontend.profileTitle')</h1>
                <p class="subtitle">@lang('frontend.profileSubTitle')</p>
            </div>
        </div>
    </section>

@endsection

@section('content')

    <div class="margin_60 container">
        <div id="tabs" class="tabs">
            <nav>
                <ul>
                    <li><a href="#section-1" class="icon-booking"><span>@lang('frontend.bookings')</span></a>
                    </li>
                    <li><a href="#section-3" class="icon-settings"><span>@lang('frontend.settings')</span></a>
                    </li>
                    <li><a
                            href="#section-4" class="icon-profile"><span>@lang('frontend.userProfile')</span></a>
                    </li>
                </ul>
            </nav>
            <div class="content">
                @if(session('transferSifarisStatus'))
                    <div class="alert alert-success alert-dismissible margin_30">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ session('transferSifarisStatus') }}
                    </div>
                @endif

                <section id="section-1"
                         @if(!session('statusProfile') || !session('ok') == true) class="content-current" @endif>
                    <div id="tools">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-6">
                                <div class="styled-select-filters">
                                    <select name="sort_type" id="sort_type">
                                        <option value="" selected>Sort by type</option>
                                        <option value="tours">Tours</option>
                                        <option value="transfers">Transfers</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/tools -->

                    @if(count($tursifarisler)>0)
                        @foreach($tursifarisler as $tursifaris)

                            <div class="strip_booking">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2">
                                        <div class="date">
                                            <span class="month">{{ $data[$tursifaris->id] }}</span>
                                            <span class="day"><strong>{{ explode('-',explode(' ',$tursifaris->created_at)[0])[2] }}</strong></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-5">
                                        <h3 class="tours_booking">{{ $tursifaris->title }}<span>{{ $tursifaris->adults }} {{ __('frontend.adults') }} / {{ $tursifaris->child }} {{ __('frontend.children') }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <ul class="info_booking">
                                            <li><strong>@lang('frontend.bookingId')</strong> {{ $tursifaris->id }}</li>
                                            <li><strong> @lang('frontend.bookedOn') </strong> {{ explode('-',explode(' ',$tursifaris->created_at)[0])[2] }} {{ $data[$tursifaris->id] }}. {{ explode('-',explode(' ',$tursifaris->created_at)[0])[0] }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="booking_buttons">
                                            <a href="{{ url('tursifaris/sil/'.$tursifaris->id) }}" class="btn_3">{{ $tursifaris->status == '0' ? trans('frontend.cancel') : trans('frontend.delete') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End row -->
                            </div>

                        @endforeach
                            {{ $tursifarisler->links() }}
                    @else
                        <div class="alert alert-success" role="alert">
                            {{ trans('frontend.emptyTurBooking') }}
                        </div>
                    @endif

                </section>
                <!-- End section 1 -->

                <section id="section-3">
                    <div class="row">

                        <div class="col-md-6 add_bottom_30">
                            <form action="{{ url('/profile/changep/'.Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if(session('statusp'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('statusp') }}...
                                    </div>
                                @endif
                                <h4>@lang('frontend.changeP')</h4>
                                <div class="form-group">
                                    <label>@lang('frontend.newPass')</label>
                                    <input class="form-control" name="password" id="new_password" type="password">
                                </div>
                                {{ $errors->first('password')}}
                                <div class="form-group">
                                    <label>@lang('frontend.confirmP')</label>
                                    <input class="form-control" name="password_confirmation" id="confirm_new_password"
                                           type="password">
                                </div>
                                {{ $errors->first('password_confirmation')}}
                                <button type="submit" class="btn_1 green">@lang('frontend.updatePass')</button>
                            </form>
                        </div>


                        <div class="col-md-6 add_bottom_30">
                            @if(session('statusm'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('statusm') }}...
                                </div>
                            @endif
                            <form action="{{ url('/profile/changem/'.Auth::user()->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <h4>{{ __('frontend.changeEmail') }}</h4>
                                <div class="form-group">
                                    <label>{{ __('frontend.newEmail') }}</label>
                                    <input class="form-control" name="email" id="new_password" type="text">
                                </div>
                                {{ $errors->first('email') }}
                                <div class="form-group">
                                    <label>{{ __('frontend.confirmEmail') }}</label>
                                    <input class="form-control" name="email_confirmation" id="confirm_new_password"
                                           type="text">
                                </div>
                                <button type="submit" class="btn_1 green">{{ __('frontend.updateEmail') }}</button>
                            </form>
                        </div>
                    </div>
                    <!-- End row -->

                    <hr>
                    <br>
                </section>
                <!-- End section 3 -->

                <section id="section-4"
                         @if(session('statusProfile') || session('ok') == true) class="content-current" @endif>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>@lang('frontend.yourprofile')</h4>
                            <ul id="profile_summary">
                                <li>@lang('frontend.username') <span>{{ $user->email }}</span>
                                </li>
                                <li>@lang('frontend.firstname') <span>{{ $user->fName }}</span>
                                </li>
                                <li>@lang('frontend.lastname') <span>{{ $user->lName }}</span>
                                </li>
                                <li>@lang('frontend.phonenumber') <span>{{ $user->phone }}</span>
                                </li>
                                <li>@lang('frontend.streetadress') <span>{{ $user->street }}</span>
                                </li>
                                <li>@lang('frontend.city') <span>{{ $user->city }}</span>
                                </li>
                                <li>@lang('frontend.country')<span>{{ $user->country }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <img
                                    src="{{ $user->photo == null ? url('frontend/img/tourist_guide_pic.jpg') : url('storage/'.$user->photo) }}"
                                    alt="Image" class="img-fluid styled profile_pic">
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @if(session('statusProfile'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('statusProfile') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- End row -->

                    <div class="divider"></div>
                    <form action="{{ url('/editprofile/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h4>@lang('frontend.editprofile')</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ ucfirst(strtolower(__('frontend.firstname'))) }}</label>
                                    <input class="form-control" name="fName" id="first_name" type="text"
                                           value="{{ old('fName') ?? $user->fName }}">
                                </div>
                                {{ $errors->first('fName') }}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ ucfirst(strtolower(__('frontend.lastname'))) }}</label>
                                    <input class="form-control" name="lName" id="last_name" type="text"
                                           value="{{ old('lName') ?? $user->lName }}">
                                </div>
                                {{ $errors->first('lName') }}
                            </div>
                        </div>
                        <!-- End row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ ucfirst(strtolower(__('frontend.phonenumber2'))) }}</label>
                                    <input class="form-control" name="phone" id="phone" type="text"
                                           value="{{ old('phone') ?? $user->phone }}">
                                </div>
                                {{ $errors->first('phone') }}
                            </div>
                        </div>
                        <!-- End row -->

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>@lang('frontend.editadress')</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('frontend.streetadress2') }}</label>
                                    <input class="form-control" name="street" id="first_name" type="text"
                                           value="{{ old('street') ?? $user->street }}">
                                </div>
                                {{ $errors->first('street') }}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ __('frontend.city2') }}</label>
                                    <input class="form-control" name="city" id="last_name" type="text"
                                           value="{{ old('city') ?? $user->city }}">
                                </div>
                                {{ $errors->first('city') }}
                            </div>
                        </div>
                        <!-- End row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('frontend.country2')</label>
                                    <input type="text" name="country" class="form-control"
                                           value="{{ old('country') ?? $user->country }}">
                                </div>
                                {{ $errors->first('country') }}
                            </div>
                        </div>
                        <!-- End row -->

                        <hr>
                        <h4>@lang('frontend.uploadprofilephoto')</h4>
                        <div class="form-inline upload_1">
                            <div class="form-group">
                                <input type="file" name="photo">
                            </div>
                        </div>

                        <hr>
                        <button type="submit" class="btn_1 green">@lang('frontend.updateprofile')</button>
                    </form>
                </section>
                <!-- End section 4 -->


            </div>
            <!-- End content -->
        </div>
        <!-- End tabs -->
    </div>
    <!-- end container -->

@endsection

@section('js')

    <script src="{{ asset('frontend/js/tabs.js') }}"></script>
    <script>
        new CBPFWTabs(document.getElementById('tabs'));
    </script>
    <script>
        $(window).load(function () {
            if('{{ session("tabcurrent") }}' == 'dreamtour') {
                $('nav ul li').removeClass('tab-current');
                $('section').removeClass('content-current');
                $('nav ul li:nth-child(4)').addClass('tab-current');
                $('#section-5').addClass('content-current');
            }
        })
        $('#sort_type').on('change', function (c) {
            let m = $(this).val();
            let url;
            if (m == 'tours') {
                url = "{{ url('profile/'.auth()->user()->id) }}";
                window.location.replace(url);
            } else if (m == 'transfers') {
                url = "{{ url('profile/'.auth()->user()->id) }}/" + m;
                window.location.replace(url);
            }

        });

        $('nav li:')
    </script>

    <!--<script type="text/javascript">

  $(function(){

      $('#ajasxSubmit').on('click', function (e) {
        e.preventDefault();
        let fName = $('input[name=fName]').val();
        let lName = $('input[name=lName]').val();
        let street = $('input[name=street]').val();
        let city = $('input[name=city]').val();
        let country = $('input[name=country]').val();
        let phone = $('input[name=phone]').val();
        let photo = $('input[name=photo]').val();

        $.ajaxSetup({
           'headers': {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
        $.ajax({
           type : 'POST',
           url : "{{url('/editprofile/'.$user->id) }}",
           datatype: 'json',
           data: {fName:fName, lName: lName, street:street,city:city,country:country,phone:phone,photo:photo},
           success : function(data) {
               alert(data.success.message.errors());
           }

        });

      });

  });

</script> -->

@endsection

@section('css')
    <link href="{{ asset('frontend/css/admin.css') }}" rel="stylesheet">
    <style type="text/css">
        label, span {
            font-family: Nunito, sans-serif;
            font-size: 13px;
        }

        .subtitle {
            font-family: "Montserrat", Arial, sans-serif;
            font-size: 15px;
        }

        input.form-control {
            font-family: "Montserrat", Arial, sans-serif;
            font-size: 13px;
        }
    </style>

@endsection
