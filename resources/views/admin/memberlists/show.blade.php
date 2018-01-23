@extends('admin.app')

@section('title')
    Show Member List
@endsection
@section('page_title')
<span class="text-semibold">Member List</span> - Show
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>First Name :</label>
                            {{ Form::text('name', $member->first_name, array('class' => 'form-control', 'placeholder' => 'Member Name' ,'disabled' => '' ,'readonly' => '')) }}
                        </div>
                        <div class="form-group">
                            <label>Last Name :</label>
                            {{ Form::text('name', $member->last_name, array('class' => 'form-control', 'placeholder' => 'Member Name' ,'disabled' => '' ,'readonly' => '')) }}
                        </div>
                        <div class="form-group">
                            <label>Birth Date :</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                <input type="text" name="birth_date" value="{{ $member->birth_date }}" class="form-control pickadate-year" placeholder="Birth date" disabled readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address :</label>
                            <textarea rows="5" class="form-control" placeholder="Enter your address here" name="address" readonly disabled>{{ $member->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>City :</label>
                            <select name="city" class="select-search" readonly disabled>
                                <option disabled selected></option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if ($member->id_city == $city->id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phone Number :</label>
                            {{ Form::text('phone_no', $member->mobile_phone_no, array('class' => 'form-control', 'placeholder' => 'Phone Number' ,'disabled' => '' ,'readonly' => '')) }}
                        </div>
                        <div class="form-group">
                            <label>E-mail :</label>
                            {{ Form::email('email_address', $member->email, array('class' => 'form-control', 'placeholder' => 'E-mail address' ,'disabled' => '' ,'readonly' => '')) }}
                        </div>
                    </div>
                </div>
        </div>
        <script>
            $('.select-search').select2();
            $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
        </script>
    </div>
@endsection