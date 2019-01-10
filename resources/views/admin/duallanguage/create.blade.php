@extends('admin.app')

@section('title')
    Create Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">App Label Dual Language</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('duallanguage.store'))) }}
                <div class="panel panel-flat">
                    <input type="hidden" name="pilihan_bahasa" value={{$bahasa}} />
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Pilihan Bahasa :</label>
                            <select class="form-control" disabled readonly>
                                <option value="EN" @if($bahasa == 'EN') selected @endif>English</option>
                                <option value="ID" @if($bahasa == 'ID') selected @endif>Bahasa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Key :</label>
                            {{ Form::text('key', null, array('class' => 'form-control', 'placeholder' => 'Key')) }}
                        </div>
                        <div class="form-group">
                            <label>Value :</label>
                            {{ Form::text('value', null, array('class' => 'form-control', 'placeholder' => 'Value')) }}
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