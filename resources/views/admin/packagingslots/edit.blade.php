@extends('admin.app')

@section('title')
    Edit Packaging Slot
@endsection
@section('page_title')
<span class="text-semibold">Packaging Slot</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('method'=> 'PUT','url' => route('packagingslots.update', $data->id))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
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
                        
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}

            <table id="shipment" class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>Shipment ID</th>
                        <th>Weight</th>
                    </tr>
                </thead>
            </table>
        </div>
        <script>
        $('.select-search').select2();
        $('#slot').on('select2:select', function() {
            $.ajax({
                url: '{{ route("shipments.index") }}/'+$('#slot').val(),
                data: {'ajax': 1},
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                }
            });
        });
        </script>
    </div>
@endsection