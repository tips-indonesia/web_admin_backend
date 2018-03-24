@extends('admin.app')

@section('title')
    Shipment Tracking
@endsection
@section('page_title')
    <span class="text-semibold">Shipment Tracking</span> - Search
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('shipmenttrackings.index'), 'method' => 'GET')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Shipment ID :</label>
                            {{ Form::text('shipment_id', null, array('class' => 'form-control', 'placeholder' => 'Shipment ID')) }}
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection