@extends('admin.app')

@section('title')
    Edit Office Type List
@endsection
@section('page_title')
    <span class="text-semibold">Office Type List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('officetypes.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'Office Type Name')) }}
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