@extends('admin.app')

@section('title')
    Add Worker Ability To User
@endsection

@section('page_title')
    <span class="text-semibold">Add Worker Ability To User</span> - Show All
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-body">
            	<label>First Name:</label>
            	<div class="row">
            		<div class="col-md-6">
            			<input type="text" name="first_name" class="form-conthol" placeholder="First Name">
            		</div>
            		<div class="col-md-2">
            			<button type="submit" class="btn btn-primary"> Search </button>x
            		</div>
            	</div>
            	<table class="table datatable-pagination">
            		<thead>
            			<th>First Name</th>
            			<th>Last Name</th>
            			<th>E-mail</th>
            			<th>Actions</th>
            		</thead>
            	</table>
            </div>
        </div>
    </div>
</div>
@endsection