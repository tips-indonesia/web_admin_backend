@extends('admin.app')

@section('title')
    Create Airportcity List
@endsection
@section('page_title')
    <span class="text-semibold">Airportcity List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('airportcitylists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Airportcity Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Initial (max. 4 character) :</label>
                            {{ Form::text('initial', null, array('class' => 'form-control', 'placeholder' => 'Airportcity Initial Code',
                            'style' => 'text-transform: uppercase;')) }}
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