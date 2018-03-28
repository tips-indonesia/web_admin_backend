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
            {{ Form::open(array('method'=> 'get','url' => route('promotions.index'))) }}
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
        <table class="table datatable-pagination" style="margin-left: 10px;">
            <thead>
                <tr>    
                    <th>No</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Template</th>
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
                            {{ $datas->template_type }}
                        </td>
                        <td>
                            <ul class="icons-list">
                            <li>
                            {{ Form::open(array('method' => 'GET', 'url' => route('promotions.edit', $datas->id))) }}
                                    <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                                    {{ Form::close() }}
                                </li>
                                <li>
                            {{ Form::open(array('method' => 'DELETE', 'url' => route('promotions.destroy', $datas->id))) }}
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