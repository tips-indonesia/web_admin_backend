@extends('admin.app')

@section('title')
    Delivery to Processing Center
@endsection
@section('page_title')
    <span class="text-semibold">Delivery to Processing Center</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('deliveries.create') }}@if ($date != null)?date={{$date}}' @endif">Create</button>
@endsection
@section('content')
    <div class="panel panel-flat">     
        {{ Form::open(array('url' => route('deliveries.index'), 'method' => 'GET', 'id' => 'date_form')) }}
                    <div class="panel-body">
                <div class="form-group">
                    <label>Date :</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                        <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="delivery_id" @if($param =='delivery_id') selected @endif>Delivery ID</option>
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
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Delivery ID</th>
                    <th>Total Shipment</th>
                    <th>Delivery Time</th>
                    <th>Submit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            <a href="{{ route('deliveries.edit', $data->id) }}">
                            {{ $data->delivery_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->total }}
                        </td>
                        <td>
                            {{ $data->delivery_time }}
                        </td>
                        <td>
                            {{ $data->is_posted == 1 ? 'Submited' : 'Not Submited' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->links() }}
    </div>
    <script type="text/javascript">
        $('.select-search').select2();
        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>

@endsection