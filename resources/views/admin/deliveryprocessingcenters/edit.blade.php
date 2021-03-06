@extends('admin.app')

@section('title')
    Delivery Packaging to Arrival Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Delivery Packaging to Arrival Processing Center</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('url' => route('deliveryprocessingcenters.create'), 'method' => 'GET', 'id' => 'date_form')) }}
                <div class="form-group">
                    <label>Transaction Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{$data->delivery_date }}" disabled>
                    </div>
                </div>
            {{ Form::close() }}
            {{ Form::open(array('url' => route('deliveryprocessingcenters.update', $data->id), 'method' => 'PUT')) }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Delivery ID :</label>
                        <input type="text" class="form-control" value="{{ $data->delivery_id }}" disabled readonly>
                    </div>
                </div>
                            <div class="form-group">
                                    <label>Delivery Time :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="delivery_time" class="form-control pickatime" placeholder="Received date" value="{{$data->delivery_time    }}">
                                    </div>
                                </div>
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipments[]">

                                @foreach ($inputed_shipment_lists as $isl)
                                @if(in_array($isl->packagingList->id, $delivery_shipments))
                                    <option value="{{$isl->packagingList->id}}" SELECTED> {{ $isl->packagingList->packaging_id }} &nbsp; - &nbsp; {{ date("Y-m-d", strtotime($isl->created_at)) }} &nbsp; - &nbsp; {{ $isl->airportOrigin->name }} &nbsp; - &nbsp; {{ $isl->airportDestination->name }} </option>
                                    }
                                @endif
                                @endforeach


                                @foreach ($shipment_lists as $sl)
                                    <option value="{{$sl->packagingList->id}}" {{ in_array($sl->packagingList->id, $delivery_shipments)? "SELECTED" : "" }}> {{ $sl->packagingList->packaging_id }} &nbsp; - &nbsp; {{ date("Y-m-d", strtotime($sl->created_at)) }} &nbsp; - &nbsp; {{ $sl->airportOrigin->name }} &nbsp; - &nbsp; {{ $sl->airportDestination->name }} </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="text-right form-group">
                            <button type="submit" value="save" class="btn btn-primary" name="submit" @if($data->is_posted == 1) disabled @endif>Save <i class="icon-arrow-right14 position-right"></i></button>
                            <button type="submit" value="post"  class="btn btn-success" name="submit" @if($data->is_posted == 1) disabled @endif>Submit <i class="icon-arrow-right14 position-right"></i></button>
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
        });$('.pickatime').timepicker({
            template : 'dropdown',
            showInputs: false,
            showSeconds: false,
            
            showMeridian: false
          });
        </script>
    </div>
@endsection