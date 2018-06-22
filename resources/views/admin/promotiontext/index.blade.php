@extends('admin.app')

@section('title')
    Promotion Text
@endsection

@section('page_title')
    <span class="text-semibold">Promotion Text</span>
@endsection
@section('content')
	<div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
                    	{{ Form::open(array('url' => route('promotiontext.store'), 'method' => 'POST')) }}
                        <div class="form-group">
                            <input required type="text" class="form-control" placeholder="Promotion Text" name="promotion_text" value="{{$text}}">
                        </div>
                        <div class="text-right form-group">
                            <button name="submit" type="submit" value="save" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                            <button name="submit" type="submit" value="clear" class="btn btn-danger">Clear Data <i class="icon-trash position-right"></i></button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
        </div>
    </div>
@endsection