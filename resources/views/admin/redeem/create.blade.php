@extends('admin.app')

@section('title')
    Redeem
@endsection
@section('page_title')
<span class="text-semibold">Redeem</span> - Create
@endsection
@section('content')
@if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('method'=> 'POST','enctype'=>'multipart/form-data','url' => route('redeem.store'))) }}
                <input type="hidden" value="{{$month}}" name="selbulan">
                <input type="hidden" value="{{$year}}" name="seltahun">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                    <h4>Bulan {{ $month_word }} {{ $year }}</h4>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal Awal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" class="pickadate-year form-control" name="tanggal_awal" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>Tanggal Akhir :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" class="pickadate-year form-control" name="tanggal_akhir" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Deskripsi :</label>
                                    <input type="text" class="form-control" name="deskripsi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keterangan :</label>
                                    <input type="text" class="form-control" name="keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>URL :</label>
                                    <input type="text" class="form-control" name="url">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>File Image</label>
                                    <input type="file" class="form-control" name="image" id="input_file" required="">
                                </div>
                            </div>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" name="submit" value="save" class="btn btn-primary">Save<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    <script type="text/javascript">
        $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
    </script>
@endsection