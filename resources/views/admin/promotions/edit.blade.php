@extends('admin.app')

@section('title')
    Promotions List
@endsection
@section('page_title')
<span class="text-semibold">Promotions</span> - Edit
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
            {{ Form::open(array('method'=> 'PUT','enctype'=>'multipart/form-data','url' => route('promotions.update', $data->id))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h4>Bulan {{ session('bulan') }} {{ session('tahun') }}</h4>
                                    
                                </div>
                            </div>
                            

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal Awal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" class="pickadate-year-awal form-control" name="tanggal_awal" placeholder="{{ $data->start_date}}" value="{{ $data->start_date }}" >
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
                                        <input type="text" class="pickadate-year form-control" name="tanggal_akhir" placeholder="{{ $data->end_date }}" value="{{ $data->end_date }}">
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
                                    <textarea id="content" cols="18" rows="18" class="form-control" name="content_text">{{ $data->content }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Template</label>
                                    @if($data->template_type === 'A')
                                        <input type="radio" name="template" value="A" required="" style="margin-left: 20px; size: 200%;" checked=""> A
                                        <input type="radio" name="template" value="B" required="" style="margin-left: 20px; size: 200%;"> B
                                    @else
                                        <input type="radio" name="template" value="A" required="" style="margin-left: 20px; size: 200%;"> A
                                        <input type="radio" name="template" value="B" required="" style="margin-left: 20px; size: 200%;" checked=""> B
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nilai Discount</label>
                                    <input type="number" class="form-control" name="discount" placeholder="{{ $data->discount_value }}" value="{{ $data->discount_value }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Discount Insurance</label>
                                    <input type="number" class="form-control" name="discount_insurance" placeholder="{{ $data->discount_insurance }}" value="{{ $data->discount_insurance }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>File Image</label>
                                    
                                    <input type="file" class="form-control" name="image" id="input_file">
                                    <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ URL::to('/') }}/storage/promotions/{{$data->file_name}}" style="width: 300px; height: 160px; margin-top: 10px;">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" name="submit" value="save" class="btn btn-primary">Update<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
    <script type="text/javascript">
        $('.pickadate-year-awal').datepicker({
            format: 'yyyy-mm-dd',
            // minDate: new Date($('.minnn').text()),
        });

        $('.pickadate-year').datepicker({
            format: 'yyyy-mm-dd'
            
        });

    </script>
@endsection