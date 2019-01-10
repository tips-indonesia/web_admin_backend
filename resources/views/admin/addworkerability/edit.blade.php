@extends('admin.app')

@section('title')
    Add Worker Ability to User
@endsection
@section('page_title')
    <span class="text-semibold">Member List Status Maintenance</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
        @if ($errors->any())
            @foreach($errors as $error)
                {{ $error }}
            @endforeach
        @endif
            {{ Form::open(array('url' => route('addworkerability.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>First Name :</label>
                            {{ Form::text('fname', $datas->first_name, array('class' => 'form-control', 'placeholder' => 'First Name', 'disabled' => true)) }}
                        </div>
                        <div class="form-group">
                            <label>Last Name :</label>
                            {{ Form::text('lname', $datas->last_name, array('class' => 'form-control', 'placeholder' => 'Last Name', 'disabled' => true)) }}
                        </div>
                        <div class="form-group">
                            <label>Phone Number :</label>
                            <div class="row">
                                
                                    <input type="text" name="mobile_phone_no" class="form-control" value="{{$datas->mobile_phone_no}}" disabled>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" name="email" class="form-control" value="{{$datas->email}}" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label>Worker :</label> <br/>
                            <input type="radio" name="is_worker" value="0" @if($datas->is_worker == 0) checked @endif/> Tidak &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="is_worker" value="1" @if($datas->is_worker == 1) checked @endif/> Ya
                        </div>

                        <div class="form-group">
                            <label>Status Member : </label>
                            <select name="status_member" class="form-control">
                                <option value="1" @if($datas->status_member == 1) selected @endif>Aktif</option>
                                <option value="0" @if($datas->status_member == 0) selected @endif>Tidak Aktif</option>
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
            $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd',
        });
        </script>
@endsection