@extends('dashboard/layout')

@section('content')

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif


    <h2>
    Products that has not been confirmed
    </h2>


    <table class="table table-striped table-bordered" style="margin: 0 auto; width: 55%;">
            <tr>
                <th>Product name</th>
                <th>Operations</th>
            </tr>


        @foreach ($products as $oneProduct)
            <tr>
                <td>
                    {{ $oneProduct->productName }}
                </td>

                <td>
                    <a class="btn btn-info" href="{{ route('product.show', $oneProduct->id) }}">Show</a>

                    @if (Session::get('role') == "supervisor")
                        <form action="{{ route('product.agree', $oneProduct->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('POST')
                                <button type="submit" class="btn btn-success">Agree</button>
                        </form>
                    @endif

                </td>

            </tr>
        @endforeach
    </table>

@endsection
