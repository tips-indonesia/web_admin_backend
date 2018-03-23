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
                                {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Office Name')) }}
                            </div>
                            <div class="form-group">
                                <label>Office Type :</label>
                                <select name="office_type" class="select-search" id="office_type">
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
                                <label>Area :</label>
                                <select name="area" class="select-search">
                                    <option disabled selected></option>
                                    @foreach($airportcitylists as $airportcitylist)
                                    <option value="{{ $airportcitylist->id }}"> {{ $airportcitylist->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Province :</label>
                                <select name="province" id="province" class="select-search">
                                    <option disabled selected></option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>City :</label>
                                <select name="city" id="city" class="select-search">
                                    <option disabled selected></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Subdistrict :</label>
                                <select name="subdistrict" id="subdistrict" class="select-search">
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
                                <label>Airport Counter Name :</label>
                                <select name="airport_counter" class="select-search" id="airport_counter" disabled>
                                    <option disabled selected></option>
                                    @foreach ($acs as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Processing Center Name :</label>
                                <select name="processing_center" class="select-search" id="processing_center" disabled>
                                    <option disabled selected></option>
                                    @foreach ($pcs as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Airport Name :</label>
                                <select name="airport" class="select-search" id="airport" disabled>
                                    <option disabled selected></option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}" >{{ $airport->name }}</option>
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
        $('#office_type').on('select2:select', function() {
            $('#airport_counter').prop('disabled', 'disabled');
            $('#processing_center').prop('disabled', 'disabled');
            $('#airport').prop('disabled', 'disabled');
            if ($('#office_type').val() == 2 || $('#office_type').val() == 3){
                $('#processing_center').removeAttr("disabled");
            } else if ($('#office_type').val() == 5) { 
                $('#airport_counter').removeAttr("disabled");
            }  else if ($('#office_type').val() == 4) { 
                $('#airport').removeAttr("disabled");
            }
        });
        $('#province').on('select2:select', function() {
                var city = $('#city');
                city.empty();
                $.ajax({
                    url: '{{ route("citylists.index") }}',
                    data: {'ajax': 1, 'province' : $('#province').val()},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var option = new Option;
                        option.disabled = true;
                        option.selected = true;
                        city.append(option);
                        for(var i = 0 ; i < data.length; i++) {
                            city.append(new Option(data[i].name, data[i].id));
                        }
                    }
                });
            });
        $('#city').on('select2:select', function() {
                var subdistrict = $('#subdistrict');
                subdistrict.empty();
                $.ajax({
                    url: '{{ route("subdistrictlists.index") }}',
                    data: {'ajax': 1, 'city' : $('#city').val()},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var option = new Option;
                        option.disabled = true;
                        option.selected = true;
                        subdistrict.append(option);
                        for(var i = 0 ; i < data.length; i++) {
                            subdistrict.append(new Option(data[i].name, data[i].id));
                        }
                    }
                });
            });
    </script>
@endsection