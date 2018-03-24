@extends('admin.app')

@section('title')
    Tipster Payments
@endsection
@section('page_title')
    <span class="text-semibold">Tipster Payment</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">     
        {{ Form::open(array('url' => route('tipsterpayments.index'), 'method' => 'GET', 'id' => 'date_form')) }}
                    <div class="panel-body">
                <div class="row">
                    <div class="form-group">
                        <label>Date :</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                            <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Transaction date" value="{{ $date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="display-block text-semibold">Status Terima :</label>
                        <label class="radio-inline">
                            <input type="radio" name="radio" @if($checked != 0 && $checked != 1) checked="checked" @endif value="-1">
                            Semua
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="radio" @if($checked == 0) checked="checked" @endif value="0">
                            Belum Bayar
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="radio" @if($checked == 1) checked="checked" @endif value="1">
                            Sudah Bayar
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="select-search">
                                <option value="blank" @if($param =='blank' || $param=='') selected @endif>&#8192;</option>
                                <option value="slot_id" @if($param =='slot_id') selected @endif>Slot ID</option>
                                <option value="origin_city" @if($param =='origin_city') selected @endif>Origin City</option>
                                <option value="destination_city" @if($param =='destination_city') selected @endif>Destination City</option>
                                <option value="name" @if($param =='name') selected @endif>Tipster Name</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&#8192;</label>
                            <input type="text" name="value" id="value" class="form-control " placeholder="Search" value={{$value}}>                       
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
                    <th>Slot ID</th>
                    <th>Tipster Name</th>
                    <th>Origin City</th>
                    <th>Destination City</th>
                    <th>Tipster Fee</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                @if($package->is_included)
                @if($package->status_bayar == $checked || $checked == -1)
                    <tr>
                        <td>
                            {{ $package->slot_id }}
                            
                        </td>
                        <td>
                            {{ $package->first_name }} {{ $package->last_name }}
                        </td>
                        <td>
                            {{ $package->origin_city }}
                        </td>
                        <td>
                            {{ $package->destination_city }}
                        </td>
                        <td>
                            Rp {{ $package->sold_baggage_space * $package->slot_price_kg }},-
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'PUT', 'url' => route('tipsterpayments.update', $package->id))) }}
                            <div class="text-right form-group">
                                <button type="submit"  class="btn btn-primary" style="vertical-align: middle;" {{ $package->status_bayar == 0 ? '':'disabled' }}>Sudah Bayar</button>
                            </div>
                            {{ Form::close() }}
                            </li>
                        </ul>
                        </td>
                    </tr>
                @endif
                @endif
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- Small modal -->
    
    <script type="text/javascript">
        $('.select-search').select2();
        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
        $('#param').on('select2:select', function() {
            if ($('#param').val() != 'blank') {
                $('#value').prop('required', true)
            } else {
                $('#value').prop('required', false)
            }
        });
    </script>

@endsection