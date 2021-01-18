@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<div class="flex-center position-ref full-height">
							<div class="content">
								<div>
									<a href="{{ route('home') }}">
										<img class="card-img" src="{{ asset('storage/website/images/PitCanasta_Logo.svg') }}">
									</a>
								</div>
								<div class="title m-b-md">
									<div style="font-size: 25px; margin-top: 10px; margin-bottom: 10px" align="center">
										UNDER DEVELOPMENT
									</div>
									<div class="title m-b-md" style="text-align: center; margin-left: 25px; margin-right:
									 25px; font-size: 17px; color:gray">
										This website is not yet optmimized for mobile and smaller devices, and is best viewed on a
										computer.
									</div>
								</div>
								<div class="flex-center" style="text-align:left; margin: 25px">
									Once complete this web application will host a fully functioning online multi-player canasta card
									game that is similar in feel to Yahoo's (now decommissioned) Canasta game site.
									<br><br>
									We will first develop a chatroom and message board for friends and new players to chat and post
									messages.&nbsp; Next we will develop the game lobbies which will have their own chat section and
									show the card tables.  Later we will develop the actual game tables for 2 and 4 player canasta
									games, similar in style the Yahoo Canasta card tables that we grew to know and love.
									<br><br>
									Future developments may include rated and non-rated games, multiple id's with id-specific
									avatars and ratings, table kibitzing, the ability to go invisibile, ability to block chat
									messages from bothersome players, ability to create public or private tables, game leagues, etc
									.&nbsp; Once this is complete and operational, other card games may follow depending on player
									interest.
									<br><br>
									A lot of functionality will come from ideas and suggestions from people like you!&nbsp;
									So if you have any thoughts please post a message on the 'Features Wish List' message board once
									this is available.
								</div>
								<div class="linksMain" style="font-size: 25px" align="center">
									@auth
										Click <a href="{{ route('home') }}">Home</a> to continue your
										experience!
									@else
										<a href="{{ route('login') }}">Login</a>
										or
										<a href="{{ route('register') }}">Sign Up</a> to start your
										experience!
									@endauth
								</div>
								<br>
								<div class="flex-center">
									Issues logging in or signing up? &nbsp;Click
									<a href="mailto:webmaster@pitcanasta.com?subject=Pit%20Canasta%20Login%20Issues">
										Webmaster
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection