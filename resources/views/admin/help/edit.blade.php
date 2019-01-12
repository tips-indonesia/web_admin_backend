@extends('admin.app')

@section('title')
    Help
@endsection
@section('page_title')
    <span class="text-semibold">Help</span> - Edit
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="form-group">
                <input disabled type="radio" name="lang" value="id" {{ $lang == 'id' ? 'checked' : ''}}/> Bahasa Indonesia &nbsp; &nbsp; &nbsp;
                <input disabled type="radio" name="lang" value="en" {{ $lang == 'en' ? 'checked' : ''}}/> English
            </div>

        {{ Form::open(array('url' => route('help.update', $help->id), 'method' => 'PUT')) }}
            <input type="hidden" name="lang" value="{{$lang}}" />
            <div class="form-group">
                <label>Title :</label>
                <input required type="text" name="title" class="form-control" value="{{$help->title}}" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="textarea" name="description" required class="form-control">{{$help->description}}</textarea>
            </div>
            <div class="form-group" style="float:right;">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        {{ Form::close() }}
        </div>
    <div>
@endsection

@section('scripts')
<script type="text/javascript">
    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

    window.onload = () => {
        let el = document.getElementById("textarea")
        auto_grow(el)
    }
</script>
@endsection