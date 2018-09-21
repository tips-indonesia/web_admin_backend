@extends('admin.app')

@section('title')
    Print Picked Up Shipment Manifest
@endsection
@section('page_title')
    <span class="text-semibold">Print Picked Up Shipment Manifest</span> - Show
@endsection
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="form-group">
            <label> Date : </label>
            <input type="text" class="form-control pickadate-year" value={{$date}} disabled readonly>
        </div>

        <div class="form-group">
            <label> Wroker name : </label>
            <input type="text" class="form-control" value={{$worker_name}} disabled readonly>
        </div>

         <div class="form-group">
            <label> Total Shipment : </label>
            <input type="text" class="form-control" value={{count($shipments)}} disabled readonly>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th> Shipment ID </th>
                    <th> Shipper First Name </th>
                    <th> Shipper Last Name </th>
                    <th> Origin </th>
                    <th> Destination </th>
                    <th> Shipment Content </th>
                    <th> Real Weight (Kg) </th>
                </tr>
            </thead>
            <tbody>
            @foreach($shipments as $shipment)
                <tr>
                    <td> {{ $shipment->shipment_id}} </td>
                    <td> {{ $shipment->shipper_first_name}} </td>
                    <td> {{ $shipment->shipper_last_name}} </td>
                    <td> {{ $shipment->origin}} </td>
                    <td> {{ $shipment->destination}} </td>
                    <td> {{ $shipment->shipment_contents}} </td>
                    <td> {{ $shipment->real_weight}} </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button style="float: right" class="btn btn-primary"> Print </button>
    </div>
</div>

<script type="text/javascript">
    $('.select-search').select2();
    $('.pickadate-year').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('#param').on('select2:select', function() {
        if ($('#param').val() != 'blank') {
            if (($('#param').val() == 'received') || ($('#param').val() == 'not_received')) {
                $('#value').prop('disabled', true);    
            } else {
                $('#value').prop('disabled', false);
                $('#value').prop('required', true)
            }
        } else {
            $('#value').prop('required', false)
        }
    });
    $(document).ready(function() {
        @if(session('received') !== null)
            window.alert("{{session('received')}}")      
        @endif
    })
</script>
@endsection