<div class="card">
  <div class="row">
    <!-- col-md-6 -->
    <div class="col-md-12 col-12 padd-top-20">
      @csrf

      <div class="col-md-12">
        <div class="form-group">
          <label>Restoran Başlığı *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') ?? $restoran->name}}">
          {{ $errors->first('name') }}
        </div>
      </div>

      <div class="col-md-12 col-12">
        <div class="form-group">
          <label for="ckeditor">Restoran Post Açıqlaması *</label>
          <textarea name="description" class="form-control" id="ckeditor" rows="3">{{ old('description') ?? $restoran->description }}</textarea>
        </div>
        {{ $errors->first('description') }}
      </div>
      <div class="col-md-12 col-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="qiymet">Restoran Qiyməti ( <b>1 nəfər üçün</b> ) *</label>
              <div class="input-group">
                <span class="input-group-addon">$</span>
                <input type="text" name="price" class="form-control" id="qiymet" value="{{ old('price') ?? $restoran->price }}" aria-label="Amount (to the nearest dollar)">
                <span class="input-group-addon">.00</span>
              </div>
              {{ $errors->first('price') }}
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleSelect1">Restoranın Yerləşdiyi Bölgə *</label>
              <select name="district" class="form-control" id="exampleSelect1">
                <option value="center" selected>Şəhər Mərkəzi</option>
                <option value="around">Şəhər Ətrafı</option>
              </select>
              {{ $errors->first('district') }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Restoran Adresi *</label>
          <input type="text" name="adress" class="form-control" value="{{ old('adress') ?? $restoran->adress}}">
          {{ $errors->first('adress') }}
        </div>
      </div>

      <div class="col-md-12 col-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleInputFile">Restoran Anasəhifə Şəkli</label>
              <input type="file" name="photo" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <small id="fileHelp" class="form-text text-muted">restoran anasəhifə şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>800x553 px)</small>
            </div>
            {{ $errors->first('photo') }}
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleInputFile">Restoran Post Şəkli</label>
              <input type="file" name="singlePhoto" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <small id="fileHelp" class="form-text text-muted">restoranin post bölüm şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>1400x470 px)</small>
            </div>
            {{ $errors->first('singlePhoto') }}
          </div>
        </div>
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
