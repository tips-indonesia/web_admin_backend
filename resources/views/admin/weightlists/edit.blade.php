@extends('admin.app')

@section('title')
    Edit Weight List
@endsection
@section('page_title')
    <span class="text-semibold">Weight List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('weightlists.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Weight :</label>
                            {{ Form::text('weight_kg', $datas->weight_kg, array('class' => 'form-control', 'placeholder' => 'Weight')) }}
                        </div>
                        <div class="form-group">
                            <label>For Shipment :</label>
                            <select class="bootstrap-select" data-width="100%" name="for_shipment">
                                <option value="1" @if ($datas->for_shipment == 1) selected @endif>Yes</option>
                                <option value="0" @if ($datas->for_shipment == 0) selected @endif>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>For Delivery :</label>
                            <select class="bootstrap-select" data-width="100%" name="for_delivery">
                                <option value="1" @if ($datas->for_delivery == 1) selected @endif>Yes</option>
                                <option value="0" @if ($datas->for_delivery == 0) selected @endif>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status :</label>
                            <select class="bootstrap-select" data-width="100%" name="status">
                                <option value="1" @if ($datas->status == 1) selected @endif>Active</option>
                                <option value="0" @if ($datas->status == 0) selected @endif>Inactive</option>
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