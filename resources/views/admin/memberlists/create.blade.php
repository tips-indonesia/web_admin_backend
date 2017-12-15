@extends('admin.app')

@section('title')
    Create Member List
@endsection
@section('page_title')
<span class="text-semibold">Member List</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('memberlists.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Member Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Birth Date :</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                <input type="text" name="birth_date" class="form-control pickadate-year" placeholder="Birth date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Address :</label>
                            <textarea rows="5" class="form-control" placeholder="Enter your address here" name="address"></textarea>
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
                        <div class="form-group">
                            <label>Phone Number :</label>
                            {{ Form::text('phone_no', null, array('class' => 'form-control', 'placeholder' => 'Phone Number')) }}
                        </div>
                        <div class="form-group">
                            <label>E-mail :</label>
                            {{ Form::email('email_address', null, array('class' => 'form-control', 'placeholder' => 'E-mail address')) }}
                        </div>
                        <div class="form-group">
                            <label>Password :</label>
                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
                        </div>
                        <div class="form-group">
                            <label>Confirm Password :</label>
                            {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
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
            $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
        </script>
    </div>
@endsection