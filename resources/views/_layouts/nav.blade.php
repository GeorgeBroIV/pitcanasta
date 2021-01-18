<div class="container">
	
	<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
		<!-- WebApp Logo - link to homepage -->
		@if (Route::current()->getName() != 'welcome')
			<a class="navbar-brand" href="{{ url('/welcome') }}">
		@endif
			<img src="{{ asset('storage/website/images/PitCanasta_TopLogo.svg') }}" height="50px">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon">
            </span>
		</button>
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
						<a class="nav-link" href="{{ route('dashboard') }}">
							{{ __('Dashboard') }}
						</a>
					</li>
					<!-- END Dashboard -->
			@endauth
			<!-- END - Registered Section -->
				<!-- START - Admin Section -->
			@isAdmin
			<!-- START - Users -->
				<!-- TODO: Implement Users and remove space between mustache braces
										<li>
											<a class="nav-link" href="{ { route('users.index') } }">
												{ { __('Users') } }
											</a>
										</li>
				-->
				<!-- END Users -->
				@endisAdmin
			</ul>
			<!-- END - Admin Section -->
			<!-- END Left Side of Navbar -->
			<!-- START - Right Side Of Navbar -->
			<!-- START - Guest Section (Login/Register) -->
			<!-- TODO: If on 'Login' page, hide 'Login' button.  If on 'Sign Up' page, hide 'Sign Up' button -->
			<ul class="navbar-nav ml-auto">
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
				<!-- END Guest Section -->
					<!-- START - Registered Section (Social Login / WebApp Logout) -->
				@auth
					<!-- User Settings -->
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
								<a class="dropdown-item" href="{{ route('profile') }}">
									{{ __('Profile') }}
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
						<!-- END User Settings -->
				@endauth
				<!-- END Verified Section -->
			</ul>
		</div>
	</nav>
</div>