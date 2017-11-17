@extends('admin.app')

@section('title')
    Manage Permission
@endsection
@section('page_title')
    <span class="text-semibold">Manage Permission</span> - {{ $role->name }}
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('permissions.update', $role->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="text-right form-group">
                            <select multiple="multiple" class="form-control listbox" name="permission[]">
                                @foreach ($set as $s)
                                    <option value="{{ $s->id }}" selected>{{ $s->show_name }}</option>
                                @endforeach
                                @foreach ($unset as $s)
                                    <option value="{{ $s->id }}">{{ $s->show_name }}</option>
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

        nonSelectedListLabel: 'Not Allowed',
        selectedListLabel: 'Allowed',
    });

        </script>
    </div>
@endsection