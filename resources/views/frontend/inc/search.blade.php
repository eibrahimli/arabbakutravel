<section id="search_container" style="background: url({{ url('storage/'.$siteAyar->menuP) }}) no-repeat center top; background-size: cover">
  <div id="search">
    <ul class="nav nav-tabs">
      <li><a href="#tours" data-toggle="tab" class="active show">Turlar</a></li>
      <li><a href="#hotels" data-toggle="tab">Otellər</a></li>
      <li><a href="#restaurants" data-toggle="tab">Restoranlar</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active show" id="tours">
        <h3>Tur axtar...</h3>
        <form action="{{ url('/turaxtar') }}" method="post">
          @csrf
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tur adı</label>
                <input type="text" class="form-control" id="firstname_booking" name="turBas" placeholder="Tur adını daxil edin">
              </div>
              {{ $errors->first('turBas') }}
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kateqoriya Seç</label>
                <select class="form-control" name="turKat">
                  <option value="0" selected>Bütün Turlar</option>
                  @if(count($categories) > 0)
                    @foreach($categories as $categorie)
                      <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              {{ $errors->first('turKat') }}
            </div>

        </div>

        <hr>
        <button type="submit" class="btn_1 green"><i class="icon-search"></i>Axtar</button>
        </form>
      </div>
      <!-- End rab -->
      <div class="tab-pane" id="hotels">
        <h3>Otel Axtarışı</h3>
        <form action="{{ url('/otelaxtar') }}" method="post">
          @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Otel Adı</label>
              <input type="text" class="form-control" id="hotel_name" name="name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Otel Nöqtəsi</label>
              <select class="form-control" name="district">
                <option value="center" selected>Şəhər Mərkəzi</option>
                <option value="around">Şəhər Ətrafı</option>
              </select>
            </div>
          </div>
        </div>
        <!-- End row -->
        <hr>
        <button type="submit" class="btn_1 green"><i class="icon-search"></i>Axtar</button>
        </form>
      </div>
      <div class="tab-pane" id="restaurants">
        <h3>Restoran Axtar</h3>
        <form action="{{ url('/restoranaxtar') }}" method="post">
          @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Restoran Adı</label>
              <input type="text" class="form-control" id="restaurant_name" name="restaurant_name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Restoran Kateqoriyası</label>
              <select class="form-control" name="district">
                <option value="center" selected>Şəhər Mərkəzi</option>
                <option value="around">Şəhər Ətrafı</option>
              </select>
            </div>
          </div>
        </div>
        <hr>
        <button type="submit" class="btn_1 green"><i class="icon-search"></i>Axtar</button>
        </form>
      </div>
    </div>
  </div>
</section>