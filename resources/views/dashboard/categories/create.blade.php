@extends('dashboard/layout')

@section('content')

    <h2>
        Create New product
    </h2>
    <br><br>
    <h3>
        <form id="CreateForm" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Name:</strong>
                        <input type="text" name="categoryName" class="form-control" placeholder="CategoryName">
                    </div>
                    @error('categoryName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Category Description:</strong>
                        <input type="text" class="form-control" name="categoryDescription" placeholder="Category Description">
                    </div>
                    @error('categoryDescription')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="isActive">
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
