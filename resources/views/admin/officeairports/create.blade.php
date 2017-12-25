@extends('admin.app')

@section('title')
    Create Office Aiport
@endsection
@section('page_title')
<span class="text-semibold">Office Aiport</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('officeairports.store', $office->id))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Aiport Office Name :</label>
                            <select name="airport" class="select-search" >
                                <option disabled selected></option>
                                @foreach ($airport as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
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
        <script>
        $('.select-search').select2();
        </script>
    </div>
@endsection