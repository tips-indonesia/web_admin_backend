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
            		{{ Form::open(array('url' => route('addworkerability.index'), 'method' => 'GET')) }}
            		<div class="col-md-6">
            			<input type="text" name="firstname" class="form-control" placeholder="First Name" required @if(isset($firstname)) value="{{$firstname}} @endif">
            		</div>
            		<div class="col-md-2">
            			<button type="submit" class="btn btn-primary"> Search </button>
            		</div>
            		{{ Form::close() }}
            	</div>
            	<table class="table datatable-pagination">
            		<thead>
            			<th>First Name</th>
            			<th>Last Name</th>
            			<th>E-mail</th>
            			<th>Actions</th>
            		</thead>
            		<tbody>
            			@foreach ($users as $user)
	                    <tr>
	                        <td>
	                            {{ $user->first_name }}
	                        </td>
	                        <td>
	                            {{ $user->last_name }}
	                        </td>
	                        <td>
	                            {{ $user->email }}
	                        </td>
	                        <td>
	                        <ul class="icons-list">
	                        <li>
	                        {{ Form::open(array('method' => 'GET', 'url' => route('addworkerability.edit', $user->id))) }}
	                        <button type="submit" class="btn btn-primary"><i class="icon-pencil"></i> Edit</button>
	                        {{ Form::close() }}
	                        </li>
	                        </ul>
	                        </td>
	                    </tr>
                		@endforeach
            		</tbody>
            	</table>
				{{ $users->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection