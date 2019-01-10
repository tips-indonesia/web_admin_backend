@extends('admin.app')

@section('title')
    Help
@endsection
@section('page_title')
    <span class="text-semibold">Help</span> - Show All
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="form-group">
                <input onclick="load('id')" type="radio" name="lang" value="id" {{ $lang == 'id' ? 'checked' : ''}}/> Bahasa Indonesia &nbsp; &nbsp; &nbsp;
                <input onclick="load('en')" type="radio" name="lang" value="en" {{ $lang == 'en' ? 'checked' : ''}}/> English
            </div>  

            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($helps as $help)
                    <tr>
                        <td>{{ $help->title }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('help.edit', $help->id)}}?lang={{$lang}}"><i class="icon-pencil"></i> Edit </a>
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
            window.location = "{{URL::to('/admin/help')}}?lang=" + lang
        }
    </script>
@endsection