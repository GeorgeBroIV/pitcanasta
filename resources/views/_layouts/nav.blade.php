<div class="container">
	<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
		@if (Route::current()->getName() != 'welcome')
			<!-- WebApp Logo - link to homepage -->
			<a class="navbar-brand" href="{{ url('/welcome') }}">
				<img src="{{ asset('storage/website/images/PitCanasta_TopLogo.svg') }}" height="50px">
			</a>
		@endif
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- START - Left Side Of Navbar -->
				<!-- START - Registered Section -->
				<ul class="navbar-nav mr-auto">
					@auth
						<!-- Home -->
							<li class="nav-item">
								<a class="nav-link" href="{{ route('home') }}">
									{{ __('Home') }}
								</a>
							</li>
							<!-- END Home -->
							<!-- Dashboard -->
							<li class="nav-item">
								<a class="nav-link" href="{{ route('dashboard.index') }}">
									{{ __('Dashboard') }}
								</a>
							</li>
							<!-- END Dashboard -->
							<!-- START - Admin Settings -->
							@isAdmin
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
								   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<span class="caret">
		                                Admin
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('users.index') }}">
										{{ __('Users') }}
									</a>
									<a class="dropdown-item" href="{{ route('roles.index') }}">
										{{ __('User Roles') }}
									</a>
								</div>
							</li>
							@endisAdmin
						<!-- END - Admin Settings -->
					@endauth
				</ul>
				<!-- END - Registered Section -->
			<!-- END - Left Side of Navbar -->
			<!-- START - Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
				<!-- START - Guest Section (Login/Register) -->
					@guest
						@if (Route::current()->getName() != 'login')
							<li class="nav-item">
								<a class="nav-link" href="{{ route('login') }}">
									{{ __('Login') }}
								</a>
							</li>
						@else
							<li class="nav-item">
								<a class="nav-link" href="{{ route('register') }}">
									{{ __('Sign Up') }}
								</a>
							</li>
						@endif
					@endguest
				<!-- END - Guest Section -->
				<!-- START - Registered Section (Social Login / WebApp Logout) -->
					@auth
						<!-- START - User Settings -->
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									@if (auth()->user()->avatar)
										<img src="{{ asset('storage/'.auth()->user()->avatar) }}" style="width: 40px; height: 40px; border-radius: 50%;">
									@else
										<span class="caret">
		                                    {{ Auth::user()->firstname }}
		                                </span>
									@endif
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									@if (!Auth::user()->hasVerifiedEmail())
										<a class="dropdown-item" href="{{ route('verification.notice') }}">
											{{ __('Verify Email') }}
										</a>
									@endif
									@isVerified
										<a class="dropdown-item" href="{{ route('account.edit', auth()->user()->id) }}">
											{{ __('Account') }}
										</a>
										<a class="dropdown-item" href="{{ route('profiles.index') }}">
											{{ __('Profiles') }}
										</a>
									@endisVerified
									<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form').submit();">
										{{ __('Logout') }}
									</a>
									<form id="form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</li>
						<!-- END - User Settings -->
					@endauth
				<!-- END - Registered Section -->
				</ul>
			<!-- END - NavBar Right Side of Nav Bar -->
		</div>
	</nav>
</div>