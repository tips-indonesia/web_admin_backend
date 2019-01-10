@extends('admin.app')

@section('title')
    App Error Message Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">App Error Message Dual Language</span> - Edit
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
        {{ Form::open(array('url' => route('apperrormessage.update', $message->text_key), 'method' => 'PUT')) }}
            <div class="form-group">
                <label> App Page Name : </label>
                <input type="text" disabled class="form-control" value="{{ $page->name }}"/>
            </div>
            <div class="form-group">
                <label> Key : </label>
                <input type="text" disabled class="form-control" value="{{ $message->text_key }}"/>
            </div>
            <div class="form-group">
                <label> Bahasa : </label>
                <input type="text" name="text_id" class="form-control" value="{{ $message->text_id }}"/>
            </div>
            <div class="form-group">
                <label> English : </label>
                <input required type="text" name="text_en" class="form-control" value="{{ $message->text_en }}"/>
            </div>
            <div class="text-right form-group">
                <button required type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        {{ Form::close()}}
        </div>
    </div>
@endsection
