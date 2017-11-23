@extends('admin.app')

@section('title')
    Show Shipment Delivery to Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Shipment Delivery to Processing Center</span> - Show
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('url' => route('deliveries.create'), 'method' => 'GET', 'id' => 'date_form')) }}
                <div class="form-group">
                    <label>Transaction Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $data->delivery_date }}" disabled readonly>
                    </div>
                </div>
                <div class="text-right form-group">
                    <button type="submit" class="btn btn-primary" disabled>Choose Date <i class="icon-arrow-right14 position-right" ></i></button>
                </div>
            {{ Form::close() }}
            {{ Form::open(array('url' => route('deliveries.update', $data->id), 'method' => 'PUT')) }}
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipments[]" disabled readonly>
                               @foreach ($shipment_lists as $datax)
                                    <option value="{{ $datax->id }}" @if (in_array($datax->id, $delivery_shipments)) selected @endif> {{ $data->delivery_date }} &nbsp; - &nbsp; {{ $datax->shipment_id }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" value="save" class="btn btn-primary" name="submit">Save <i class="icon-arrow-right14 position-right" disabled readonly></i></button>
                            <button type="submit" value="post"  class="btn btn-success" name="submit">Submit <i class="icon-arrow-right14 position-right" disabled readonly></i></button>
                        </div>
            {{ Form::close() }}
        </div>
                    </div>
                </div>
        <script type="text/javascript">
         
    $('.listbox').bootstrapDualListbox({
        nonSelectedListLabel: 'Non-selected',
        selectedListLabel: 'Selected',
    });
        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
        </script>
    </div>
@endsection