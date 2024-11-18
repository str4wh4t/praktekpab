@extends('layouts.app') 
@section('content')  
<div class="container"> 
    <h1>{{ __('Province') }}</h1> 
    <div class="row"> 
        <div class="col-md-12 text-end"> 
            <form method="post" action="{{ route('city.sync-city') }}"  
                style="display:inline"> 
                @csrf 
                <button class="btn btn-primary">Sync City</button> 
            </form> 
        </div> 
    </div> 
    <table class="table table-striped"> 
        <thead> 
            <tr> 
                <th>&nbsp;</th>
                <th>CityId</th>
                <th>Province</th>
                <th>Type</th>
                <th>CityName</th>
                <th>PostalCode</th>
            </tr> 
        </thead> 
        <tbody> 
        @forelse ($cities as $city) 
            <tr> 
                <td class="d-flex">  
                    &nbsp; 
                </td> 
                <td>{{ $city->city_id }}</td>
                <td>{{ $city->province }}</td>
                <td>{{ $city->type }}</td> 
                <td>{{ $city->city_name }}</td>
                <td>{{ $city->postal_code }}</td>
                </tr> 
                    @empty 
                <tr> 
                    <td colspan="6"> 
                    <div class="alert alert-warning"> Tidak ada data!</div> 
                    </td> 
                    </tr> 
                    @endforelse 
                    </tbody> 
                    </table> 
                    @if($cities) 
                    {{ $cities->links() }}  
                    @endif 
                    </div> 
                    @endsection