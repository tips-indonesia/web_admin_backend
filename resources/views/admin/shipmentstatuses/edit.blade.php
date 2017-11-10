@extends('admin.app')

@section('title')
    Edit Shipment Status
@endsection
@section('page_title')
<span class="text-semibold">Shipment Status</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('shipmentstatuses.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Description :</label>
                            {{ Form::text('step', $datas->step, array('class' => 'form-control', 'placeholder' => 'Shipment Status Step')) }}
                        </div>
                        <div class="form-group">
                            <label>Description :</label>
                            {{ Form::text('description', $datas->description, array('class' => 'form-control', 'placeholder' => 'Shipment Status Description')) }}
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