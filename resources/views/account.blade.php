@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" style="font-size: medium">
						{{ $user->displayname }}'s Account Information
					</div>
					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif
						<div class="container">
							<div class="row">
								<div class="col-12">
									@if ($errors->any())
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
									<form action="{{ route('account.edit') }}" method="POST" role="form"
									      enctype="multipart/form-data">
										@csrf
										<!-- START - User Name (disabled) -->
										<!-- TODO Add Ability to Change User Name, with validation constraints -->
										<div class="form-group row">
											<label for="username" class="col-md-4 col-form-label text-md-right">
												User Name
											</label>
											<div class="col-md-6">
												<input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}" disabled>
											</div>
										</div>
										<!-- END  -User Name -->
										<!-- START - E-mail (disabled) -->
										<!-- TODO Add Ability to Change E-mail, with validation constraints (including unique), delete 'e-mail verified', change 'role', and once verified change 'role' to previous -->
										<div class="form-group row">
											<label for="email" class="col-md-4 col-form-label text-md-right">
												Email
											</label>
											<div class="col-md-6">
												<input id="email" type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}" disabled>
											</div>
										</div>
										<!-- END - E-mail -->
										<!-- START - First Name -->
										<div class="form-group row">
											<label for="firstname" class="col-md-4 col-form-label text-md-right">
												First Name
											</label>
											<div class="col-md-6">
												<input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname', $user->firstname) }}" autofocus>
											</div>
										</div>
										<!-- END First Name -->
										<!-- START - Last Name -->
										<div class="form-group row">
											<label for="lastname" class="col-md-4 col-form-label text-md-right">
												Last Name
											</label>
											<div class="col-md-6">
												<input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname', $user->lastname) }}">
											</div>
										</div>
										<!-- END - Last Name -->
										<!-- START - Display Name -->
										<div class="form-group row">
											<label for="displayname" class="col-md-4 col-form-label text-md-right">
												* Display Name
											</label>
											<div class="col-md-6">
												<input id="displayname" type="text" class="form-control" name="displayname" value="{{ old('displayname', $user->displayname) }}">
											</div>
										</div>
										<!-- END - Display Name -->
										<!-- START - Visible -->
										<div class="form-group row">
											<label for="visible" class="col-md-4 col-form-label text-md-right">
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
										<!-- START - Avatar -->
										<div class="form-group row">
											@if ($user->avatar)
												<div class="col-md-4 text-md-right">
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
												<label for="avatar" class="col-md-4 col-form-label text-md-right">
													Avatar
												</label>
												<div class="col-md-6">
													<input id="avatar" type="file" class="form-control" name="avatar">
												</div>
											@endif
										</div>
										<!-- END - Avatar -->
										<!-- START - Form Buttons -->
										<div class="form-group row mb-0 mt-5">
											<div class="col-md-8 offset-md-4">
												<button type="submit" class="btn-sm btn-primary">
													Save Account Changes
												</button>
												&nbsp;&nbsp;
												<a href="{{ route('account') }}" class="btn-sm btn-secondary">
													Reset Values
												</a>
												&nbsp;&nbsp;
												<a href="{{ route('home') }}" class="btn-sm btn-dark">
													Cancel and Exit
												</a>
											</div>
										</div>
										<!-- END - Form Buttons -->
									</form>
									<hr>
									<p>
										* Note that the 'Display Name' is for the {{ env('APP_NAME') }} web
										application framework and not for any 'Social Providers' or 'Profile' display
										names.&nbsp; It is recommended to use your regular nick name for this value
										.&nbsp; Once you are registered within this system you'll have the ability to
										create custom Game Table id's for the gaming tables, message boards and chat
										rooms.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
