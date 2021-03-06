@extends('admin.app')

@section('title')
    Referral List
@endsection
@section('page_title')
<span class="text-semibold">Referral</span>- Show All
<button type="button" class="btn btn-success" onclick="window.location.href='{{ route('referral.create') }}'">Create</button>
@endsection
@section('content')

    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('method'=> 'get','url' => route('referral.index'))) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun</label>

                                    <select name="tahun" class="form-control">
                                        @foreach($tahun as $tahu)
                                            @if($tahu->year_period == $seltahun)
                                                <option value="{{ $tahu->year_period }}" selected="">{{ $tahu->year_period }}</option>
                                            @else
                                                <option value="{{ $tahu->year_period }}">{{ $tahu->year_period }}</option>
                                            @endif
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
                                            @if($bula->id == $selbulan)
                                                <option value="{{ $bula->nama }}" selected="">{{ $bula->nama }}</option>
                                            @else
                                                <option value="{{ $bula->nama }}" >{{ $bula->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" name="submit" value="save" class="btn btn-primary">View<i class="icon-arrow-right14 position-right"></i></button>
                        </div>
            {{ Form::close() }}

            <table class="table datatable-pagination" style="margin-left: 10px;">
            <thead>
                <!-- <tr>
                    <th>Bulan : {{ $namabulan }} {{ $namatahun }}</th>
                </tr> -->
                <tr>    
                    <th>No</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Status</th>
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
                            {{ $datas->id == $latest_referral_id ? "Aktif" : "Tidak Aktif" }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('referral.edit', $datas->id))) }}
                                    <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                                    {{ Form::close() }}
                                </li>
                                <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('referral.destroy', $datas->id))) }}
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
    </div>
                </div>        
    </div>
@endsection