@extends('admin.app')

@section('title')
    Create City Scope List
@endsection
@section('page_title')
<span class="text-semibold">City Scope List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('airportcityscopes.store', $airport->id))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
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
        <script>
            $('.select-search').select2();
        </script>
    </div>
@endsection