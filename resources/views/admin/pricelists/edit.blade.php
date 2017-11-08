@extends('admin.app')

@section('title')
    Edit Price List
@endsection
@section('page_title')
<span class="text-semibold">Price List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('pricelists.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Origin City Name:</label>
                            <select name="origin" class="select-search">
                                <option disabled selected></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Destination City Name :</label>
                            <select name="destination" class="select-search">
                                <option disabled selected></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tipster Price (Per Kg) :</label>
                            {{ Form::text('tipster_price', $datas->tipster_price, array('class' => 'form-control', 'placeholder' => 'Office Type Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Freight Cost (Per Kg) :</label>
                            {{ Form::text('freight_cost', $datas->freight_cost, array('class' => 'form-control', 'placeholder' => 'Office Type Name')) }}
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <script>
            $('.select-search').select2();
        </script>
    </div>
@endsection