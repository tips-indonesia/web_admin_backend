@extends('admin.app')

@section('title')
    Insurance
@endsection
@section('page_title')
    <span class="text-semibold">Insurance</span>
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('insurances.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Default Insurance (% / M <sup>3</sup>) :</label>
                            {{ Form::number('default_insurance', $datas->default_insurance, array('class' => 'form-control', 'placeholder' => 'Goods Category Name', 'step' => 'any')) }}
                        </div>
                        <div class="form-group">
                            <label>Additional Insurance (/ M <sup>3</sup>) :</label>
                            {{ Form::number('additional_insurance', $datas->additional_insurance, array('class' => 'form-control', 'placeholder' => 'Goods Category Name')) }}
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
@endsection
