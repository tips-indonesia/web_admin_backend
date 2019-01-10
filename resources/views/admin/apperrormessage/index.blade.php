@extends('admin.app')

@section('title')
    App Error Message Dual Language
@endsection
@section('page_title')
    <span class="text-semibold">App Error Message Dual Language</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="form-group">
                <label> App Page Name : </label>
                <select name="page_name" id="page_name" class="form-control" onchange="load()">
                    @foreach($pages as $page)
                        <option value="{{$page->id}}" @if($selected_page == $page->id) selected @endif> {{ $page->name }} </option>
                    @endforeach()
                </select>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th> Key </th>
                        <th> Bahasa </th>
                        <th> English </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td> {{ $message->text_key }} </td>
                        <td> {{ $message->text_id }} </td>
                        <td> {{ $message->text_en }} </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('apperrormessage.edit', $message->text_key) }}">
                                <i class="icon-pencil"></i> Edit
                            </a>
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
            let id = document.getElementById('page_name').value

            window.location = "{{URL::to('/admin/apperrormessage')}}?id_page=" + id
        }
    </script>
@endsection