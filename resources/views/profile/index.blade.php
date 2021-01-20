@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" style="font-size: medium">
						{{ $user->displayname }}'s Profiles
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
									@if(count($profiles) == 0)
										<div>
											Hi {{ $user->displayname }}, right now don't have any profiles set
											up.&nbsp; To create one, click the 'New Profile' button.  Note you can
											have up to 10 unique profiles on your account.
										</div>
									@else
										<form action="{{ route('profile.edit') }}" method="POST" role="form"
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
												@foreach($profiles as $profile)
													<tr>
														<td>
															{{ $profile->name }}
														</td>
														<td>
															{{ $profile->avatar }}
														</td>
														<td>
															{{ $profile->rating }}
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