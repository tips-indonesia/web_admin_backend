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
                            <input type="radio" name="lang" onclick="to('id')" value="id" @if($lang == 'id') checked @endif/> Bahasa Indonesia &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="lang" onclick="to('en')" value="en" @if($lang == 'en') checked @endif/> English
                            <h4>Syarat dan Ketentuan Antar</h4>
            {{ Form::open(array('url' => route('terms.update', $antar->id), 'method' => 'PUT')) }}
                                <div class="form-group">
                                    <input type="hidden" name="jenis" value="antar">
                                    <textarea id="editor" cols="18" rows="18" class="wysihtml5 wysihtml5-min form-control" placeholder="Term and Agreement" name="terms">{{ $antar->value }}</textarea>
                                </div>

                                <div class="text-right form-group">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
            {{ Form::close() }} 
                            <br>
                            <h4>Syarat dan Ketentuan Kirim</h4>
            {{ Form::open(array('url' => route('terms.update', $kirim->id), 'method' => 'PUT')) }}
                                <div class="form-group">
                                    <input type="hidden" name="jenis" value="kirim">
                                    <textarea id="editor" cols="18" rows="18" class="wysihtml5 wysihtml5-min form-control" placeholder="Term and Agreement" name="terms">{{ $kirim->value }}</textarea>
                                </div>

                                <div class="text-right form-group">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
            {{ Form::close() }} 
                        </div>
                    <!-- /WYSIHTML5 basic -->
        </div>
    </div>
   
@endsection

@section('scripts')
<script type="text/javascript">
    function to(lang) {
        console.log('to')
        window.location = "{{URL::to('/admin/terms')}}?lang=" + lang
    }
</script>
@endsection
