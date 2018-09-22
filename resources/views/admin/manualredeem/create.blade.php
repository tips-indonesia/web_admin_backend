@extends('admin.app')

@section('title')
    Manual Redeem
@endsection
@section('page_title')
    <span class="text-semibold">Manual Redeem</span> - Create
@endsection
@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
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
                <input type="text" name="member_name" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label> Mobile Phone No : 
                <button type="button" class="btn" style="visibility: hidden;">Hide</button>
                </label>
                </button>
                <input type="text" name="mobile_phone_no" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Address : </label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Wallet Amount (Rp) : </label>
                <input type="text" name="wallet_amount" class="form-control">
            </div>
            <br />
            <div class="form-group col-md-12">
                <label> Item Name : </label>
                <input type="text" name="item_name" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Price (Rp) : </label>
                <input type="text" name="price" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Qty : </label>
                <input type="text" name="qty" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label> Total Amount: 7500 </label>
            </div>
            <button style="float: right;" class="btn btn-primary">Save</button>
        <div>
        
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
            </tbody>
        </table>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="memberlist" aria-labelledby="memberlistLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Content modal here
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
</script>

@endsection