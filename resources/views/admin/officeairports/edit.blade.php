@extends('admin.app')

@section('title')
    Edit Office Airport
@endsection
@section('page_title')
<span class="text-semibold">Office Airport</span> - Edit
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('officeairports.update', [$datas->id_office,$datas->id]), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Airport Office Name :</label>
                            <select name="airport" class="select-search" >
                                <option disabled selected></option>
                                @foreach ($airport as $office)
                                    <option value="{{ $office->id }}" @if ($datas->id_airport == $office->id) selected @endif>{{ $office->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                                <label>Status :</label>
                                <select class="bootstrap-select" data-width="100%" name="status">
                                    <option value="1" @if ($datas->status == 1) selected @endif>Active</option>
                                    <option value="0" @if ($datas->status == 0) selected @endif>Inactive</option>
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