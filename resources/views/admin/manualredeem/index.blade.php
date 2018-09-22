@extends('admin.app')

@section('title')
    Manual Redeem
@endsection
@section('page_title')
    <span class="text-semibold">Manual Redeem</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('manualredeem.create') }}?date={{$date}}'">Create</button>
@endsection
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        {{ Form::open(array('url' => route('manualredeem.index'), 'method' => 'GET', 'id' => 'date_form')) }}
            <div class="form-group">
                <label>Date :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                    <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Date" value="{{ $date }}">
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14 position-right"></i></button>
            </div>
    {{ Form::close() }}

    <table class="table">
        <thead>
            <tr>
                <th> Member Name </th>
                <th> Total Item </th>
                <th> Total Amount </th>
            </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
            <tr>
                <td> {{ $data->first_name . ' ' . $data->last_name }} </td>
                <td> {{ $data->total_item }}</td>
                <td> {{ $data->total_amount }} </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>
</div>
<script type="text/javascript">
    $('.select-search').select2();
    $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
    $('#param').on('select2:select', function() {
        if ($('#param').val() != 'blank') {
            $('#value').prop('required', true)
        } else {
            $('#value').prop('required', false)
        }
    });
</script>
@endsection