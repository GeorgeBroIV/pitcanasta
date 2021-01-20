@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" style="font-size: medium">
						Game Table Profiles
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
									@if(count($profileGames) == 0)
										<div>
											Hi {{ $user->displayname }}, right now don't have any game table profiles
											(game id's) set up.&nbsp;  To create one, click the 'New Game Table
											Profile' button.  Note you can have up to 10 unique game profiles on your
											account.
										</div>
									@else
										<form action="{{ route('profilegame.edit') }}" method="POST" role="form"
										      enctype="multipart/form-data">
										@csrf
											<table class="table-bordered">
												<tr>
													<th>
														Name
													</th>
													<th>
														Avatar
													</th>
													<th>
														Rating
													</th>
													<th>
														Action
													</th>
												</tr>
												@foreach($profileGames as $profileGame)
													<tr>
														<td>
															{{ $profileGame->name }}
														</td>
														<td>
															{{ $profileGame->avatar }}
														</td>
														<td>
															{{ $profileGame->rating }}
														</td>
														<td>
															<button>Edit</button>
														</td>
													</tr>
												@endforeach
											</table>
										</form>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection