@extends('admin.app')

@section('title')
    City List
@endsection
@section('page_title')
    <span class="text-semibold">City List</span> - Show All
    @if ($province)
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('citylists.create') }}?province={{$province}}'">Create</button>
    @endif
@endsection
@section('content')
    <div class="panel panel-flat">     

    {{ Form::open(array('url' => route('citylists.index'), 'method' => 'GET')) }}
            <div class="panel-body">
                <div class="form-group">
                    <label>Province :</label>
                    <select name="province" class="select-search">
                        <option disabled selected></option>
                        @foreach ($provinces as $provinc)
                            <option value="{{ $provinc->id }}" @if($province == $provinc->id) selected @endif>{{ $provinc->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14  position-right"></i></button>
                    </div>
            </div>
    {{ Form::close() }}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->name }}
                        </td>
                        <td>
                        <ul class="icons-list">
                        <li>
                        {{ Form::open(array('method' => 'GET', 'url' => route('citylists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                        </li>
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('citylists.destroy', $data->id))) }}
                        <button type="submit" class="btn btn-danger"><i class="icon-trash"></i> Delete</button>
                        {{ Form::close() }}
                        </li>
                        </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{ $datas->appends(request()->input())->links() }}
    </div>

        <script>
            $('.select-search').select2();
        </script>
@endsection