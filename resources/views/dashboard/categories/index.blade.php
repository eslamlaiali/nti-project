@extends('dashboard/layout')

@section('content')
    <div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{$message}}
            </div>
        @endif
        <a href="{{route('category.create')}}" class="btn btn-success" style="margin: 15px;">Create Category</a>

        <table class="table table-striped">
            <tr>
                <th>Category Name</th>
                <th>Category description</th>
                <th>status</th>
                <th>operations</th>
            </tr>
            @foreach ($categories as $oneCategory)
                <tr>
                    <td>{{$oneCategory->categoryName}}</td>
                    <td>{{$oneCategory->categoryDescription}}</td>
                    <td>@if ($oneCategory->isActive == 1)
                        {{"Active"}}
                    @else
                        {{"Not Active"}}
                    @endif</td>
                    <td>
                        <form action="{{ route('category.destroy',$oneCategory->id) }}" method="POST" style="display: inline;">
                            <a class="btn btn-info" href="{{ route('category.show', $oneCategory->id) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('category.edit', $oneCategory->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="{{ route('category.isActive', $oneCategory->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('POST')
                            @if ($oneCategory->isActive == 0)
                                <button type="submit" class="btn btn-secondary">Active</button>
                            @else
                                <button type="submit" class="btn btn-warning">DeActive</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
