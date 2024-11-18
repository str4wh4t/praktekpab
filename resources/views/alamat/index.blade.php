@extends('layouts.app') 
@section('content')  
<div class="container"> 
    <h1>{{ __('Alamat') }}</h1> 
    <div class="row"> 
        <div class="col-md-12"> 
        <a class="btn btn-large btn-primary" 
        href="{{ route('alamat.create') }}">Tambah Alamat</a> 
        </div> 
        </div> 
    <table class="table table-striped"> 
        <thead> 
            <tr> 
                <th>&nbsp;</th><th>User</th><th>Alamat</th><th>Kota</th> 
            </tr> 
        </thead> 
        <tbody> 
        @forelse ($alamats as $alamat) 
            <tr> 
                <td class="d-flex"> 
                    <a href="{{ route('alamat.edit', $alamat) }}"  
                        class="btn btn-primary">Edit
                    </a> 
                    &nbsp; 
                    <form action="{{ route('alamat.destroy', $alamat) }}" 
                        method="POST"> 
                        @csrf 
                        <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('Are you sure?')"> 
                            Delete 
                        </button> 
                    </form> 
                </td> 
                <td>{{ $alamat->user->name }}<br/><small> 
                    {{ $alamat->user->email }}</small></td> 
                <td>{{ $alamat->alamat }}</td>
                <td> 
                    {{ $alamat->city->type }}&nbsp;{{ $alamat->city->city_name }}<br/> 
                    {{ $alamat->city->province }}<br/> 
                    {{ $alamat->city->postal_code }}<br/> 
                    </td> 
                    </tr> 
                    @empty 
                    <tr> 
                    <td colspan="4"> 
                    <div class="alert alert-warning"> Tidak ada data!</div> 
                    </td> 
                    </tr> 
                    @endforelse 
                    </tbody> 
                    </table> 
                    @if($alamats) 
                    {{ $alamats->links() }}  
                    @endif 
                    </div> 
                    @endsection