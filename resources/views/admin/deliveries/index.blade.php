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
                <div class="text-right form-group">
                    <button type="submit" class="btn btn-primary">Choose Date <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
            {{ Form::close() }}
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
        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>

@endsection