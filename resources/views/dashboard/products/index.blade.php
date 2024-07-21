@extends('dashboard/layout')

@section('content')

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif


    <h2>
    All Products in our store
    </h2>

    <a class="btn btn-success" href="{{ route('product.create') }}">Create New Product</a>

    @if (count($notAgreedProducts) > 0 && Session::get('userId') != "editor")
        <a class="btn btn-danger" href="{{ route('product.isAgree') }}">There is products not confirmed</a>
    @endif

    @if (count($products) == 0)
    <h3>no Products saved yet</h3>
    @else
    <table class="table table-striped table-bordered" style="margin: 0 auto; width: 55%;">
            <tr>
                <th>Product name</th>
                <th>Price</th>
                <th>Operations</th>
            </tr>


        @foreach ($products as $oneProduct)
            <tr>
                <td>
                    {{ $oneProduct->productName }}
                </td>
                <td>
                    {{ $oneProduct->price }}
                </td>

                <td>

                    <a class="btn btn-info" href="{{ route('product.show', $oneProduct->id) }}">Show</a>

                    @if ($oneProduct->member_id == Session::get('userId'))
                        <a class="btn btn-primary" href="{{ route('product.edit', $oneProduct->id) }}">Edit</a>
                        <form action="{{ route('product.destroy',$oneProduct->id) }}" method="POST" style="display: inline;">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @csrf
                            @method('DELETE')
                        </form>
                        <form action="{{ route('product.isActive', $oneProduct->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('POST')
                            @if ($oneProduct->isActive == 0)
                                <button type="submit" class="btn btn-secondary">Active</button>
                            @else
                                <button type="submit" class="btn btn-warning">DeActive</button>
                            @endif
                        </form>
                    @endif




                </td>

            </tr>
        @endforeach
    </table>

    @endif
@endsection
