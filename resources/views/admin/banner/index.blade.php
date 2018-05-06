@extends('admin.app')

@section('title')
    Banner
@endsection
@section('page_title')
<span class="text-semibold">Home Banner</span>

@endsection
@section('content')
	<div class="row">
        <div class="col-md-12">
                @if ($banner != null)
                {{ Form::open(array('method'=> 'PUT','enctype'=>'multipart/form-data','url' => route('banner.update', $banner->id))) }}
                @else
                {{ Form::open(array('method'=> 'POST','enctype'=>'multipart/form-data','url' => route('banner.store'))) }}
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>File Image :</label>
                                    <input type="file" class="form-control" name="image" id="input_file" required="">
                                    @if ($banner != null)
                                        <div class="col-md-6">
                                            <img src="{{ URL::to('/') }}/storage/banner/{{$banner->file_name}}" style="width: 300px; height: 160px; margin-top: 10px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{csrf_field()}}
                        <div class="text-right form-group">
                            <button type="submit" name="submit" value="save" class="btn btn-primary">Save<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
        </div>      
    </div>
   
@endsection