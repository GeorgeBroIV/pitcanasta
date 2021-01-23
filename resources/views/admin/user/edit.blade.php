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
						                           value="{{ old('username', $user->username) }}" autofocus>
					                    </div>
				                    </div>
				                    <!-- END - User Name -->
				                    <!-- START - First Name -->
				                    <div class="form-group row">
					                    <label for="firstname" class="col-md-3 col-form-label text-md-right">
						                    First Name
					                    </label>
					                    <div class="col-md-auto">
						                    <input id="firstname" name="firstname" type="text" class="form-control"
						                           value="{{ old('firstname', $user->firstname) }}">
					                    </div>
				                    </div>
				                    <!-- END - First Name -->
				                    <!-- START - Last Name -->
				                    <div class="form-group row">
					                    <label for="lastname" class="col-md-3 col-form-label text-md-right">
						                    Last Name
					                    </label>
					                    <div class="col-md-auto">
						                    <input id="lastname" name="lastname" type="text" class="form-control"
						                           value="{{ old('lastname', $user->lastname) }}">
					                    </div>
				                    </div>
				                    <!-- END - Last Name -->
				                    <!-- START - Display Name -->
				                    <div class="form-group row">
					                    <label for="displayname" class="col-md-3 col-form-label text-md-right">
						                    Display Name
					                    </label>
					                    <div class="col-md-auto">
						                    <input id="displayname" name="displayname" type="text" class="form-control"
						                           value="{{ old('displayname', $user->displayname) }}">
					                    </div>
				                    </div>
				                    <!-- END - Display Name -->
				                    <!-- START - E-mail -->
				                    <div class="form-group row">
					                    <label for="email" class="col-md-3 col-form-label text-md-right">
						                    E-mail
					                    </label>
					                    <div class="col-md-6">
						                    <input id="email" name="email" type="text" class="form-control"
						                           value="{{ old('email', $user->email) }}">
					                    </div>
				                    </div>
				                    <!-- END - E-mail -->
				                    <!-- START - Avatar -->
				                    <div class="form-group row">
					                    @if ($user->avatar)
						                    <div class="col-md-3 text-md-right">
							                    <img src="{{ asset('storage/'.$user->avatar) }}" style="width: 40px; height: 40px; border-radius: 50%">
						                    </div>
						                    <span class="form-text col-auto">
			                                        <label for="avatar" style="cursor: pointer" class="btn-sm
			                                        btn-secondary">
				                                        Change
			                                        </label>
			                                        <input id="avatar" type="file" class="form-control" name="avatar" style="visibility: hidden; opacity: 0; position: absolute; z-index: -1">
													&nbsp;&nbsp;
													or
													&nbsp;&nbsp;
			                                        <label for="avatarDelete">
				                                        Delete
			                                        </label>
													&nbsp;
													<input id="avatarDelete" name="avatarDelete" type="checkbox">
	                                            </span>
					                    @else
						                    <label for="avatar" class="col-md-3 col-form-label text-md-right">
							                    Avatar
						                    </label>
						                    <div class="col-md-6">
							                    <input id="avatar" type="file" class="form-control" name="avatar">
						                    </div>
					                    @endif
				                    </div>
				                    <!-- END - Avatar -->
				                    <!-- START - Visible -->
				                    <div class="form-group row">
					                    <label for="visible" class="col-md-3 col-form-label text-md-right">
						                    Visible
					                    </label>
					                    <div class="col-md-auto">
						                    <select id="visible" name="visible" class="form-control-sm form-text">
							                    @if(isset($user->visible) && $user->visible)
								                    <option value="1" selected>Yes</option>
								                    <option value="0">No</option>
							                    @else
								                    <option value="1">Yes</option>
								                    <option value="0" selected>No</option>
							                    @endif
						                    </select>
					                    </div>
				                    </div>
				                    <!-- END - Visible -->
				                    <!-- START - Active -->
				                    <div class="form-group row">
					                    <label for="active" class="col-md-3 col-form-label text-md-right">
						                    Active
					                    </label>
					                    <div class="col-md-auto">
						                    <select id="active" name="active" class="form-control-sm form-text">
							                    @if(isset($user->active) && $user->active)
								                    <option value="1" selected>Yes</option>
								                    <option value="0">No</option>
							                    @else
								                    <option value="1">Yes</option>
								                    <option value="0" selected>No</option>
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
						                           value="{{ old('notes', $user->notes) }}">
					                    </div>
				                    </div>
				                    <!-- END - Notes -->
				                    <!-- START - Form Buttons -->
				                    <div align="center" style="padding-top: 20px">
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
			                            <a href="{{ route('users.index') }}" class="btn-sm btn-dark">
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