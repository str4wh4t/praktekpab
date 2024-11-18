@extends('layouts.app') 
@section('content')  
<div class="container"> 
    <h1>{{ __('Province') }}</h1> 
    <div class="row"> 
        <div class="col-md-12 text-end"> 
            <form method="post" action="{{ route('province.sync-province') }}"  
                style="display:inline"> 
                @csrf 
                <button class="btn btn-primary">Sync Provice</button> 
            </form> 
        </div> 
    </div> 
    <table class="table table-striped"> 
        <thead> 
            <tr> 
                <th>&nbsp;</th>
                <th>ProvinceId</th>
                <th>Province</th>
            </tr> 
        </thead> 
        <tbody> 
        @forelse ($provinces as $province) 
            <tr> 
                <td class="d-flex">  
                    &nbsp; 
                </td> 
                <td>{{ $province->province_id }}</td>
                <td>{{ $province->province }}</td> 
                </tr> 
                    @empty 
                <tr> 
                    <td colspan="3"> 
                    <div class="alert alert-warning"> Tidak ada data!</div> 
                    </td> 
                    </tr> 
                    @endforelse 
                    </tbody> 
                    </table> 
                    @if($provinces) 
                    {{ $provinces->links() }}  
                    @endif 
                    </div> 
                    @endsection