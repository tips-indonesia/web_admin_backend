@extends('admin.app')

@section('title')
    Edit Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">Dual Language</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('duallanguage.update', 1), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <input type="hidden" value="{{ $data->key }}" name="key_default">
                        <input type="hidden" value="{{ $data->value }}" name="value_default">
                        <div class="form-group">
                            <label>Pilihan Bahasa :</label>
                            <select name="pilihan_bahasa" class="form-control" disabled>
                                <option value="EN" @if ($data->lang_id == 'EN') selected @endif>English</option>
                                <option value="ID" @if ($data->lang_id == 'ID') selected @endif>Bahasa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Key :</label>
                            {{ Form::text('key', $data->key, array('class' => 'form-control', 'placeholder' => 'Key')) }}
                        </div>
                        <div class="form-group">
                            <label>Value :</label>
                            {{ Form::text('value', $data->value, array('class' => 'form-control', 'placeholder' => 'Value')) }}
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