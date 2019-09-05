<div class="card">
  <div class="row">
    <!-- col-md-6 -->
    <div class="col-md-6 col-12 padd-top-20">
      @csrf
      <div class="col-md-12">
        <div class="form-group">
          <label>İstifadəçi Adı *</label>
          <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name}}">
          {{ $errors->first('name') }}
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Ad *</label>
          <input type="text" name="fName" class="form-control" value="{{ old('fName') ?? $user->fName}}">
          {{ $errors->first('fName') }}
        </div>

      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Soyad *</label>
          <input type="text" name="lName" class="form-control" value="{{ old('lName') ?? $user->lName}}">
          {{ $errors->first('lName') }}
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Mail *</label>
          <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email}}">
          {{ $errors->first('email') }}
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label>Şifrə *</label>
          <input name="password" type="password" class="form-control" value="{{ old('password') }}">
        </div>
        {{ $errors->first('password') }}
      </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="exampleInputFile">İtifadəçi Profil Şəkli</label>
            <input type="file" name="photo" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">İstifadəçi profil şəklini burdan yükləyə bilərsiniz... (<b>Məsləhət görülür </b>250x250)</small>
          </div>
          {{ $errors->first('photo') }}
        </div>
    </div>

    <!-- col-md-6 -->
    <div class="col-md-6 col-12 padd-top-20">


      <div class="col-md-12">
        <div class="form-group">
          <label>Telefon *</label>
          <input type="tel" name="phone" class="form-control" value="{{ old('phone') ?? $user->phone }}">
        </div>
        {{ $errors->first('phone') }}
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label>Ölkə *</label>
          <input type="text" name="country" class="form-control" value="{{ old('country') ?? $user->country }}">
        </div>
        {{ $errors->first('country') }}
      </div>
      <!-- col-md-12 -->
      <div class="col-md-12">

        <div class="row">
          <div class="col-md-12 col-12">
            <div class="form-group">
              <label>Şəhər *</label>
              <input type="text" name="city" class="form-control" value="{{ old('city') ?? $user->city }}">
            </div>
            {{ $errors->first('city') }}
          </div>
          <div class="col-md-12 col-12">
            <div class="form-group">
              <label>Küçə *</label>
              <input type="text" name="street" class="form-control" value="{{ old('street') ?? $user->street }}">
            </div>
            {{ $errors->first('street') }}
          </div>
          <div class="col-md-12 col-12">
            <div class="form-group">
              <label for="exampleSelect1">İstifadəçi Rütbəsi *</label>
              <select name="level" class="form-control" id="exampleSelect1">
                @foreach($user->userOptions() as $key => $value)
                  <option value="{{ $key }}" {{ $user->level == $key ? 'selected' : ''}}>{{ $value }}</option>
                @endforeach
              </select>
              {{ $errors->first('level') }}
            </div>
          </div>
        </div>
        <!-- col-md-12 -->
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