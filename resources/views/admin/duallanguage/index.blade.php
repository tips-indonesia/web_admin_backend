@extends('admin.app')

@section('title')
    Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">Dual Language</span> - Show All
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('duallanguage.create') }}'">Create</button>
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
                                <option value="key" {{ $param == 'key' ? 'selected' : '' }}>Key</option>
                                <option value="value" {{ $param == 'value' ? 'selected' : '' }}>Value</option>
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
                    <label>Pilih Bahasa :</label>
                    <select name="bahasa" id="param" class="form-control">
                        <option value="ID" {{ $bahasa == 'IN' ? 'selected' : '' }}>Bahasa</option>
                        <option value="EN" {{ $bahasa == 'EN' ? 'selected' : '' }}>English</option>
                    </select>
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
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                @if ($bahasa == $data->lang_id)
                    <tr>
                        <td>
                            {{ $data->key }}
                        </td>
                        <td>
                            {{ $data->value }}
                        </td>
                        <td>
                        <ul class="icons-list">
                            <li>
                                {{ Form::open(array('method' => 'GET', 'url' => route('duallanguage.edit', $data->id))) }}
                                <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                                {{ Form::close() }}
                            </li>
                            <li>
                                {{ Form::open(array('method' => 'DELETE', 'url' => route('duallanguage.destroy', $data->id))) }}
                                <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
                                {{ Form::close() }}
                            </li>
                        </ul>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </div>

@endsection