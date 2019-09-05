<div class="card">
  <div class="row">
    <!-- col-md-6 -->
    <div class="col-md-12 col-12 padd-top-20">
      @csrf

      <div class="col-md-12">
        <div class="form-group">
          <label>Transfer Başlığı *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') ?? $transfer->name}}">
          {{ $errors->first('name') }}
        </div>
      </div>

      <div class="col-md-12 col-12">
        <div class="form-group">
          <label for="ckeditor">Transfer Post Açıqlaması *</label>
          <textarea name="description" class="form-control" id="ckeditor" rows="3">{{ old('description') ?? $transfer->description }}</textarea>
        </div>
        {{ $errors->first('description') }}
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Transfer Qiyməti *</label>
          <input type="number" name="price" class="form-control" value="{{ old('price') ?? $transfer->price}}">
          {{ $errors->first('price') }}
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Transfer Götüreləcək Yer *</label>
          <input type="text" name="pickUpAdress" class="form-control" value="{{ old('pickUpAdress') ?? $transfer->pickUpAdress}}">
          {{ $errors->first('pickUpAdress') }}
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Transfer Aparılacaq Yer *</label>
          <input type="text" name="dropOffAdress" class="form-control" value="{{ old('dropOffAdress') ?? $transfer->dropOffAdress}}">
          {{ $errors->first('dropOffAdress') }}
        </div>
      </div>

      <div class="col-md-12 col-12">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleInputFile">Transfer Anasəhifə Şəkli</label>
              <input type="file" name="photo" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <small id="fileHelp" class="form-text text-muted">transfer anasəhifə şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>800x553 px)</small>
            </div>
            {{ $errors->first('photo') }}
          </div>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="exampleInputFile">Transfer Post Şəkli</label>
              <input type="file" name="singlePhoto" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
              <small id="fileHelp" class="form-text text-muted">Transferin post bölüm şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>1400x470 px)</small>
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
