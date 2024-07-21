@extends('dashboard/layout')

@section('content')

    <h2>
        Create New Member
    </h2>
    <br><br>
    <h3>
        <form id="CreateForm" action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Name:</strong>
                        <input type="text" name="userName" class="form-control" placeholder="UserName">
                    </div>
                    @error('userName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Full Name:</strong>
                        <input type="text" class="form-control" name="fullName" placeholder="Full Name">
                    </div>
                    @error('fullName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                    @error('password')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Role:</strong>
                        <input type="text" class="form-control" name="role" placeholder="Role">
                    </div>
                    @error('role')
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
