@extends('admin.app')

@section('title')
    Dangerous Goods Add Info
@endsection
@section('page_title')
    <span class="text-semibold">Dangerous Goods Add Info</span> - Edit
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
        {{ Form::open(array('url' => route('dangerousgoodsinfo.update', $info->id), 'method' => 'PUT')) }}
            <div class="form-group">
                <label> Bahasa Indonesia: </label>
                <textarea class="form-control" name="description"> {{ $info->description }} </textarea>
            </div>
            <div class="form-group">
                <label> English: </label>
                <textarea class="form-control" name="description_en"> {{ $info->description_en }} </textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        {{ Form::close() }}
        </div>
    </div>
@endsection