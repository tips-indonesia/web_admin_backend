@extends('admin.app')

@section('title')
    Slot List
@endsection
@section('page_title')
<span class="text-semibold">Slot List</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        {{ Form::open(array('url' => route('slotlists.index'), 'method' => 'GET', 'id' => 'date_form')) }}
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
                                <option value="name" @if($param =='name') selected @endif>Tipster Name</option>
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
            
        {{$datas}}
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Slot ID</th>
                    <th>TIPSTER Name</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Depart Date</th>
                    <th>Depart Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                @if($data->is_included)
                    <tr>
                        <td>
                            <a href="{{ route('slotlists.show', $data->id) }}">
                            {{ $data->slot_id }}
                            </a>
                        </td>
                        <td>
                            {{ $data->first_name.' '.$data->last_name }}
                        </td>
                        <td>
                            {{ $data->origin_airport }}
                        </td>
                        <td>
                            {{ $data->destination_airport }}
                        </td>
                        <td>
                            {{ explode(' ', $data->depature)[0] }}
                        </td>
                        <td>
                            {{ explode(' ', $data->depature)[1] }}
                        </td>
                        <td>
                            {{ $data->status }}
                        </td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
{{ $datas->links() }}
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
</div>

@endsection