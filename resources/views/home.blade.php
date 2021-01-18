@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						Home Page
					</div>
					<div class="card-body">
					<p>
						Hi {{ Auth::user()->firstname }}, you are now logged into the {{ env('APP_NAME') }} web
						application.
					</p>
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