@extends('admin.app')

@section('title')
    Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">Dual Language</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">     
    {{ Form::open(array('url' => route('duallanguage.index'), 'method' => 'GET')) }}
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Search By :</label>
                            <select name="param" id="param" class="form-control">
                                <option value="blank" ></option>
                                <option value="text_key" {{ $param == 'text_key' ? 'selected' : '' }}>Key</option>
                                <option value="text_id" {{ $param == 'text_id' ? 'selected' : '' }}>Bahasa</option>
                                <option value="text_en" {{ $param == 'text_en' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>&#8192;</label>
                            <input type="text" name="value" id="value" class="form-control " placeholder="Search" value="{{$value}}">                       
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14  position-right"></i></button>
                </div>
            </div>
    {{ Form::close() }}
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Bahasa</th>
                    <th>English</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->text_key }}
                        </td>
                        <td>
                            {{ $data->text_id }}
                        </td>
                        <td>
                            {{ $data->text_en }}
                        </td>
                        <td>
                        <ul class="icons-list">
                            <li>
                                {{ Form::open(array('method' => 'GET', 'url' => route('duallanguage.edit', 1))) }}
                                <input type="hidden" value="{{ $data->text_key }}" name="text_key">
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                                {{ Form::close() }}
                            </li>
                            <li>
                                {{ Form::open(array('method' => 'GET', 'url' => route('duallanguage.show', 1))) }}
                                <input type="hidden" value="true" name="delete" />
                                <input type="hidden" value="{{ $data->text_key }}" name="text_key">
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