@extends('admin.app')

@section('title')
    Edit Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">App Label Dual Language</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    </style>
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('duallanguage.update', $data->text_key), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Key :</label>
                            {{ Form::text('text_key', $data->text_key, array('disabled' => true, 'class' => 'form-control', 'placeholder' => 'Key')) }}
                        </div>
                        <div class="form-group">
                            <label>Bahasa :</label>
                            <textarea id="textarea" class="form-control" name="text_id"> {{ $data->text_id }} </textarea>
                        </div>
                        <div class="form-group">
                            <label>English :</label>
                            <textarea id="textareaen" class="form-control" name="text_en"> {{ $data->text_en }} </textarea>
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