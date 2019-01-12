@extends('admin.app')

@section('title')
    Edit Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">App Label Dual Language</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
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
                            {{ Form::text('text_id', $data->text_id, array('class' => 'form-control', 'placeholder' => 'Value')) }}
                        </div>
                        <div class="form-group">
                            <label>English :</label>
                            {{ Form::text('text_en', $data->text_en, array('class' => 'form-control', 'placeholder' => 'Value')) }}
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