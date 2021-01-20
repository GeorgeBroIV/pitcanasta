@extends('_layouts.app')

@section('content')
	@isAdmin
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-auto">
				<div style="font-size: x-large; padding-bottom: 10px; text-align: center">
					Website Administration Subsite
				</div>
				<div class="card">
					<div class="card-header" style="font-size: medium">
						Show {{ $user->username }}'s Settings
					</div>
					<div class="card-body">
						<form action="" method="post">
							@method('edit')
							@csrf
							<table>
								@include('admin.user.tablehead')
									<tr>
										<td style="padding-left: 10px; padding-right: 10px">
											{{ $user->firstname }}
										</td>
										<td style="padding-left: 10px; padding-right: 10px">
											{{ $user->lastname }}
										</td>
										<td style="padding-left: 10px; padding-right: 10px">
											{{ $user->username }}
										</td>
										<td style="padding-left: 10px; padding-right: 10px">
											{{ $user->email }}
										</td>
										<td align="center" style="padding-left: 10px; padding-right: 10px">
											@if($user->active == 1)
												<div>
													Yes
												</div>
											@else
												<div>
													No
												</div>
											@endif
										</td>
										<td align="center" style="padding-left: 10px; padding-right: 10px">
											@if($user->visible == 1)
												<div>
													Yes
												</div>
											@else
												<div>
													No
												</div>
											@endif
										</td>
										@for($i = 0; $i < count($roles); $i++)
											<td align="center" style="padding-left: 5px; padding-right: 5px">
												@if(in_array($roles[$i]->name, $userRoles))
													@if($roles[$i]->active == 1)
														<div>
															Yes
														</div>
													@elseif($roles[$i]->active == 0)
														<div>
															-
														</div>
													@endif
												@else
													@if($roles[$i]->active == 1)
														<div>
															No
														</div>
													@elseif($roles[$i]->active == 0)
														<div>
															-
														</div>
													@endif
												@endif
											</td>
										@endfor
										<td align="center" style="padding-left: 10px; padding-right: 10px">
											Edit
										</td>
									</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endisAdmin
@endsection
