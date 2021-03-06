@extends('admin.app')

@section('title')
    Edit User List
@endsection
@section('page_title')
    <span class="text-semibold">User List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('users.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>First Name :</label>
                            {{ Form::text('fname', $datas->first_name, array('class' => 'form-control', 'placeholder' => 'First Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Last Name :</label>
                            {{ Form::text('lname', $datas->last_name, array('class' => 'form-control', 'placeholder' => 'Last Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            {{ Form::text('username', $datas->username, array('class' => 'form-control', 'placeholder' => 'Username', 'disabled' => 'disabled')) }}
                        </div>
                        <div class="form-group">
                            <label>Role :</label>
                            <select name="role" class="select-search">
                                <option selected disabled></option> 
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($datas->hasRole($role)) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>New Password :</label>
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'disabled' => 'disabled')) }}
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