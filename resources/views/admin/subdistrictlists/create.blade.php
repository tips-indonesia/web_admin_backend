@extends('admin.app')

@section('title')
    Create Subdistrict List
@endsection
@section('page_title')
    <span class="text-semibold">Subdistrict List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('subdistrictlists.store'), 'method' => 'POST')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Province :</label>
                            {{ Form::text('province_name', $province->name, array('class' => 'form-control', 'placeholder' => 'Province Name', 'disabled' =>'')) }}
                        </div>
                        <div class="form-group">
                            <label>City :</label>
                            {{ Form::text('city_name', $city->name, array('class' => 'form-control', 'placeholder' => 'City Name', 'disabled' =>'')) }}
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Subdistrict Name')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::hidden('province', $province->id) }}
                        </div>
                        <div class="form-group">
                            {{ Form::hidden('city', $city->id) }}
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