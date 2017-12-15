@extends('admin.app')

@section('title')
    Backup Database
@endsection
@section('page_title')
    <span class="text-semibold">Database Backup</span>
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('backups.store'), 'method' => 'POST')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create backup <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        <script type="text/javascript">
            
        </script>>
    </div>
@endsection


