@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-auto">
				<div class="card">
					<div class="card-header" style="font-size: medium">
                        <span>
	                        {{ $user->displayname }}'s Profiles
                        </span>
						<span class="float-lg-right">
							@if(count($profiles) < $profilesMax)
			                    <a class="btn-sm btn-primary" style="color: white; cursor: pointer" href="{{ route
			                    ('profiles.create') }}">
				                    Create New Profile
			                    </a>
							@else
							<div style="color: gray">
								Maximum: {{ $profilesMax }} Profiles
							</div>
							@endif
	                    </span>
					</div>
					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						@if(count($profiles) == 0)
							<div>
								Hi {{ $user->displayname }}, right now don't have any profiles set
								up.&nbsp; To create one, click the 'New Profile' button.  Note you can
								have up to 10 unique profiles on your account.
							</div>
						@else
							<form action="{{ route('profiles.show', $profiles[0]->id) }}" method="GET"
							      enctype="multipart/form-data">
								@method('put')
							@csrf
								<table>
									@include('profile.tablehead')
									@foreach($profiles as $profile)
										<tr style="border-bottom: 1px solid lightgray">
											<td style="padding: 10px">
												{{ $profile->name }}
											</td>
											<td align="center" style="padding-left: 10px; padding-right: 10px">
												@if(isset($profile->avatar))
													<div align="center">
														<img src="{{ asset('storage/'.$profile->avatar) }}" style="width: 40px; height: 40px; border-radius: 50%">
													</div>
												@else
													Not Set
												@endif
											</td>
											<td align="center" style="padding-left: 10px; padding-right: 10px">
												@if(isset($profile->rating))
													{{ $profile->rating }}
												@else
													Provisional
												@endif
											</td>
											<td align="center" style="padding-left: 10px; padding-right: 10px">
												@if($profile->visible)
													Yes
												@else
													No
												@endif
											</td>
											<td align="center" style="padding-left: 10px; padding-right: 10px">
												@if($profile->active)
													Yes
												@else
													No
												@endif
											</td>
											<td style="min-width: 250px; padding-left: 10px; padding-right: 10px">
												{{ $profile->notes }}
											</td>
											<td style="padding: 5px">
												<button class="btn-sm btn-secondary" type="submit" name="id" id="id"
												        value="{{ $profile->id }}">
													Edit
												</button>
											</td>
											<td style="padding: 5px">
												<a href="{{ route('profiles.delete', $profile->id) }}"
												   class="btn-sm btn-danger">
													Delete
												</a>
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
@endsection