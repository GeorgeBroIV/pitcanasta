<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Pit Canasta</title>
		
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		
		<!-- Styles -->
		<style>
			html, body {
				background-color: #fff;
				color: #636b6f;
				font-family: 'Nunito', sans-serif;
				font-weight: 200;
				height: 100vh;
				margin: 0;
			}
			
			.full-height {
				height: 100vh;
			}
			
			.flex-center {
				align-items: center;
				display: flex;
				justify-content: center;
			}
			
			.position-ref {
				position: relative;
			}
			
			.top-right {
				position: absolute;
				right: 10px;
				top: 18px;
			}
			
			.content {
				text-align: center;
			}
			
			.title {
				font-size: 84px;
			}
			
			.links > a {
				color: #636b6f;
				padding: 0 25px;
				font-size: 13px;
				font-weight: 600;
				letter-spacing: .1rem;
				text-decoration: none;
				text-transform: uppercase;
			}
			
			.linksMain > a {
				color: #636b6f;
				font-size: 25px;
				text-decoration: none;
			}
			
			.m-b-md {
				margin-bottom: 30px;
			}
		</style>
	</head>
	<body>
		<div class="flex-center position-ref full-height">
			@if (Route::has('login'))
				<div class="top-right links">
					@auth
						<a href="{{ url('/home') }}">Home</a>
					@else
						<a href="{{ url('/home') }}">Login</a>
						
						@if (Route::has('register'))
							<a href="{{ route('register') }}">Sign Up</a>
						@endif
					@endauth
				</div>
			@endif

			<div class="content">
				<img src="{{ asset('storage/website/images/PitCanasta_Logo.svg') }}">
				<div class="title m-b-md">
					<div style="font-size: 25px">
						UNDER DEVELOPMENT
					</div>
					<div style="font-size: 20px">
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
				<br>
				<div class="linksMain" style="font-size: 25px">
					@auth
						Click <a href="{{ url('/home') }}">Home</a> to continue your experience!
					@else
						<a href="{{ url('/home') }}">Login</a>
						
						@if (Route::has('register'))
							or <a href="{{ route('register') }}">Sign Up</a> to start your experience!
						@endif
					@endauth
				</div>
				<br>
				<div class="flex-center">
					Issues logging in or signing up? &nbsp;Click&nbsp;
					<a href="mailto:webmaster@pitcanasta.com?subject=Pit%20Canasta%20Login%20Issues">
						Webmaster
					</a>
				</div>
			</div>
		</div>
	</body>
</html>