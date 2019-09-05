<div class="card">
  <div class="row">
    <!-- col-md-6 -->
    <div class="col-md-12 col-12 padd-top-20">
      @csrf

      <div class="col-md-12">
        <div class="form-group">
          <label>Tur Başlığı *</label>
          <input type="text" name="turBas" class="form-control" value="{{ old('turBas') ?? $tur->turBas}}">
          {{ $errors->first('turBas') }}
        </div>

      </div>
      <div class="col-md-12 col-12">
        <div class="form-group">
          <label for="exampleSelect1">Tur Kateqoriyası *</label>
          <select name="turKat" class="form-control" id="exampleSelect1">
            @foreach($categories as $categorie)
              <option value="{{ $categorie->id }}" {{ $categorie->id == $tur->turKat ? 'selected' : null }}>{{ ucfirst($categorie->name) }}</option>
            @endforeach
          </select>
          {{ $errors->first('turKat') }}
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Tur Qiyməti *</label>
          <input type="number" name="turQiy" class="form-control" value="{{ old('turQiy') ?? $tur->turQiy}}">
          {{ $errors->first('turQiy') }}
        </div>
      </div>
      <div class="col-md-12 col-12">
        <div class="form-group">
          <label for="ckeditor">Tur Post Açıqlaması *</label>
          <textarea name="turAciq" class="form-control" id="ckeditor" rows="3">{{ old('turAciq') ?? $tur->turAciq }}</textarea>
        </div>
        {{ $errors->first('turAciq') }}
      </div>
      <div class="col-md-12 col-12">
        <div class="form-group">
          <label for="exampleTextarea1">Tur Post Ediləcəklərin Cədvəli *</label>
          <textarea name="turCedvel" class="form-control ckeditor" id="ckeditor" rows="3">{{ old('turCedvel') ?? $tur->turCedvel }}</textarea>
        </div>
        {{ $errors->first('turCedvel') }}
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputFile">Tur Anasəhifə Şəkli</label>
          <input type="file" name="turP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Tur anasəhifə şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>800x553 px)</small>
        </div>
        {{ $errors->first('turP') }}
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="exampleInputFile">Tur Post Şəkli</label>
          <input type="file" name="turSingleP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Turun post bölümü şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>1400x470 px)</small>
        </div>
        {{ $errors->first('turSingleP') }}
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
