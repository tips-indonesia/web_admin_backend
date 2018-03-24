@extends('admin.app')

@section('title')
    Delivery Packaging to Arrival Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Delivery Packaging to Arrival Processing Center</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('url' => route('deliveryprocessingcenters.store'), 'method' => 'POST')) }}
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label>Delivery ID :</label>
                                    <input type="text" class="form-control" value="" disabled readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                    <label>Delivery Time :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="delivery_time" class="form-control pickatime" placeholder="Received date" value="">
                                    </div>
                                </div>
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipments[]">
                               @foreach ($datas as $data)
                                    <option value="{{ $data->packagingList->id }}"> {{ $data->packagingList->packaging_id }} &nbsp; - &nbsp; {{date("d-m-Y",strtotime($data->created_at))}} &nbsp; - &nbsp; {{ $data->airportOrigin->name }} &nbsp; - &nbsp; {{ $data->airportDestination->name }} </option>
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
    });$('.pickatime').timepicker({
            template : 'dropdown',
            showInputs: false,
            showSeconds: false,
            
            showMeridian: false
          });
        
        </script>
    </div>
@endsection
