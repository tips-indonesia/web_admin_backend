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
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'City Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Country :</label>
                            <select name="country" class="select-search" id="country">
                                <option disabled selected></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"  @if ($city_country_id == $country->id) selected @endif >{{ $country->name }}</option>
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
            function dynamic_province() {
                $('#province').empty();
                var option = new Option();
                option.disabled = true;
                option.selected = true;
                $('#province').append(option);
                var country = $('#country');
                @foreach ($provinces as $province)
                    if (country.val() == {{ $province->id_country }})  {                        
                        option = new Option('{{ $province->name }}', {{ $province->id }})
                        if ({{ $province->id }} == {{ $datas->id_province }})
                            option.selected = true;
                        $('#province').append(option);
                    }
                @endforeach
            }
            var select = $('.select-search').select2();
            $('#country').on("select2:select", function(e) { 
                dynamic_province();
            });
            dynamic_province();
        </script>
@endsection