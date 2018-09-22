@extends('admin.app')

@section('title')
    Edit Packaging Demolition
@endsection
@section('page_title')
<span class="text-semibold">Packaging Demolition</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="form-group">
                        <label>Packaging Id :</label>
                        <input type="text" value= "{{ $data->packaging_id }}" class="form-control" disable readonly />
                    </div>
                    <div class="form-group">
                        <label>Slot Id :</label>
                        <select id="slot" name="slot" class="select-search" >
                            <option disabled selected></option>
                            @foreach ($slot_ids as $slot)
                                <option value="{{ $slot->id }}" @if ($data->id_slot == $slot->id) selected @endif >{{ $slot->slot_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="origin">Origin City : {{ $origin }}</label>
                            </div>
                            <div class="form-group">
                                <label id="destination">Destination City : {{ $destination }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label id="weight">Real Weight :  {{$ret_data['total_weight'] }}</label>
                            </div>                                
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>Additional Notes is required</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel panel-flat">
                        <table class="table datatable-pagination" id="shipments">
                            <thead>
                                <tr>
                                    <th>Shipment ID</th>
                                    <th>Date</th>
                                    <th>Origin</th>
                                    <th>Destination</th>
                                    <th>Weight</th>
                                    <th>Status</th>
                                    <th> Additional Notes</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ret_data['shipments'] as $shipment)
                                <tr>
                                {{ Form::open(array('method'=> 'PUT','url' => route('packagingdemolition.update', $data->id))) }}
                                    <input type="hidden" name="shipment_id" value="{{ $shipment->shipment_id }}">
                                    <td>{{ $shipment->shipment_id }} </td>
                                    <td>{{ $shipment->transaction_date }} </td>
                                    <td>{{ $shipment->origin }} </td>
                                    <td>{{ $shipment->destination }}</td>
                                    <td>{{ $shipment->real_weight }} </td>
                                    <td>
                                        <input type="radio" name="rejection_type" value="0" 
                                            @if($shipment->rejection_type == 0 || $shipment->rejection_type == null) checked @endif> Ilegal Item <br />
                                        <input type="radio" name="rejection_type" value="1"
                                            @if($shipment->rejection_type == 1) checked @endif> Dangerous Goods 
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="additional_notes"  value="{{$shipment->add_notes}}"/>
                                    </td>
                                    <td>
                                        <button @if($shipment->id_shipment_status < 0) disabled @endif type="submit" class="btn btn-danger"> Reject </button>
                                    </td>
                                {{ Form::close() }}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <script>
        $('.select-search').select2();
    </script>
@endsection