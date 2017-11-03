@extends('admin.app')

@section('title')
    Create Country List
@endsection
@section('module')
    Country List
@endsection
@section('operation')
    Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('users.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Country Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Username :</label>
                            {{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Country Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Role :</label>
                            <select name="role" class="select-search">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Country Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Country Name')) }}
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