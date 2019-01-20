@extends('admin.app')

@section('title')
    Cron Timer
@endsection
@section('page_title')
    <span class="text-semibold">Cron Timer</span>
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            @if($datas != null) 
            {{ Form::open(array('url' => route('crontimer.update', $datas->id), 'method' => 'PUT')) }}
            @else
            {{ Form::open(array('url' => route('crontimer.store'), 'method' => 'POST')) }}
            @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Cron Timer (seconds) :</label>
                            @if ($datas != null)
                            {{ Form::number('cron_timer', $datas->cron_timer, array('class' => 'form-control', 'placeholder' => 'Cron Timer', 'required' => '')) }}
                            @else
                            {{ Form::number('cron_timer', '', array('class' => 'form-control', 'placeholder' => 'Cron Timer', 'required' => '')) }}
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Reminder Timer (seconds) :</label>
                            {{ Form::number('reminder_timer', $datas->reminder_timer, array('class' => 'form-control', 'placeholder' => 'Reminder Timer Timer', 'required' => '')) }}
                        </div>

                        <div class="form-group">
                            <label>Tipster Confirmation / Pickup Cancellation Timer (seconds) :</label>
                            {{ Form::number('no_tipster_pickup_timer', $datas->no_tipster_pickup_timer, array('class' => 'form-control', 'placeholder' => '', 'required' => '')) }}
                        </div>

                        <div class="form-group">
                            <label>No Matched Shipment Cancellation (seconds) :</label>
                            {{ Form::number('no_shipment_timer', $datas->no_shipment_timer, array('class' => 'form-control', 'placeholder' => 'No Matched Shipment Timer', 'required' => '')) }}
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
