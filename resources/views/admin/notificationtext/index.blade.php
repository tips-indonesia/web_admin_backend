@extends('admin.app')

@section('title')
    Notification Text
@endsection
@section('page_title')
    <span class="text-semibold">Notification Text</span> - Show All
@endsection
@section('content')
<div class="panel panel-flat">
        <div class="panel-body">
            <div class="form-group">
                <input onclick="load('id')" type="radio" name="lang" value="id" {{ $lang == 'id' ? 'checked' : ''}}/> Bahasa Indonesia &nbsp; &nbsp; &nbsp;
                <input onclick="load('en')" type="radio" name="lang" value="en" {{ $lang == 'en' ? 'checked' : ''}}/> English
            </div>  
            <div class="form-group">
                <label>App Page Name : </label>
                <select name="page_name" class="form-control" onchange="load2()" id="page_selector">
                    @foreach($pages as $page)
                        <option value="{{$page->id}}" @if($id_page == $page->id) selected @endif>{{$page->name}}</option>
                    @endforeach
                </select>
            </div>
            <table class="table datatable-pagination">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Push Notification</th>
                        <th>SMS Notification</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($texts as $data)
                        <tr>
                            <td>
                                {{ $data->text_key }}
                            </td>
                            <td>
                                {{ $data->text_push }}
                            </td>
                            <td>
                                {{ $data->text_sms }}
                            </td>
                            <td style="width: 250px;">
                            <ul class="icons-list">
                                <li>
                                    <a style="color: white;" href="{{route('notificationtext.edit', $data->text_key)}}?lang={{$lang}}" class="btn btn-primary"><i class="icon-pencil"></i> Edit</a>
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
        function load(lang) {
            window.location = "{{URL::to('/admin/notificationtext')}}?lang=" + lang + "&id={{$id_page}}"
        }
        function load2() {
            let id = document.getElementById('page_selector').value
            window.location = "{{URL::to('/admin/notificationtext')}}?id=" + id + "&lang={{$lang}}"
        }
    </script>
@endsection