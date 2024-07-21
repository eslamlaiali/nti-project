@extends('dashboard/layout')

@section('content')

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif


    <h2>
    All Members in our store
    </h2>

    <a class="btn btn-success" href="{{ route('member.create') }}">Create New Member</a>

    @if (count($members) == 0)
    <h3>no members saved yet</h3>
    @else
    <table class="table table-striped table-bordered" style="margin: 0 auto; width: 55%;">
            <tr>
                <th>member name</th>
                <th>role</th>
                <th>status</th>
                <th>Operations</th>
            </tr>


        @foreach ($members as $onemember)
            <tr>
                <td>
                    {{ $onemember->fullName }}
                </td>
                <td>
                    {{ $onemember->role }}
                </td>
                <td>
                    @if ($onemember->isActive == 0)
                        {{"Not Active"}}
                    @else
                        {{"Active"}}
                    @endif
                </td>

                <td>
                    <a class="btn btn-info" href="{{ route('member.show', $onemember->id) }}">Show</a>
                    <form action="{{ route('member.isActive', $onemember->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        @if ($onemember->isActive == 0)
                            <button type="submit" class="btn btn-secondary">Active</button>
                        @else
                            <button type="submit" class="btn btn-warning">DeActive</button>
                        @endif
                    </form>
                </td>

            </tr>
        @endforeach
    </table>

    @endif
@endsection
