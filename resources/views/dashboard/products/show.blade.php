@extends('dashboard/layout')

@section('content')


<div class="row">
    <h2 class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Product Name: </strong>
            {{ $product->productName }}
        </div>
        <div class="form-group">
            <strong>Product Description: </strong>
            {{ $product->productDescription }}
        </div>
        <div class="form-group">
            <strong>Product Price: </strong>
            {{ $product->price }}
        </div>
        <div class="form-group">
            <strong>Product Category: </strong>
            {{ $category->categoryName }}
        </div>




    </h2>
    <div class="col-xs-6 col-sm-6 col-md-6">
        @php
            $photo = asset("XproductImage/" . $product->photo);
        @endphp
        <img src="{{ $photo }}" width="300" alt="">
    </div>
</div>


@endsection
