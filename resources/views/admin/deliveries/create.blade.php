@extends('admin.app')

@section('title')
    Create Shipment Delivery to Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Shipment Delivery to Processing Center</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('deliveries.create'), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipments[]">
                               
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <script type="text/javascript">
         
    $('.listbox').bootstrapDualListbox();

        </script>
    </div>
@endsection