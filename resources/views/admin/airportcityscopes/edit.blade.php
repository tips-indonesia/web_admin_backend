@extends('admin.app')

@section('title')
    Edit City Scope List
@endsection
@section('page_title')
<span class="text-semibold">City Scope List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('airportcityscopes.update', [$datas->id_airport, $datas->id]), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                    <div class="form-group">
                        <label>City :</label>
                        <select name="city" class="select-search">
                            <option disabled selected></option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" @if ($datas->id_city == $city->id) selected @endif>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label>Status :</label>
                            <select class="bootstrap-select" data-width="100%" name="status" title="Choose one of the following" >
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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