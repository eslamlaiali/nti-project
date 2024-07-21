@extends('dashboard/layout')

@section('content')

    <h2>
        Edit Category
    </h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('category.index') }}"> Back</a>
    </div>


    <h3>
        <form id="CreateForm" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Name:</strong>
                        <input type="text" name="categoryName" class="form-control" placeholder="CategoryName" value="{{ $category->categoryName }}">
                    </div>
                    @error('categoryName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Description:</strong>
                        <input type="text" class="form-control" name="categoryDescription" placeholder="Category Description" value="{{ $category->categoryDescription}}">
                    </div>
                    @error('categoryDescription')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-check form-switch">
                        @php
                            if($category->isActive == 1) {
                                $status = "checked";
                            }
                            else {
                                $status = "";
                            }
                        @endphp
                        <input type="checkbox" class="form-check-input" name="isActive" {{$category->isActive == 1 ? "checked" : ""}}>

                        <label class="form-check-label" for="isActive">
                            is Active Product
                        </label>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </h3>

@endsection
