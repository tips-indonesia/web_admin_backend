@extends('admin.app')

@section('title')
    Create Packaging Slot
@endsection
@section('page_title')
<span class="text-semibold">Packaging Slot</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
            {{ Form::open(array('method'=> 'POST','url' => route('packagingslots.store'))) }}

                        <div class="form-group">
                            <label>Packaging Id :</label>
                            <input type="text" value= "" class="form-control" disable readonly />
                        </div>
                        <div class="form-group">
                            <label>Slot Id :</label>
                            <select id="slot" name="slot" class="select-search" >
                                <option disabled selected></option>
                                @foreach ($slot_ids as $slot)
                                    <option value="{{ $slot->id }}"  >{{ $slot->slot_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
            {{ Form::close() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="origin">Origin City : </label>
                    </div>
                    <div class="form-group">
                        <label id="destination">Destination City : </label>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label id="weight">Real Weight : </label>
                    </div>                                
                </div>
            </div>
            <div class="panel panel-flat">
                <table class="table datatable-pagination" id="shipments">
                    <thead>
                        <tr>
                            <th>Shipment ID</th>
                            <th>Date</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>                            
            </div>
        </div>
                    </div>
                </div>
        <script>
        function apicall() {
            $.ajax({
                url: '{{ route("slotlists.index") }}/' + $('#slot').val(),
                data: {'ajax': 1},
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#destination').html('Destination Airport : ' + data['destination']);
                    $('#origin').html('Origin Airport : ' + data['origin']);
                    $('#weight').html('Real Weight : ' + data['total_weight']);
                    var table = $('#shipments')
                    var body = table.find('tbody');
                    console.log(data);
                    body.html('');
                    for (var i = 0; i < data['shipments'].length; i++) {
                        body.append("<tr><td>" + data['shipments'][i]['shipment_id'] + "</td><td>" + data['shipments'][i]['transaction_date'] + "</td><td>" + data['shipments'][i]['origin'] + "</td><td>" + data['shipments'][i]['destination'] + "</td><td>" + data['shipments'][i]['real_weight'] + "</td></tr>");
                        
                    }
                }
            });
        }
        $('.select-search').select2();
        $('#slot').on('select2:select', function(){
            apicall();
        });
        if ($('#slot').val() != '' || $('#slot').val() != null) {
            apicall();
        }
        </script>
    </div>
@endsection