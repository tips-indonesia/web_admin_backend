@extends('admin.app')

@section('title')
    Manual Redeem
@endsection
@section('page_title')
    <span class="text-semibold">Manual Redeem</span> -  Edit
@endsection
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::open(array('method' => 'PUT', 'url' => route('manualredeem.update', $data->id))) }}
        @if(isset($_GET['id_mr']))
        <input type="hidden" name="id_mr" />
        @endif
        <input type="hidden" name="id_mr" id="member-id" value="{{ $user->id }}"/>
        <div class="form-group">
            <label> Date : </label>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                <input type="text" name="date" id="date" class="form-control pickadate-year" placeholder="Date" value="{{ $date }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label> 
                    Member Name : 
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#memberlist" >
                        Member List
                    </button>
                </label>
                <input type="text" name="member_name" class="form-control" id="member-name" readonly 
                    value="{{$user->first_name . ' ' .$user->last_name}}">
            </div>
            <div class="col-md-6 form-group">
                <label> Mobile Phone No : 
                <button type="button" class="btn" style="visibility: hidden;">Hide</button>
                </label>
                </button>
                <input type="text" name="mobile_phone_no" class="form-control" id="phone" readonly
                    value="{{$user->mobile_phone_no}}">
            </div>
            <div class="form-group col-md-12">
                <label> Wallet Amount (Rp) : </label>
                <input type="text" name="wallet_amount" class="form-control" id="wallet" readonly
                    value="{{$wallet}}">
            </div>
            <br />
            <div class="form-group col-md-12">
                <label> Item Name : </label>
                <input type="text" name="item_name" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Price (Rp) : </label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Qty : </label>
                <input type="number" name="qty" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Total Amount: {{ $total_amount }} </label>
                <input type="hidden" value="{{ $total_amount }}" name="total_amount" />
            </div>
            <button style="float: right;" name="submit" value="save" @if($data->is_posting == 1) disabled @endif class="btn btn-primary">Save</button>
            <button @if($data->is_posting == 1) disabled @endif value="post" name="submit" style="float: right; margin-right: 10px; margin-left: 10px;" class="btn btn-success">Post</button>
        <div>
        {{ Form::close() }}
        <table class="table">
            <thead>
                <tr>
                    <th> Item Name </th>
                    <th> Price  </th>
                    <th> Qty </th>
                    <th> Total </th>
                    <th> &nbsp; </th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td> {{ $item->item_name }} </td>
                    <td> {{ $item->unit_price }} </td>
                    <td> {{ $item->qty }} </td>
                    <td> {{ $item->qty * $item->unit_price }} </td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'url' => route('manualredeem.destroy',  $item->seq))) }}
                        <button type="submit" class="btn btn-danger" @if($data->is_posting == 1) disabled @endif > Delete </button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="memberlist" aria-labelledby="memberlistLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h3>Member List</h3>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <label style="margin-top: 8px;">Search by First Name</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="query-search">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" id="query-button">View</button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th> Member Name </th>
                            <th> Mobile Phone No </th>
                            <th> Wallet Amount (Rp) </th>
                        </tr>
                    </thead>
                    <tbody id="members">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.select-search').select2();
    $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
    $('#param').on('select2:select', function() {
        if ($('#param').val() != 'blank') {
            $('#value').prop('required', true)
        } else {
            $('#value').prop('required', false)
        }
    });

    function formatPrice (value) {
      let val = (value / 1).toFixed(0).replace('.')
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')
    }

    function getMembers(query) {
        $.ajax({
            url: '{{ URL::to("api/manualredeem/member") }}',
            headers: {
                'app-kind' : 'web-app'
            },
            data: {'query': query},
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var html = ''
                for (var i = 0; i < data.length; ++i) {
                    var member = data[i]
                    var address = (member['address'] == null) ? '' : member['address']
                    var name = member['first_name'] + ' ' + member['last_name'];
                    html += '<tr> <td> <a data-dismiss="modal" onclick="setUser(\'' + member['id'] + '\',\'' + name + '\', \'' + member['mobile_phone_no'] + '\', \'' + address + '\', \'' + member['wallet'] + '\')">' + name + '</a></td>' +
                                  '<td>' + member['mobile_phone_no'] + '</td>' +
                                  '<td> Rp ' + formatPrice(member['wallet']) + '</td></tr>'
                    $('#members').html(html)
                    $('#query-button').html('View')
                }
            }
        })
    }

    function setUser(id, user, phone, address, wallet) {
        $('#member-id').val(id)
        $('#member-name').val(user)
        $('#phone').val(phone)
        // $('#address').val(address)
        $('#wallet').val(wallet)
    }

    $('#query-button').on('click', function() {
        $('#query-button').html('Searching...')
        getMembers($('#query-search').val())
    })
    getMembers('all')
</script>

@endsection