@extends('admin.app')

@section('title')
    Edit Delivery Package to Departure Counter
@endsection
@section('page_title')
    <span class="text-semibold">Delivery Package to Departure Counter</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('url' => route('deliverydeparturecounters.create'), 'method' => 'GET', 'id' => 'date_form')) }}
                <div class="col-md-12">
                <div class="form-group">
                    <label>Delivery ID :</label>
                    <input type="text" class="form-control" value="{{ $data->delivery_id }}" disabled readonly>
                    
                </div>
                    </div>
            {{ Form::close() }}
            
            {{ Form::open(array('url' => route('deliverydeparturecounters.update', $data->id), 'method' => 'PUT')) }}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Transaction Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $data->delivery_date }}" disabled>
                    </div>
                    </div>
                </div>
                            <div class="form-group">
                                    <label>Delivery Time :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" name="delivery_time" class="form-control pickatime" placeholder="Received date" value="{{$data->delivery_time}}">
                                    </div>
                                </div>
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="packagings[]">
                               @foreach ($packaging as $dat)
                                    <option value="{{ $dat->id }}" @if (in_array($dat->id, $chosen_packaging)) selected @endif> {{ $dat->packaging_id }} &nbsp; - &nbsp; {{ $dat->created_at }} &nbsp; - &nbsp; {{ $dat->origin_name }} &nbsp; - &nbsp; {{ $dat->destination_name }} </option>
                                @endforeach
                            </select>
                        </div>
                            <div class="text-right form-group">

                                <button type="submit" value="save" class="btn btn-primary" name="submit" {{$data->is_posted ? "DISABLED" : "" }}>Save <i class="icon-arrow-right14 position-right"></i></button>
                                <button type="submit" value="post"  class="btn btn-success" name="submit" {{$data->is_posted ? "DISABLED" : "" }}>Submit <i class="icon-arrow-right14 position-right"></i></button>
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