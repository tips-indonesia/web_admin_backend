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
            {{ Form::open(array('url' => route('users.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'Country Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Role :</label>
                            <select name="role" class="select-search">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($datas->hasRole($role)) selected @endif>{{ $role->name }}</option>
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
@endsection