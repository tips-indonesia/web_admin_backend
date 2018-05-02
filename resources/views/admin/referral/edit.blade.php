@extends('admin.app')

@section('title')
    Referral List
@endsection
@section('page_title')
<span class="text-semibold">Referral</span> - Edit
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
            {{ Form::open(array('method'=> 'PUT','enctype'=>'multipart/form-data','url' => route('referral.update', $referral->id))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal Awal :</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                        <input type="text" class="pickadate-year form-control" name="tanggal_awal" required="" value="{{$referral->start_date}}">
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
                                        <input type="text" class="pickadate-year form-control" name="tanggal_akhir" required="" value="{{$referral->end_date}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Referral Amount :</label>
                                    <input type="number" id="referral" cols="18" rows="18" class="form-control" placeholder="Referral Amount" name="referral_amount" required="" value="{{$referral->referral_amount}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Referred Amount :</label>
                                    <input type="number" id="referred" cols="18" rows="18" class="form-control" placeholder="Referred Amount" name="referred_amount" required="" value="{{$referral->referred_amount}}">
                                </div>
                            </div>
                        </div>                        
                        {{csrf_field()}}
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