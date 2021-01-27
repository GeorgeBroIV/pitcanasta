@extends('_layouts.app')

@section('content')
    @isAdmin
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
	                <div style="font-size: x-large; padding-bottom: 10px; text-align: center">
		                Website Administration Subsite
	                </div>
                    <div class="card">
	                    <div class="card-header" style="font-size: medium">
                            Edit {{ $user->username }}'s Main Profile Settings
                        </div>
	                    <div class="col-16">
		                    @if ($errors->any())
			                    <br>
			                    <div class="alert alert-danger alert-dismissible" role="alert">
				                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					                    <span aria-hidden="true">×</span>
				                    </button>
				                    <ul>
					                    @foreach ($errors->all() as $error)
						                    <li>
							                    {{ $error }}
						                    </li>
					                    @endforeach
				                    </ul>
			                    </div>
		                    @endif
	                    </div>
	                    <div class="card-body">
		                    <form action="{{ route('users.update', $user->id) }}" method="post">
			                    @method('PUT')
			                    @csrf
			                    <div class="card-title">
				                    Profile Settings
			                    </div>
			                    <!-- START - Hidden Form to transmit $user->id -->
				                    <input id="id" name="id" type="hidden" value="{{ $user->id }}">
				                    <!-- END - Hidden Form -->
				                    <!-- START - User Name -->
				                    <div class="form-group row">
					                    <label for="username" class="col-md-3 col-form-label text-md-right">
						                    User Name
					                    </label>
					                    <div class="col-md-auto">
						                    <input id="username" name="username" type="text" class="form-control"
						                           value="{{ old('username', $user->username) }}" disabled>
					                    </div>
				                    </div>
				                    <!-- END - User Name -->
				                    <!-- START - Active -->
				                    <div class="form-group row">
					                    <label for="active" class="col-md-3 col-form-label text-md-right">
						                    Active
					                    </label>
					                    <div class="col-md-auto">
						                    <select id="active" name="active" class="form-control-sm form-text">
							                    @if(isset($user->active) && $user->active)
								                    <option value="1"
								                            {{ old('active') == 1 ? 'selected' : '' }} selected>
									                    Yes
								                    </option>
								                    <option value="0"
										                    {{ old('active') == 0 ? '' : 'selected' }}>
								                        No
								                    </option>
							                    @else
								                    <option value="1"
								                            {{ old('active') == 1 ? 'selected' : '' }}>
									                    Yes
								                    </option>
								                    <option value="0"
										                    {{ old('active') == 0 ? '' : 'selected' }} selected>
									                    No
								                    </option>
							                    @endif
						                    </select>
					                    </div>
				                    </div>
				                    <!-- END - Active -->
				                    <!-- START - Notes -->
				                    <div class="form-group row">
					                    <label for="notes" class="col-md-3 col-form-label text-md-right">
						                    Notes
					                    </label>
					                    <div class="col-md-8">
						                    <input id="notes" name="notes" type="text" class="form-control"
						                           value="{{ old('notes', $user->notes) }}" autofocus>
					                    </div>
				                    </div>
				                    <!-- END - Notes -->
				                    <hr>
				                    <!-- START - User Roles -->
				                    <div class="card-title">
					                    User Roles
				                    </div>
				                    @foreach($roles as $role)
					                    <div class="form-group row">
						                    <label for="{{ $role->name }}" class="col-md-3 col-form-label
						                    text-md-right">
							                    {{ $role->description }}
						                    </label>
						                    <div class="col-md-auto">
							                    <select id="{{ 'role.' . $role->id }}" name="{{ 'role.' . $role->id }}"
							                            class="form-control-sm
							                    form-text">
								                    @if(in_array($role->name, $userRoles))
									                    <option value="1"
									                            {{ old('role.' . $role->id) == 1 ? 'selected' : '' }} selected>
										                    Yes
									                    </option>
									                    <option value="0"
									                            {{ old('role.' . $role->id) == 0 ? '' : 'selected' }}>
										                    No
									                    </option>
								                    @else
									                    <option value="1"
									                            {{ old('role.' . $role->id) == 1 ? '' : 'selected' }}>
										                    Yes
									                    </option>
									                    <option value="0"
									                            {{ old('role.' . $role->id) == 0 ? 'selected' : '' }} selected>
										                    No
									                    </option>
								                    @endif
							                    </select>
						                    </div>
					                    </div>
			                    @endforeach
			                    <!-- END - User Roles -->
			                    <hr>
			                    <!-- START - Form Buttons -->
			                    <div align="center">
		                            <span style="padding-left: 5px; padding-right: 5px">
			                            <button type="submit" class="btn-sm btn-primary" style="cursor: pointer">
				                            Save Changes
			                            </button>
		                            </span>
					                <span style="padding-left: 5px; padding-right: 5px">
			                            <a href="{{ route('users.edit', $user->id) }}" class="btn-sm btn-secondary">
				                            Reset Values
			                            </a>
		                            </span>
					                <span style="padding-left: 5px; padding-right: 5px">
			                            <a href="{{ route('users.show', $user->id) }}" class="btn-sm btn-dark">
				                            Cancel and Exit
			                            </a>
		                            </span>
			                    </div>
			                    <!-- END - Form Buttons -->
		                    </form>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endisAdmin
@endsection