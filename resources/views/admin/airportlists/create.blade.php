@extends('admin.app')

@section('title')
    Create Airport List
@endsection
@section('page_title')
<span class="text-semibold">Airport List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('airportlists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Airport Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Initial :</label>
                            {{ Form::text('initial_code', null, array('class' => 'form-control', 'placeholder' => 'Airport Initial')) }}
                        </div>
                        <div class="form-group">
                            <label>City :</label>
                            <select name="city" class="select-search">
                                <option disabled selected></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
        <script>
            $('.select-search').select2();
        </script>
@endsection