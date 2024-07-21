@extends('dashboard/layout')


@section('content')


    <h5>
        <form id="CreateForm" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" name="productName" class="form-control" placeholder="ProductName" value="{{$product->productName}}">
                    </div>
                    @error('ProductName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Product Description:</strong>
                        <input type="text" name="productDescription" class="form-control" placeholder="ProductDescription" value="{{$product->productDescription}}">
                    </div>
                    @error('ProductDescription')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Product Price:</strong>
                        <input type="number" class="form-control" name="price" placeholder="Product Price" value="{{$product->price}}">
                    </div>
                    @error('price')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">

                    @foreach ($categories as $oneCategory)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category_id" value="{{$oneCategory->id}}" {{($oneCategory->id == $product->category_id) ? "checked" : ""}}>
                            <label class="form-check-label" >
                            {{$oneCategory->categoryName}}
                            </label>
                        </div>
                    @endforeach

                    @error('category_id')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Product Photo:</strong>
                        <input type="file" class="form-control" name="photo" placeholder="Product photo" onchange=" imageFilePreview (this);">
                    </div>
                    @error('photo')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                @php
                    $photo = asset("XproductImage/" . $product->photo);
                @endphp

                <img id="imagePreview" alt="image Preview" style="max-width:150px; max-height:150px;" src="{{$photo}}">

                <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </h5>
@endsection

<script>
    function imageFilePreview(inputFile){
        var file = inputFile.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById("imagePreview").setAttribute("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
