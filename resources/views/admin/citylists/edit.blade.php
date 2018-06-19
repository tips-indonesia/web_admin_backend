@extends('admin.app')

@section('title')
    Edit City List
@endsection
@section('page_title')
    <span class="text-semibold">City List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('citylists.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Province :</label>
                            <select name="province" class="select-search" disabled="">
                                <option disabled></option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" @if ($datas->id_province == $province->id) selected @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'City Name')) }}
                        </div>
                        <input type="hidden" value="{{$province->id}}" name="province">
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