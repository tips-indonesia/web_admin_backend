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
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('url' => route('deliveries.create'), 'method' => 'GET', 'id' => 'date_form')) }}
                <div class="form-group">
                    <label>Transaction Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                    </div>
                </div>
                <div class="text-right form-group">
                    <button type="submit" class="btn btn-primary">Choose Date <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            {{ Form::close() }}
            {{ Form::open(array('url' => route('deliveries.store'), 'method' => 'POST')) }}
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipments[]">
                               @foreach ($datas as $data)
                                    <option value="{{ $data->id }}" @if ($data->id_shipment_status != 2) selected @endif> {{ $data->transaction_date }} &nbsp; - &nbsp; {{ $data->shipment_id }} </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" value="{{ $date }}" name="date"/>
                        <div class="text-right form-group">
                            <button type="submit" value="save" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                            <button type="submit" class="btn btn-primary" disabled>Submit <i class="icon-arrow-right14 position-right" ></i></button>
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