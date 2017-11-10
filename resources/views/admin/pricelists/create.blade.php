@extends('admin.app')

@section('title')
    Create Price List
@endsection
@section('page_title')
    <span class="text-semibold">Price List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('pricelists.store'))) }}
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
                            {{ Form::text('tipster_price', null, array('class' => 'form-control', 'placeholder' => 'Tipster Price')) }}
                        </div>
                        <div class="form-group">
                            <label>Freight Cost (Per Kg) :</label>
                            {{ Form::text('freight_cost', null, array('class' => 'form-control', 'placeholder' => 'Freight Cost')) }}
                        </div>
                        <div class="form-group">
                            <label>Add First Class (Per Kg) :</label>
                            {{ Form::text('add_first_class', null, array('class' => 'form-control', 'placeholder' => 'Add First Class')) }}
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
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