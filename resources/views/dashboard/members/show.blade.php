@extends('dashboard/layout')

@section('content')


<div class="row">
    <h4 class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>User Name: </strong>
            {{ $member->userName }}
        </div>
        <div class="form-group">
            <strong>Full Name: </strong>
            {{ $member->fullName }}
        </div>
        <div class="form-group">
            <strong>Role: </strong>
            {{ $member->role }}
        </div>

        <div class="form-group">
            <strong>status: </strong>
            @if ($member->isActive == 0)
                {{"Not Active"}}
            @else
                {{"Active"}}
            @endif
        </div>



    </h4>

</div>


@endsection
