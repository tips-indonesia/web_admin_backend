@extends('admin.app')

@section('title')
    Redeem
@endsection
@section('page_title')
    <span class="text-semibold">Redeem</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('redeem.create') }}?month={{$selbulan}}&year={{$seltahun}}'">Create</button>
@endsection

@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('method'=> 'get','url' => route('redeem.index'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun</label>

                                    <select name="tahun" class="form-control">
                                        @foreach($tahuns as $tahun)
                                            <option value="{{ $tahun->year_period }}" @if($seltahun == $tahun->year_period) selected @endif>{{ $tahun->year_period }}</option>
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
                                    	@foreach($bulans as $bulan)
                                            <option value="{{ $bulan->id }}" @if($bulan->id == $selbulan) selected @endif>{{ $bulan->nama }}</option>
                                        @endforeach    
                                    </select> 
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
        <table class="table datatable-pagination" style="margin-left: 10px;">
            <thead>
                <tr>    
                    <th>No</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php($nomor=0)
                @foreach($data as $datas)
                    <tr>
                        <td>       
                            {{++$nomor}}
                        </td>
                        <td>
                            {{ $datas->start_date }}
                        </td>                        
                        <td>
                            {{ $datas->end_date }}
                        </td>
                        <td>
                            {{ $datas->description }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('redeem.edit', $datas->id))) }}
                                    <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                                    {{ Form::close() }}
                                </li>
                                <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('redeem.destroy', $datas->id))) }}
                                <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
                                {{ Form::close() }}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection