@extends('admin.app')

@section('title')
    Edit Subdistrict List
@endsection
@section('page_title')
    <span class="text-semibold">Subdistrict List</span> - Edit
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">
            {{ Form::open(array('url' => route('subdistrictlists.update', $datas->id), 'method' => 'PUT')) }}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Province :</label>
                            <select name="province" id="province" class="select-search">
                                <option disabled></option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}" >{{ $province->name }}</option>
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
                            <label>Name :</label>
                            {{ Form::text('name', $datas->name, array('class' => 'form-control', 'placeholder' => 'Subdistrict Name')) }}
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
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
            $('province').value = {{ $datas->id_province }};
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
                        if ({{ $datas->id_city}} == data[i].id) opt.selected = true;
                        city.append(opt);
                    }
                }
            });
        </script>
        
@endsection