@extends('admin.app')

@section('title')
    Create Airline List
@endsection
@section('page_title')
<span class="text-semibold">Airline List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('airlineslists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Airline Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Prefix Flight Code :</label>
                            {{ Form::text('prefix_flight_code', null, array('class' => 'form-control', 'placeholder' => 'Prefix Flight Code, e.g. GA')) }}
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection