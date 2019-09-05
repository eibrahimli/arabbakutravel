@extends('backend.layouts.myapp')

@section('whereiam', 'Sayt Ayarları')

@section('content')
<div class="row">

    <div class="col-md-12">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    <form action="{{ url('/admin/settings/'.$ayarlar->id) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="card">
            <div class="row">
                <!-- col-md-6 -->
                <div class="col-md-6 col-12">
                    <div class="col-md-12" style="padding: 43px 0;">                           
                        <div class="text-center">
                            <img src="{{ asset('/storage/'.$ayarlar->siteLogo)  }}" class="rounded mx-auto d-block" alt="..." width="160" height="34">
                            <span class="text-muted">Sayt logosu</span>
                        </div>
                    </div>
                    
                    <div class="col-md-12">                
                        <div class="form-group">
                            <label>Sayt Başlığı *</label>
                            <input type="text" name="siteTitle" class="form-control" value="{{ old('siteTitle') ?? $ayarlar->siteTitle }}">
                            {{ $errors->first('siteTitle') }}
                        </div>
                        
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                        <label for="exampleTextarea">Saytın Açıqlaması *</label>
                        <textarea name="siteKey" class="form-control" id="exampleTextarea" rows="3">{{ old('siteKey') ?? $ayarlar->siteKey }}</textarea>
                      </div>
                        {{ $errors->first('siteKey') }}
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="exampleTextarea">Sayt Açar Sözləri *</label>
                            <textarea name="siteDesc" class="form-control" id="exampleTextarea" rows="3">{{ old('siteDesc') ?? $ayarlar->siteDesc}}</textarea>
                        </div>
                        {{ $errors->first('siteDesc') }}
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Sayt Elektron Poçtu *</label>
                            <input name="siteMail" type="email" class="form-control" value="{{ old('siteMail') ?? $ayarlar->siteMail }}">
                        </div>
                        {{ $errors->first('siteMail') }}
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Sayt Əlaqə Nömrəsi *</label>
                            <input name="siteNum" type="text" class="form-control" value="{{ old('siteNum') ?? $ayarlar->siteNum }}">
                        </div>
                        {{ $errors->first('siteNum') }}
                    </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Sayt Logosu</label>
                                <input type="file" name="siteLogo" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Saytın logosunu burdan yükləyərək dəyişə bilərsiniz 160x34</small>
                            </div>
                            {{ $errors->first('siteLogo') }}
                        </div>
                </div>
                
                <!-- col-md-6 -->
                <div class="col-md-6 col-12 padd-top-35">                    
                    
                                   
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Adresimiz *</label>
                            <input type="text" name="siteAdress" class="form-control" value="{{ old('siteAdress') ?? $ayarlar->siteAdress }}">
                        </div>
                        {{ $errors->first('siteAdress') }}
                    </div>
                    <div class="col-md-12">
                            <div class="form-group">
                                <label>Sayt Hüquqları Qorunur Yazısı *</label>
                                <input type="text" name="siteFooterCopy" class="form-control" value="{{ old('siteFooterCopy') ?? $ayarlar->siteFooterCopy }}">
                            </div>
                            {{ $errors->first('siteFooterCopy') }}
                        </div>
                    <!-- col-md-12 -->
                    <div class="col-md-12">
                    
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Facebook *</label>
                                    <input type="text" name="siteFace" class="form-control" value="{{ old('siteFace') ?? @$ayarlar->siteSocial[0] }}">
                                </div>
                                {{ $errors->first('siteFace') }}
                            </div>
                            
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Twitter *</label>
                                    <input type="text" name="siteTwitter" class="form-control" value="{{ old('siteTwitter') ?? @$ayarlar->siteSocial[2] }}">
                                </div>
                                {{ $errors->first('siteTwitter') }}
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Instagram *</label>
                                    <input type="text" name="siteInsta" class="form-control" value="{{ old('siteInsta') ?? @$ayarlar->siteSocial[1] }}">
                                </div>
                                {{ $errors->first('siteInsta') }}
                            </div>
                            
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Google+ *</label>
                                    <input type="text" name="siteGoogle" class="form-control" value="{{ old('siteGoogle') ?? @$ayarlar->siteSocial[3] }}">
                                </div>
                                {{ $errors->first('siteGoogle') }}
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Youtube *</label>
                                    <input type="text" name="siteYoutube" class="form-control" value="{{ old('siteYoutube') ?? @$ayarlar->siteSocial[4] }}">
                                </div>
                                {{ $errors->first('siteYoutube') }}
                            </div>

                        </div>
                        
                    </div>                    
                    <!-- col-md-12 -->                    
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