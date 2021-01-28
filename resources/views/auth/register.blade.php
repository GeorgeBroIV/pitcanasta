@extends('_layouts.app')

@section('title', 'Register')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						{{ __('Sign Up') }}
					</div>
					<div class="card-body">
						<p class="text-md-left">
							Welcome to our {{ env('APP_NAME') }} web application.
						</p>
						When you sign up / register with us (after e-mail validation), you may have the option to log
						in with various Social Providers (Google, etc) to incorporate streamlined features of these
						providers into this web application.
					</div>
					<hr>
					<div class="card-body">
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<div class="form-group row">
								<label for="username" class="col-md-4 col-form-label text-md-right">
									{{ __('User Name') }}
								</label>
								<div class="col-md-6">
									<input id="username" type="text" class="form-control @error('username')
											is-invalid @enderror" name="username" value="{{ old('username') }}"
									       required autocomplete="username" autofocus>
									@error('username')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="firstname" class="col-md-4 col-form-label text-md-right">
									{{ __('First Name') }}
								</label>
								<div class="col-md-6">
									<input id="firstname" type="text" class="form-control @error('firstname')
											is-invalid @enderror" name="firstname" value="{{ old('firstname') }}"
									       required autocomplete="firstname">
									@error('firstname')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="lastname" class="col-md-4 col-form-label text-md-right">
									{{ __('Last Name') }}
								</label>
								<div class="col-md-6">
									<input id="lastname" type="text" class="form-control @error('lastname')
											is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"
									       required autocomplete="lastname">
									@error('lastname')
									<span class="invalid-feedback" role="alert">
                                        <strong>
	                                        {{ $message }}
                                        </strong>
                                    </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="displayname" class="col-md-4 col-form-label text-md-right">
									{{ __('* Display Name') }}
								</label>
								<div class="col-md-6">
									<input id="displayname" type="text" class="form-control @error('displayname')
											is-invalid @enderror" name="displayname" value="{{ old('displayname') }}"
									       required autocomplete="displayname">
									@error('displayname')
									<span class="invalid-feedback" role="alert">
                                        <strong>
	                                        {{ $message }}
                                        </strong>
                                    </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">
									{{ __('E-Mail Address') }}
								</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
									@error('email')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">
									{{ __('Password') }}
								</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
									@error('password')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">
									{{ __('Confirm Password') }}
								</label>
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
								</div>
							</div>
							
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Sign Up') }}
									</button>
								</div>
							</div>
						</form>
						<hr>
						<p>
							* Note that the 'Display Name' is for the {{ env('APP_NAME') }} web application framework
							and not for any Social Provider or Game Profile display name.&nbsp; It is recommended to use
							your regular nick name for this value.&nbsp; Once you are registered within this system
							you'll have the ability to create custom game id's for the gaming tables, message boards and chat rooms.
						</p>
						<p class="text-md-center">
							You will receive a validation e-mail within a few minutes of registering with us.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
