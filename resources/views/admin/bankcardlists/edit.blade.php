@extends('admin.app')

@section('title')
    Edit Bank Card List
@endsection
@section('page_title')
<span class="text-semibold">Bank Card List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('bankcardlists.update', [$datas->id_bank, $datas->id]), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'Bank Card Name')) }}
                        </div>
                        <div class="form-group">
                            <label>Status :</label>
                            <select class="bootstrap-select" data-width="100%" name="status" title="Choose one of the following" >
                                <option value="1" @if($datas->status == 1) selected @endif>Active</option>
                                <option value="0" @if($datas->status == 0) selected @endif>Inactive</option>
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
@endsection