@extends('admin.app')

@section('title')
    Subdistrict List
@endsection
@section('page_title')
    <span class="text-semibold">Subdistrict List</span> - Show All
    
    @if ($province && $city)
    <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('subdistrictlists.create') }}?province={{$province}}&city={{$city}}'">Create</button>
    @endif
@endsection
@section('content')
    <div class="panel panel-flat">     
            {{ Form::open(array('url' => route('subdistrictlists.index'), 'method' => 'GET')) }}
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Province :</label>
                            <select name="province" id="province" class="select-search">
                                <option disabled @if(!$province) selected @endif></option>
                                @foreach ($provinces as $provinc)
                                    <option value="{{ $provinc->id }}" @if ($province == $provinc->id) selected @endif>{{ $provinc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>City :</label>
                            <select name="city" id="city" class="select-search">
                                <option disabled selected></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">View <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
            {{ Form::close() }}
        <script>
            $('.select-search').select2();
            $('#province').on('select2:select', function() {
                var city = $('#city');
                city.empty();
                $.ajax({
                    url: '{{ route("citylists.index") }}',
                    data: {'ajax': 1, 'province' : $('#province').val()},
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var option = new Option;
                        option.disabled = true;
                        option.selected = true;
                        city.append(option);
                        for(var i = 0 ; i < data.length; i++) {
                            city.append(new Option(data[i].name, data[i].id));
                        }
                    }
                });
            });
    @if ($province && $city)
            $('province').value = {{ $province }}
            var city = $('#city');
            city.empty();
            $.ajax({
                url: '{{ route("citylists.index") }}',
                data: {'ajax': 1, 'province' : $('#province').val()},
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var option = new Option;
                    option.disabled = true;
                    option.selected = true;
                    city.append(option);
                    for(var i = 0 ; i < data.length; i++) {
                        var opt = new Option(data[i].name, data[i].id);
                        if ({{ $city}} == data[i].id) opt.selected = true;
                        city.append(opt);
                    }
                }
            });
    @endif
        </script>
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
                        {{ Form::open(array('method' => 'GET', 'url' => route('subdistrictlists.edit', $data->id))) }}
                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
                        {{ Form::close() }}
                        </li>
                        <li>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('subdistrictlists.destroy', $data->id))) }}
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

@endsection