@extends('admin.app')

@section('title')
    Edit Office List
@endsection
@section('page_title')
    <span class="text-semibold">Office List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('officelists.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Name :</label>
                                {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'Office Type Name')) }}
                            </div>
                            <div class="form-group">
                                <label>Office Type :</label>
                                <select name="office_type" class="select-search">
                                    <option disabled selected></option>
                                    @foreach ($officetypes as $officetype)
                                        <option value="{{ $officetype->id }}" @if ($officetype->id == $datas->id_office_type) selected @endif>{{ $officetype->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address :</label>
                                <textarea rows="5" class="form-control" placeholder="Enter your address here" name="address">{{ $datas->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>City :</label>
                                <select name="city" class="select-search">
                                    <option disabled selected></option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Latitude :</label>
                                        {{ Form::text('latitude', $datas->latitude, array('class' => 'form-control', 'placeholder' => 'Latitude')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Longitude :</label>
                                        {{ Form::text('longitude', $datas->longitude, array('class' => 'form-control', 'placeholder' => 'Longitude')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number :</label>
                                        {{ Form::text('phone_no', $datas->phone_no, array('class' => 'form-control', 'placeholder' => 'Phone Number')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fax Number :</label>
                                        {{ Form::text('fax_no', $datas->fax_no, array('class' => 'form-control', 'placeholder' => 'Fax Number')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail :</label>
                                        {{ Form::email('email_address', $datas->email_address, array('class' => 'form-control', 'placeholder' => 'E-mail address')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact Person :</label>
                                        {{ Form::text('contact_person', $datas->contact_person_name, array('class' => 'form-control', 'placeholder' => 'Contact person Name')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Airport Counter Name :</label>
                                <select name="airport_counter" class="select-search" id="airport_counter" disabled>
                                    <option disabled></option>
                                    @foreach ($acs as $office)
                                        <option value="{{ $office->id }}" @if ($datas->id_airport_counter == $office->id) selected @endif>{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Processing Center Name :</label>
                                <select name="processing_center" class="select-search" id="processing_center" disabled>
                                    <option disabled></option>
                                    @foreach ($pcs as $office)
                                        <option value="{{ $office->id }}" @if ($datas->id_processing_center == $office->id) selected @endif>{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Airport Name :</label>
                                <select name="airport" class="select-search" id="airport" disabled>
                                    <option disabled></option>
                                    @foreach ($airports as $airport)
                                        <option value="{{ $airport->id }}" @if ($datas->id_processing_center == $airport->id) selected @endif>{{ $airport->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status :</label>
                                <select class="bootstrap-select" data-width="100%" name="status">
                                    <option value="1" @if ($datas->status == 1) selected @endif>Active</option>
                                    <option value="0" @if ($datas->status == 0) selected @endif>Inactive</option>
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
        if ($('#office_type').val() == 4 || $('#office_type').val() == 5){
            $('#processing_center').removeAttr("disabled");
        } else if ($('#office_type').val() == 3) { 
            $('#airport_counter').prop('disabled', 'disabled');                
        }
        $('#office_type').on('select2:select', function() {
            if ($('#office_type').val() == 4 || $('#office_type').val() == 5){
                $('#processing_center').removeAttr("disabled");
            } else if ($('#office_type').val() == 3) { 
                $('#airport_counter').prop('disabled', 'disabled');                
            } else {
                $('#airport_counter').prop('disabled', 'disabled');
                $('#processing_center').prop('disabled', 'disabled');
            }
        })
    </script>
@endsection