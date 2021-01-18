@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						{{ $user->displayname }}'s Dashboard
					</div>
					<div class="card-body">
					<p>
						When developed, this dashboard will display real-time statistics including: total number
						of registered users; number of currently logged-in users; chatroom statistics; new
						messageboard messages since your last visit; etc.
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection