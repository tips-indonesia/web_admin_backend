@extends('admin.app')

@section('title')
    Delivery Shipment
@endsection
@section('page_title')
    <span class="text-semibold">Delivery Shipment</span> - Show All
@endsection

@section('content')
        <div class="panel panel-flat">
    	{{ Form::open(array('url' => route('deliveryshipment.index'), 'method' => 'GET', 'id' => 'date_form')) }}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="packaging_id" @if($param =='packaging_id') selected @endif>Packaging ID</option>
                                <option value="slot_id" @if($param =='slot_id') selected @endif>Slot ID</option>
                                <option value="origin_city" @if($param =='origin_city') selected @endif>Origin City</option>
                                <option value="destination_city" @if($param =='destination_city') selected @endif>Destination City</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&#8192;</label>
                            <input type="text" name="value" id="value" class="form-control " placeholder="Search" value={{$value }}>                       
                        </div>
                    </div>
                </div>
                <div class=" form-group">
                    <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
            {{ Form::close() }}
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Packaging ID</th>
                    <th>Slot ID</th>
                    <th>Origin City</th>
                    <th>Destination City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                	<td>
                		<a href="{{ route('deliveryshipment.show', $package->id) }}">
                			{{$package->packaging_id}}
                		</td>
                	<td>{{$package->slot_id}}</td>
                    <td>{{$package->origin_city}}</td>
                    <td>{{$package->destination_city}}</td>
                    <td>
                        <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'PUT', 'url' => route('deliveryshipment.update', $package->id))) }}
                            <div class="text-right form-group">
                                <button type="submit"  class="btn btn-primary" style="vertical-align: middle;" {{ $package->is_open == 0 ? '':'disabled' }}><i class="icon-folder-open"
                            ></i> Open</button>
                            </div>
                            {{ Form::close() }}
                            </li>
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
    </script>
@endsection
