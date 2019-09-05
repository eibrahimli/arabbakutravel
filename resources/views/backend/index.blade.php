@extends('backend.layouts.myapp')

@section('whereiam', 'Admin Panel')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="bd-example">
        <div class="jumbotron">
          <h1 class="display-4">Salam admin bura sənin panelindir !</h1>
          <p class="lead">Admin paneldən istifadə edərək sayta otel,tur paketi,istifadəçi və bir çox xüsusiyyət əlavə edə bilərsən. Uğurlar !!</p>
        </div>
      </div>
      @if(session('status'))
        <div class="alert alert-success">
          {{ session('status') }} ...
        </div>
      @endif
      <form action="{{ url('/admin/site/'.$siteAyar->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="card">
          <div class="row">
            <!-- col-md-6 -->
            <div class="col-md-12 col-12 py-3">

              <div class="col-md-12 col-12">

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Video Başlığı *</label>
                      <input type="text" name="videoTitle" class="form-control" value="{{ old('videoTitle') ?? $siteAyar->videoTitle }}">
                      {{ $errors->first('videoTitle') }}
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Video Alt Başlığı *</label>
                      <input type="text" name="videoSubTitle" class="form-control" value="{{ old('videoSubTitle') ?? $siteAyar->videoSubTitle }}">
                      {{ $errors->first('videoSubTitle') }}
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label>Video Url *</label>
                      <input type="text" name="videoUrl" class="form-control" value="{{ old('videoUrl') ?? $siteAyar->videoUrl }}">
                      {{ $errors->first('videoUrl') }}
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Anasəhifə Video altındakı şəkil</label>
                      <input type="file" name="videoP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1500x1000px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('videoP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Anasəhifə menu alt şəkil</label>
                      <input type="file" name="menuP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1600x622px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('menuP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Anasəhifə Bizimlə həmən başla şəkil</label>
                      <input type="file" name="gsP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>501x306px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('gsP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Bütün turlar bölümünün şəkli</label>
                      <input type="file" name="tursP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1400x470px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('tursP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Bütün otellər bölümünün şəkli</label>
                      <input type="file" name="otelsP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1400x470px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('otelsP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Bütün transferlər bölümünün şəkli</label>
                      <input type="file" name="transfersP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1400x470px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('transfersP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Bütün restoranlar bölümünün şəkli</label>
                      <input type="file" name="restoransP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1400x470px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('restoransP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Bizimlə əlaqə bölümünün şəkli</label>
                      <input type="file" name="contactP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1400x470px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('contactP') }}
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Bizim haqqımızda bölümünün şəkli</label>
                      <input type="file" name="aboutP" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      <small id="fileHelp" class="form-text text-muted">Şəkil ölçüsünün <b>1400x470px</b> olması məsləhət görülür</small>
                    </div>
                    {{ $errors->first('aboutP') }}
                  </div>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-12 col-12">
            <div class="form-group">
              <div class="text-center">
                <button type="submit" class="btn gredient-btn disabled">Ayarları Yenilə</button>
              </div>
            </div>
          </div>

        </div>
      </form>
    </div>

  </div>

@endsection