@extends('admin.app')

@section('title')
    Create City List
@endsection
@section('page_title')
    <span class="text-semibold">City List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('citylists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'City Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Country :</label>
                            <select name="country" class="select-search" id="country" title="Choose one of the following" >
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Province :</label>
                            <select name="province" class="select-search" id="province">
                                <option disabled selected></option> 
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
            $('#country').on("select2:select", function(e) { 
                $('#province').empty();
                var option = new Option();
                option.disabled = true;
                option.selected = true;
                $('#province').append(option);
                var country = $('#country');
                @foreach ($provinces as $province)
                    if (country.val() == {{ $province->id_country }}) 
                        $('#province').append(new Option('{{ $province->name }}', {{ $province->id }} ));
                @endforeach
            });
        </script>
@endsection