@extends('admin.app')

@section('title')
    Create Weight List
@endsection
@section('page_title')
    <span class="text-semibold">Weight List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('weightlists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Weight (Kg) :</label>
                            {{ Form::text('weight_kg', null, array('class' => 'form-control', 'placeholder' => 'Weight')) }}
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