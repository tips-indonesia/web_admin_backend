@extends('admin.app')

@section('title')
    Edit Airport List
@endsection
@section('page_title')
<span class="text-semibold">Airport List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('airportlists.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'Airport Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Initial :</label>
                            {{ Form::text('initial_code', $datas->initial_code, array('class' => 'form-control', 'placeholder' => 'Airport Initial')) }}
                        </div>
                        <div class="form-group">
                            <label>International :</label>
                            <select class="bootstrap-select" data-width="100%" name="is_international" title="Choose one of the following" >
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Domestik :</label>
                            <select class="bootstrap-select" data-width="100%" name="is_domestic" title="Choose one of the following" >
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status :</label>
                            <select class="bootstrap-select" data-width="100%" name="status" title="Choose one of the following" >
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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