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
	                    <span>
							{{ $user->username }}'s Account Settings
	                    </span>
					</div>
					<div class="card-body">
						<form action="{{ route('users.index', $user->id) }}" method="get">
							<div>
							@method('put')
							@csrf
							<!-- START - User Information -->
							<table>
								@include('admin.user.tablehead')
								<tr style="border-bottom: 1px solid lightgray">
									<td style="padding: 10px">
										{{ $user->username }}
									</td>
									<td style="padding: 10px">
										{{ $user->firstname }}
									</td>
									<td style="padding: 10px">
										{{ $user->lastname }}
									</td>
									<td style="padding: 10px">
										{{ $user->displayname }}
									</td>
									<td style="padding: 10px">
										{{ $user->email }}
									</td>
									<td style="padding: 10px" align="center">
										@if($user->hasVerifiedEmail())
											Yes
										@else
											No
										@endif
									</td>
									<td style="padding: 10px" align="center">
										<select id="visible" name="visible" class="form-control-sm form-text">
											@if($user->active)
												<option value="1" selected>Yes</option>
												<option value="0">No</option>
											@else
												<option value="1">Yes</option>
												<option value="0" selected>No</option>
											@endif
										</select>
									</td>
								</tr>
								<!-- START - Notes -->
								<tr style="padding-top: 10px; border-bottom: 1px solid lightgray">
									<th align="middle" style="font-size: medium; padding: 10px">
										<label for="notes">
											Notes
										</label>
									</td>
									<td colspan="6" style="padding: 10px">
										<input id="notes" name="notes" type="text" class="form-control"
										       value="{{ old('notes', $user->notes) }}" autofocus>
									</td>
								</tr>
								<!-- END - Notes -->
							</table>
							</div>
							<br>
							<!-- END - User Information -->
							<!-- START - User Roles -->
							<div class="card-header" style="font-size: medium">
			                    <span>
									Roles assigned to {{ $user->username }}
			                    </span>
							</div>
							<table class="table" align="center">
								<tr>
									<th style="font-size: medium; padding-left: 10px; padding-right:
									10px">
										<div>
											Role
										</div>
									</th>
									<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
										<div align="center">
											Active
										</div>
									</th>
									<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
										<div>
											Notes
										</div>
									</th>
									<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
										<div align="center">
											Assigned
										</div>
									</th>
								</tr>
								@foreach($roles as $role)
									@if($role->active)
										<tr>
									@else
										<tr style="background-color: lightgrey">
									@endif
									
										<td style="padding-left: 10px; padding-right: 10px">
											<div>
												<label for="{{ $role->description }}">
													{{ $role->description }}
												</label>
											</div>
										</td>
										<td style="padding-left: 10px; padding-right: 10px">
											<div align="center">
												<label for="{{ $role->active }}">
													@if($role->active)
														Yes
													@else
														No
													@endif
												</label>
											</div>
										</td>
										<td style="padding-left: 10px; padding-right: 10px; max-width: 550px">
											<div align="left">
												<label for="{{ $role->notes }}">
													{{ $role->notes }}
												</label>
											</div>
										</td>
										<td style="padding-left: 10px; padding-right: 10px">
											<div align="center">
												<select id="visible" name="visible" class="form-control-sm form-text">
													@if(in_array($role->name, $userRoles))
														<option value="1" selected>Yes</option>
														<option value="0">No</option>
													@else
														<option value="1">Yes</option>
														<option value="0" selected>No</option>
													@endif
												</select>
											</div>
										</td>
									</tr>
								@endforeach
							</table>
							<!-- END - User Roles -->
							<hr>
							<div align="center">
	                            <span style="padding-left: 5px; padding-right: 5px">
		                            <button type="submit" class="btn-sm btn-primary" style="cursor: pointer">
			                            Save Changes
		                            </button>
	                            </span>
								<span style="padding-left: 5px; padding-right: 5px">
		                            <a href="{{ route('users.show', $user->id) }}" class="btn-sm btn-secondary">
			                            Reset Values
		                            </a>
                                </span>
								<span style="padding-left: 5px; padding-right: 5px">
		                            <a href="{{ route('users.index') }}" class="btn-sm btn-dark">
			                            Cancel and Exit
		                            </a>
								</span>
							</div>
							<div class="text-danger" align="middle" style="padding-top: 10px">
								The 'Save' button is not yet working, and will simply take you back to the 'Web
								Application Users' page.
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endisAdmin
@endsection
