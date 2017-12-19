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
            {{ Form::open(array('url' => route('packagingrestshipments.store'), 'method' => 'POST')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="shipment[]">
                                @foreach ($shipment as $s)
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