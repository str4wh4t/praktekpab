@extends('layouts.app') 
@section('content') 
<div class="container"> 
<h1>{{ __('Alamat') }}</h1> 
<form method="post" action="{{ route('alamat.update', $alamat) }}" > 
@csrf 
@method('put')
<div class="row mb-3"> 
<label for="nama_alamat" class="col-3 col-form-label">User</label> 
<div class="col-9"> 
<select name="user_id">
    @foreach($users as $user)
    <option value="{{ $user->id }}" @selected(old('user_id', $alamat->user_id) == $user->id)>{{ $user->name }}</option>
    @endforeach
</select>
</div> 
</div> 
<div class="row mb-3"> 
<label for="rasa" class="col-3 col-form-label">Provinsi</label> 
<div class="col-9"> 
    <select name="province_id">
        @foreach($provinces as $province)
        <option value="{{ $province->id }}" @selected(old('province_id', $alamat->province_id) == $province->id)>{{ $province->province }}</option>
        @endforeach
    </select> 
</div> 
</div> 
<div class="row mb-3"> 
    <label for="rasa" class="col-3 col-form-label">Kota</label> 
    <div class="col-9"> 
        <select name="city_id">
            @foreach($cities as $city)
            <option value="{{ $city->id }}" @selected(old('city_id', $alamat->city_id) == $city->id)>{{ $city->city_name . ' - ' . $city->type }}</option>
            @endforeach
        </select> 
    </div> 
</div>  
<div class="row mb-3"> 
    <label for="berat" class="col-3 col-form-label">Alamat</label> 
    <div class="col-9"> 
        <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $alamat->alamat) }}</textarea> 
    </div> 
</div> 
<div class="row"> 
    <div class="col-md-12"> 
        <button type="submit" class="btn btn-large btn-primary"> 
            Simpan 
        </button> 
        <a href="{{ route('alamat.index') }}" class="btn btn-large btn-secondary"> 
            Batal 
        </a> 
    </div> 
</div> 
</form> 
</div> 
@endsection