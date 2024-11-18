@extends('layouts.app') 
@section('content')  
<div class="container"> 
<h1>{{ __('Produk') }}</h1> 
<div class="row"> 
<div class="col-md-12"> 
<a class="btn btn-large btn-primary" 
href="{{ route('produk.create') }}">Tambah Produk</a> 
</div> 
</div> 
<table class="table table-striped"> 
<thead> 
<tr> 
<th>&nbsp;</th><th>Nama</th><th>Rasa</th> 
<th>Ukuran</th><th>Berat</th><th>Harga</th> 
</tr> 
</thead> 
<tbody> 
@forelse ($produks as $produk) 
<tr> 
<td class="d-flex"> 
<a href="{{ route('produk.edit', $produk->id) }}"  
class="btn btn-primary">Edit 
</a> 
&nbsp; 
<form action="{{ route('produk.destroy', $produk->id) }}" 
method="POST"> 
@csrf 
@method('delete')
<button type="submit" class="btn btn-danger" 
onclick="return confirm('Are you sure?')"> 
Delete 
</button> 
</form> 
</td> 
<td>{{ $produk->nama_produk }}</td> 
<td>{{ $produk->rasa }}</td> 
<td>{{ $produk->ukuran }}</td> 
<td>{{ $produk->berat }}</td> 
<td>{{ $produk->harga }}</td> 
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
@if($produks) 
{{ $produks->links() }}  
@endif 
</div> 
@endsection 