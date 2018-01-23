@extends('admin.app')

@section('title')
    Create Packaging Rest Shipment
@endsection
@section('page_title')
    <span class="text-semibold">Packaging Rest Shipment</span> - Create
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('packagingrestshipments.update', $data->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Packaging ID :</label>
                            {{ Form::text(null, $data->packaging_id, array('class' => 'form-control', 'placeholder' => 'Payment Type Name', 'readonly' => '', 'disabled' => '')) }}
                        </div>
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipment[]">
                                @foreach ($shipment as $s)
                                    <option value="{{ $s->id }}" selected>{{ $s->shipment_id }} &nbsp; - &nbsp; {{ $s->transaction_date }} &nbsp; - &nbsp; {{ $s->origin_name }} &nbsp; - &nbsp; {{ $s->destination_name }}</option>
                                @endforeach
                                @foreach ($shipment_not as $s)
                                    <option value="{{ $s->id }}">{{ $s->shipment_id }} &nbsp; - &nbsp; {{ $s->transaction_date }} &nbsp; - &nbsp; {{ $s->origin_name }} &nbsp; - &nbsp; {{ $s->destination_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_small">QR Code</i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <!-- Small modal -->
        <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">QR Code</h5>
                    </div>

                    <div class="modal-body">
                        <div id="qr"></div>
                    </div>

                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- /small modal -->
        <script type="text/javascript">
         jQuery('#qr').qrcode({
            text    : "{{ $data->packaging_id }}",
            render : "canvas"
        }); 
    $('.listbox').bootstrapDualListbox({

        nonSelectedListLabel: 'Not Selected',
        selectedListLabel: 'Selected',
    });

        </script>
    </div>
@endsection