@extends('admin.app')

@section('title')
    Create Province List
@endsection
@section('page_title')
    <span class="text-semibold">Province List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('provincelists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Province Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Country :</label>
                            <select name="country" class="select-search">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
        <script>
            $('.select-search').select2();
        </script>
@endsection