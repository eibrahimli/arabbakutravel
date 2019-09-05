<div class="card">
  <div class="row">
    <!-- col-md-6 -->
    <div class="col-md-12 col-12 padd-top-20">
      @csrf

      <div class="col-md-12">
        <div class="form-group">
          <label>Otel Adı *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') ?? $otel->name}}">
          {{ $errors->first('name') }}
        </div>
      </div>
      <div class="col-md-12 col-12">
        <div class="form-group">
          <label for="ckeditor">Otel Açıqlaması *</label>
          <textarea name="description" class="form-control" id="ckeditor" rows="3">{{ old('description') ?? $otel->description }}</textarea>
        </div>
        {{ $errors->first('description') }}
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Otel Adresi *</label>
          <input type="text" name="adress" class="form-control" value="{{ old('adress') ?? $otel->adress}}">
          {{ $errors->first('adress') }}
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="qiymet">Otel Qiyməti ( <b>1 gecəlik</b> ) *</label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" name="price" class="form-control" id="qiymet" value="{{ old('price') ?? $otel->price }}" aria-label="Amount (to the nearest dollar)">
                <span class="input-group-addon">.00</span>
              </div>
              {{ $errors->first('price') }}
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleSelect1">Otel Kateqoriyası *</label>
              <select name="category" class="form-control" id="exampleSelect1">
                <option value="5" selected>Beş Ulduzlu</option>
                <option value="4" {{ $otel->category == '4' ? 'selected' : null }}>Dörd Ulduzlu</option>
                <option value="3" {{ $otel->category == '3' ? 'selected' : null }}>Üç Ulduzlu</option>
                <option value="2" {{ $otel->category == '2' ? 'selected' : null }}>İki Ulduzlu</option>
                <option value="1" {{ $otel->category == '1' ? 'selected' : null }}>Bir Ulduzlu</option>
              </select>
              {{ $errors->first('category') }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label>Otelin Olduğu Şəhər *</label>
              <input type="text" name="city" class="form-control" value="{{ old('city') ?? $otel->city}}">
              {{ $errors->first('city') }}
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleSelect1">Otel Yerləşdiyi Bölgə *</label>
              <select name="district" class="form-control" id="exampleSelect1">
                <option value="center" selected>Şəhər Mərkəzi</option>
                <option value="around" {{ $otel->district == 'around' ? 'selected' : null }}>Şəhər Ətrafı</option>
              </select>
              {{ $errors->first('district') }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleInputFile">Otel Anasəhifə Şəkli</label>
              <input type="file" name="photo" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <small id="fileHelp" class="form-text text-muted">Otel anasəhifə şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>800x553 px)</small>
            </div>
            {{ $errors->first('photo') }}
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleInputFile">Otel Post Şəkli</label>
              <input type="file" name="singlePhoto" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <small id="fileHelp" class="form-text text-muted">Otel post bölümü şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>1400x470 px)</small>
            </div>
            {{ $errors->first('singlePhoto') }}
          </div>
        </div>
      </div>
      @if(strstr(url()->current(),'edit'))
      <div class="col-md-12 col-12">
        <div class="alert alert-warning" role="alert">
          Otel qaleriyasına baxmaq üçün <a href="{{ url('/admin/oteller/qaleriya/'.$otel->id) }}" class="alert-link">Bura</a>. klikləyin...
        </div>
      </div>
      @endif
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputFile">Otel Galeriya Şəkilləri</label>
          <input type="file" name="galery[]" multiple class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Otel post bölümü şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>1400x470 px)</small>
        </div>
        {{ $errors->first('singlePhoto') }}
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="form-group">
      <div class="text-center">
        <button type="submit" class="btn gredient-btn disabled">Yenilə</button>
      </div>
    </div>
  </div>

</div>
</div>
