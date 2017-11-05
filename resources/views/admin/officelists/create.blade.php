@extends('admin.app')

@section('title')
    Create Office List
@endsection
@section('page_title')
    <span class="text-semibold">Office List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('officelists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Name :</label>
                                {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Office Type Name')) }}
                            </div>
                            <div class="form-group">
                                <label>Office Type :</label>
                                <select name="office_type" class="select-search">
                                    <option disabled selected></option>
                                    @foreach ($officetypes as $officetype)
                                        <option value="{{ $officetype->id }}">{{ $officetype->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address :</label>
                                <textarea rows="5" class="form-control" placeholder="Enter your address here" name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Country :</label>
                                <select name="country" class="select-search" id="country">
                                    <option disabled selected></option>
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
                            <div class="form-group">
                                <label>City :</label>
                                <select name="city" class="select-search" id="city">
                                    <option disabled selected></option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Latitude :</label>
                                        {{ Form::text('latitude', null, array('class' => 'form-control', 'placeholder' => 'Latitude')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Longitude :</label>
                                        {{ Form::text('longitude', null, array('class' => 'form-control', 'placeholder' => 'Longitude')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number :</label>
                                        {{ Form::text('phone_no', null, array('class' => 'form-control', 'placeholder' => 'Phone Number')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fax Number :</label>
                                        {{ Form::text('fax_no', null, array('class' => 'form-control', 'placeholder' => 'Fax Number')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail :</label>
                                        {{ Form::email('email_address', null, array('class' => 'form-control', 'placeholder' => 'E-mail address')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Person :</label>
                                        {{ Form::text('contact_person', null, array('class' => 'form-control', 'placeholder' => 'Contact person Name')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Airport :</label>
                                <select name="airport" class="select-search" id="airport">
                                    <option disabled selected></option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right form-group">
                                <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
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
        $('#province').on("select2:select", function(e) { 
            $('#city').empty();
            var option = new Option();
            option.disabled = true;
            option.selected = true;
            $('#city').append(option);
            var province = $('#province');
            @foreach ($cities as $city)
                if (province.val() == {{ $city->id_province }}) 
                    $('#city').append(new Option('{{ $city->name }}', {{ $city->id }} ));
            @endforeach
        });
    </script>
@endsection