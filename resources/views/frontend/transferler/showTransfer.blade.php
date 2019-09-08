@extends('frontend.layouts.app')

@section('title', $setting->siteTitle.' | '.$transfer->name. ' başlıqlı transfer')

@section('menualt')
    <section class="parallax-window" data-parallax="scroll"
             data-image-src="{{ url('storage/'.$transfer->singlePhoto) }}" data-natural-width="1400"
             data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>{{ $transfer->name }}</h1>
                        <span>{{ $transfer->adress }}</span>
                    </div>
                    <div class="col-md-4">
                        <div id="price_single_main">
                            {{ __('frontend.person') }} <span><sup>$</sup>{{ $transfer->price }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container margin_60">
        <div class="row">
            <div class="col-lg-8" id="single_tour_desc">

                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('frontend.turAciq') }}</h3>
                    </div>
                    <div class="col-lg-9">
                      <?=$transfer->description?>
                    </div>
                </div>

                <hr>

            </div>
            <!--End  single_tour_desc-->

            <aside class="col-lg-4">
                @if(Auth::check())
                    <form action="{{ url('transfersifaris/'.auth()->user()->id) }}" method="post">
                        @csrf
                        <div class="box_style_1 expose">
                        <h3 class="inner">- {{ __('frontend.booking') }} -</h3>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('frontend.adults') }}</label>
                                    <div class="numbers-row">
                                        <form action="" onsubmit="return false;">
                                            <input type="text" value="1" id="adults" class="qty2 form-control"
                                                   name="adults">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="transfer_id" value="{{ $transfer->id }}">
                            <input type="hidden" name="title" value="{{ $transfer->name }}">
                            <input type="hidden" name="price" value="{{ $transfer->price }}">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('frontend.children') }}</label>
                                    <div class="numbers-row">
                                        <input type="text" value="0" id="children" class="qty2 form-control"
                                               name="child">
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Select a date</label>
                                    <input name="date" class="date-pick form-control" data-date-format="M d, D" type="text">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label><i class=" icon-clock"></i> Time</label>
                                    <input name="time" class="time-pick form-control" value="12:00 AM" type="text">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>@lang('frontend.pickUpAdress')</label>
                                    <select id="address_2" class="form-control" name="pickUpAdress">
                                        @foreach($transfer->pickUpAdress as $pickUpAdress)
                                            <option value="{{ $pickUpAdress }}">{{ $pickUpAdress }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ trans('frontend.dropOffAdress') }}</label>
                                    <select id="address_2" class="form-control" name="dropOffAdress">
                                        @foreach($transfer->dropOffAdress as $dropOffAdress)
                                            <option value="{{ $dropOffAdress }}">{{ $dropOffAdress }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <br>
                        <table class="table table_summary">
                            <tbody>
                            <tr>
                                <td>
                                    {{ __('frontend.adults') }}
                                </td>
                                <td class="text-right">
                                    <span id="adults"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ __('frontend.children') }}
                                </td>
                                <td class="text-right">
                                    <span id="child"></span>
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <tr class="total">
                                <td>
                                    {{ __('frontend.totalCost') }}
                                </td>
                                <td class="text-right totalCost">
                                    <span>{{ $transfer->price }}</span>$
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn_full" type="submit">{{ __('frontend.book') }}</button>
                    </div>
                    </form>
                @else
                    <div class="alert alert-warning" role="alert" style="font-family: Nunito,sans-serif;">
                        @lang('frontend.bookingMessage') <a
                            href="{{ url('/login') }}"> @lang('frontend.fromHere') </a> @lang('frontend.orRegister')
                        <a href="{{ url('/register') }}">@lang('frontend.fromHere')</a> @lang('frontend.forBooking') ...
                    </div>
                    <div class="box_style_4">
                        <i class="icon_set_1_icon-90"></i>
                        <h4><span>{{ __('frontend.bookbyphone') }}</span></h4>
                        <a href="tel://+994{{ $setting->siteNum }}" class="phone">+994{{ $setting->siteNum }}</a>
                    </div>
                @endif
            </aside>
        </div>
        <!--End row -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function(){
            $('.inc,.dec').on('click',function () {
                let adults = $('#adults').val();
                let child = $('#children').val();
                $('span#adults').text(adults);
                $('span#child').text(child);

                let turQiymet = "<?=$transfer->price?>";

                let x = parseInt(adults);
                x = x*turQiymet;
                $('td.totalCost span').text(x);
            })
        });
        $('input.date-pick').datepicker({
            format: 'dd/mm/yyyy',
            language: 'az',
        });
        $('input.time-pick').timepicker({
            minuteStep: 15,
            showInpunts: false,
            showMeridian: false
        })
    </script>

@endsection
