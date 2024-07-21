@extends('dashboard/layout')

@section('content')


<div class="row">
    <h4 class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Category Name: </strong>
            {{ $category->categoryName }}
        </div>
        <div class="form-group">
            <strong>Category Description: </strong>
            {{ $category->categoryDescription }}
        </div>

        <div class="form-group">
            <strong>status: </strong>
            @if ($category->isActive == 0)
                {{"Not Active"}}
            @else
                {{"Active"}}
            @endif
        </div>



    </h4>

</div>


@endsection
