@extends('_layouts.app')

@section('content')
    @isAdmin
	    <div class="container">
	        <div class="row justify-content-center">
	            <div class="col-lg-auto">
		            <div style="font-size: x-large; padding-bottom: 10px; text-align: center">
			            Website Administration Subsite
		            </div>
	                <div class="card">
		                <div class="card-header" style="font-size: medium">
	                        <span>
		                        User Roles
	                        </span>
		                    <span class="float-lg-right">
			                    <a class="btn-sm btn-primary" style="color: white; cursor: pointer" href="{{ route
			                    ('roles.create') }}">
					                Create New Role
			                    </a>
		                    </span>
	                    </div>
	                    <div class="card-body">
	                        <form action="{{ route('roles.show', $roles[0]->id) }}" method="get">
		                        @method('put')
	                            @csrf
	                            <table>
	                                @include('admin.role.tablehead')
	                                @foreach($roles as $role)
										@if($role->active)
				                            <tr style="border-bottom: 1px solid lightgray">
			                            @else
				                            <tr style="background-color: lightgrey; border-bottom: 1px solid darkgrey">
										@endif
		                                    <td style="padding: 10px">
			                                    {{ $role->name }}
		                                    </td>
		                                    <td style="padding: 10px">
	                                            {{ $role->description }}
	                                        </td>
		                                    <td style="padding: 10px" align="center">
			                                    @if($role->active)
				                                    Yes
			                                    @else
				                                    No
			                                    @endif
		                                    </td>
	                                        <td style="padding: 10px; max-width: 600px">
	                                            {{ $role->notes }}
	                                        </td>
				                            <!-- Protects Admins from deleting main roles -->
				                            @if($role->id > 4)
					                            <td style="padding: 5px">
						                            <button class="btn-sm btn-secondary" type="submit" name="id" id="id"
						                                    value="{{ $role->id }}">
							                            Edit
						                            </button>
					                            </td>
						                        <td>
						                            <a href="{{ route('roles.delete', $role->id) }}"
						                               class="btn-sm btn-danger">
							                            Delete
						                            </a>
						                        </td>
											@else
						                        <td colspan="2" style="padding: 5px" align="center">
							                        <div style="color: gray">
								                        Protected
							                        </div>
						                        </td>
					                        @endif
	                                    </tr>
	                                @endforeach
	                            </table>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    @endisAdmin
@endsection
