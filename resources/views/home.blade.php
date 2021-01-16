@extends('_layouts.app')

@section('content')
	<p class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Home Page
				</div>
				<div class="card-body">
					<p>
						1/15/2021: The basic {{ env('APP_NAME') }} web application framework is complete
						(security, user authentication and basic user profile information).&nbsp; The next step in
						developing this	web application is for us to create a 'Game Profile' page where users can
						create multiple gaming id's.&nbsp; Shortly after that we will create a chatroom!&nbsp; For
						an overview of things to come, please click on the '{{ env('APP_NAME') }}' logo in the upper
						left part of this window.
					</p>
				</div>
			</div>
			<br>
			<div class="card">
				<div class="card-header">
					Dashboard
				</div>
				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<p>
						Hi {{ Auth::user()->firstname }}, you are now logged into the {{ env('APP_NAME') }} web
						application.
					</p>
					<p>
						When developed, this dashboard will display real-time statistics including: total number
						of registered users; number of currently logged-in users; chatroom statistics; new
						messageboard messages since your last visit; etc.
					</p>
					
					@if (isset($message) && $message == "CSRF token mismatch.")
						You've been redirected here due to the following error: "{{ $message }}".&nbsp; Likely this
						was caused due to inactivity, welcome back!
					@elseif (isset($message))
						You've been redirected here due to the following error: "{{ $message }}".  If this was
						unexpected please send a quick e-mail to {{ env('WEBMASTER') }}.
				@endif
				</div>
			</div>
			
			<!-- TODO home.blade.php
			<br>
			<div class="card">
				<div class="card-header">
					Notes
				</div>
				<div class="card-body">
					at_isAdmin
						<p>
							As an Admin you have full access to all capabilities of this website, including all permissions granted
							to 'Reviewer' and 'Verified' users.
						</p>
					at_else
						at_isVerified
						<p>
							As a Verified user, you can now
						at_else
							<p>
								Once you verify your e-mail address with this system (check your e-mail) you'll be able to
						at_endisVerified
								log into additional Social Providers (Google, etc) to incorporate streamlined features of these providers into
								this web application
						at_isVerified
								by clicking on 'Social Login' under '{ { Auth::user()->firstname } }' in the
								top Navigation Bar.
							</p>
						at_else
							.
							</p>
						at_endisVerified
					at_endisAdmin
				</div>
			</div>
			-->
		</div>
	</div>
@endsection