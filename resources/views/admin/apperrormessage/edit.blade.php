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
                <textarea id="textarea" class="form-control" name="text_id"> {{ $message->text_id }} </textarea>
            </div>
            <div class="form-group">
                <label> English : </label>
                <textarea id="textareaen" class="form-control" name="text_en"> {{ $message->text_en }} </textarea>
            </div>
            <div class="text-right form-group">
                <button required type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        {{ Form::close()}}
        </div>
    </div>
@endsection


@section('scripts')
<script type="text/javascript">
    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

    window.onload = () => {
        let el = document.getElementById("textarea")
        let el2 = document.getElementById("textareaen")
        auto_grow(el)
        auto_grow(el2)
    }
</script>
@endsection