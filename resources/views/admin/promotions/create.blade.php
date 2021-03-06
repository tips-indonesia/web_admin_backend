@extends('admin.app')

@section('title')
    Promotions List
@endsection
@section('page_title')
<span class="text-semibold">Promotions</span> - Create
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
            {{ Form::open(array('method'=> 'POST','enctype'=>'multipart/form-data','url' => route('promotions.store'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                             <div class="col-md-12">
                                <div class="form-group">
                                    <h4>Bulan {{ session('bulan') }} {{ $year }}</h4>
                                    
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
                        <div class="row" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Header Text</label>
                                    <input type="text" class="pickadate-year form-control" name="header_text" value="default">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Content Text</label>
                                    <textarea id="content" cols="18" rows="18" class="form-control" placeholder="Content Text" name="content_text"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Template</label>
                                    <input type="radio" name="template" value="A" required="" style="margin-left: 20px; size: 200%;"> A
                                    <input type="radio" name="template" value="B" required="" style="margin-left: 20px; size: 200%;"> B
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nilai Discount</label>
                                    <input type="number" class="form-control" name="discount" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Discount Insurance</label>
                                    <input type="number" class="form-control" name="discount_insurance" required="">
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