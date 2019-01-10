@extends('admin.app')

@section('title')
    Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">App Label Dual Language</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="form-group">
                <label>App Page Name : </label>
                <select name="page_name" class="form-control" onchange="load()" id="page_selector">
                    @foreach($pages as $page)
                        <option value="{{$page->id}}" @if($id_page == $page->id) selected @endif>{{$page->name}}</option>
                    @endforeach
                </select>
            </div>
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
                            <td style="width: 250px;">
                            <ul class="icons-list">
                                <li>
                                    {{ Form::open(array('method' => 'GET', 'url' => route('duallanguage.edit', 1))) }}
                                    <input type="hidden" value="{{ $data->text_key }}" name="text_key">
                                    <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
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

@endsection

@section('scripts')
    <script type="text/javascript">
        function load() {
            let id = document.getElementById('page_selector').value
            window.location = "{{URL::to('/admin/duallanguage')}}?id=" + id
        }
    </script>
@endsection