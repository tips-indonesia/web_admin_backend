@extends('admin.app')

@section('title')
    Term and Agreement
@endsection
@section('page_title')
    <span class="text-semibold">Term and Agreement</span>
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">

            <!-- WYSIHTML5 basic -->
                    <div class="panel panel-flat">

                        <div class="panel-body">
                            <h4>Syarat dan Ketentuan Antar</h4>
            {{ Form::open(array('url' => route('terms.update', $datas->id), 'method' => 'PUT')) }}
                                <div class="form-group">
                                    <textarea id="editor" cols="18" rows="18" class="wysihtml5 wysihtml5-min form-control" placeholder="Term and Agreement" name="terms">{{ $datas->content }}</textarea>
                                </div>

                                <div class="text-right form-group">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
            {{ Form::close() }} 
                            <br>
                            <h4>Syarat dan Ketentuan Kirim</h4>
            {{ Form::open(array('url' => '#', 'method' => 'PUT')) }}
                                <div class="form-group">
                                    <textarea id="editor" cols="18" rows="18" class="wysihtml5 wysihtml5-min form-control" placeholder="Term and Agreement" name="terms">{{ $datas->content }}</textarea>
                                </div>

                                <div class="text-right form-group">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
            {{ Form::close() }} 
                        </div>
                    <!-- /WYSIHTML5 basic -->
        </div>
    </div>
   <script>
@endsection
