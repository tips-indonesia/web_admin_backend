@extends('admin.app')

@section('title')
    Create User List
@endsection
@section('page_title')
    <span class="text-semibold">User List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
            @if ($errors->any())
        <div class="alert alert-danger no-border">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <ul>
            @foreach($errors->getMessages() as $key => $message)
            <li>{{$key}} = {{$message[0]}}</li>
            @endforeach
            </ul>
        </div>
         @endif
        <div class="col-md-12">
            {{ Form::open(array('url' => route('users.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>First Name :</label>
                            {{ Form::text('fname', null, array('class' => 'form-control', 'placeholder' => 'First Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Last Name :</label>
                            {{ Form::text('lname', null, array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
                        </div>
                        <div class="form-group">
                            <label>Role :</label>
                            <select name="role" class="select-search">
                                <option selected disabled></option> 
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
                        </div>
                        <div class="form-group">
                            <label>Confirm Password :</label>
                            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
                        </div>

                        <div class="form-group">
                            <label>Office Name :</label>
                            <select name="office" class="select-search" id="office">
                                <option disabled selected></option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
        <script>
            $('.select-search').select2();
        </script>
@endsection