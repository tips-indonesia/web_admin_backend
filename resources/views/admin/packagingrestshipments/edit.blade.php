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
                                    <option value="{{ $s->id }}" selected>{{ $s->shipment_id }}</option>
                                @endforeach
                                @foreach ($shipment_not as $s)
                                    <option value="{{ $s->id }}">{{ $s->shipment_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <script type="text/javascript">
         
    $('.listbox').bootstrapDualListbox({

        nonSelectedListLabel: 'Not Selected',
        selectedListLabel: 'Selected',
    });

        </script>
    </div>
@endsection