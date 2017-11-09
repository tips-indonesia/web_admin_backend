@extends('admin.app')

@section('title')
    Edit Office Drop Point
@endsection
@section('page_title')
<span class="text-semibold">Office Drop Point</span> - Edit
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('officedroppoints.update', [$datas->id_office,$datas->id]), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Drop Point Office Name :</label>
                            <select name="drop_point" class="select-search" >
                                <option disabled selected></option>
                                @foreach ($drop_point as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
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