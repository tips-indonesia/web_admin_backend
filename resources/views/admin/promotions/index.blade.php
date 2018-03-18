@extends('admin.app')

@section('title')
    Promotions List
@endsection
@section('page_title')
<span class="text-semibold">Promotions</span>- Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('promotions.create') }}'">Create</button>
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('method'=> 'get','url' => route('promotions.show', $tahun[0]->year_period))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun</label>

                                    <select name="tahun" class="form-control">
                                        @foreach($tahun as $tahu)
                                        <option value="{{ $tahu->year_period }}">{{ $tahu->year_period }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select name="bulan" class="form-control">
                                        @foreach($bulan as $bula)
                                        <option value="{{ $bula->nama }}">{{ $bula->nama }}</option>
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" required="">
                                </div>
                            </div>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" name="submit" value="save" class="btn btn-primary">View<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection