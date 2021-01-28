@extends('_layouts.app')

@section('title', 'Admin - Account Settings')

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
										<select id="active" name="active" class="form-control-sm form-text">
											@if($user->active)
												<option value="1"
												        {{ old('active') == 1 ? 'selected' : '' }} selected>
													Yes
												</option>
												<option value="0"
												        {{ old('active') == 0 ? '' : 'selected' }}>
													No
												</option>
											@else
												<option value="1"
												        {{ old('active') == 1 ? 'selected' : '' }}>
													Yes
												</option>
												<option value="0"
												        {{ old('active') == 0 ? '' : 'selected' }} selected>
													No
												</option>
											@endif
										</select>
									</td>
								</tr>
								<!-- START - Notes -->
								<tr style="padding-top: 10px; border-bottom: 1px solid lightgray">
									<th align="middle" style="font-size: medium; padding: 10px">
										<label for="notes">
											Admin Notes
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
							
							&nbsp;&nbsp;
							<span>
								@if($model == 'Role')
									<span>
										Roles
									</span>
								@else
									<a href="{{ route('users.show', $user->id.'-role') }}" class="btn-sm btn-primary">
										Roles
									</a>
								@endif
							</span>
							&nbsp;&nbsp;
							<span>
								@if($model == 'Profile')
									<span>
										Profiles
									</span>
								@else
									<a href="{{ route('users.show', $user->id.'-profile') }}" class="btn-sm btn-primary">
										Profiles
									</a>
								@endif
							</span>
							&nbsp;&nbsp;
							<span>
								@if($model == 'Message')
									<span>
										Messages
									</span>
								@else
									<a href="{{ route('users.show', $user->id.'-message') }}" class="btn-sm btn-primary">
										Messages
									</a>
								@endif
							</span>
							<hr>
							<!-- START - User Data -->
							<div class="card-header" style="font-size: medium">
			                    <span>
									{{ $user->username }}'s {{ $model }}s
			                    </span>
							</div>
							<table class="table" align="center">
							
							<!-- START - User Data -->
								<x-dataview modelName="{{ $model }}"  id="{{ $user->id }}"/>
							<!-- END - User Data -->
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
		                            <a href="{{ route('users.show', [$user->id . '-' . $model]) }}" class="btn-sm btn-secondary">
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
