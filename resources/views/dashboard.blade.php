@extends('_layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" style="font-size: medium">
						{{ $user->displayname }}'s Dashboard
					</div>
					<div style="padding-top: 10px" class="col-md-auto">
						When developed, this dashboard will display real-time statistics including: total number
						of registered users; number of currently logged-in users; chatroom statistics; new
						messageboard messages since your last visit; etc.
					</div>
					<div class="card-body">
						<table align="center">
							<tr>
								<td style="padding-right: 20px">
									<!-- START - User Roles -->
									<table class="table-bordered">
										<tr>
											<th style="font-size: medium; padding: 10px">
												User Status
											</th>
											<th style="font-size: medium; padding: 10px">
												No.
											</th>
										</tr>
										<tr>
											<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
												Registered Users
											</td>
											<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
												<div align="center">
													{{ $userCount }}
												</div>
											</td>
										</tr>
										<tr>
											<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
												Verified Users
											</td>
											<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
												<div align="center">
													{{ $usersVerifiedCount }}
												</div>
											</td>
										</tr>
										<tr>
											<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
												Invisible Users
											</td>
											<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
												<div align="center">
													{{ $usersInvisibleCount }}
												</div>
											</td>
										</tr>
									</table>
								</td>
								<td style="padding-left: 20px">
									<!-- START - User Roles -->
									<table class="table-bordered">
										<tr>
											<th style="font-size: medium; padding: 10px">
												Users with Role
											</th>
											<th style="font-size: medium; padding: 10px">
												<div align="center">
													No.
												</div>
											</th>
										</tr>
										@foreach($roleCounts as $key => $roleCount)
											<tr>
												<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
													{{ $key }}s
												</td>
												<td style="padding-left: 10px; padding-right: 10px; padding-top: 5px;
										padding-bottom: 5px">
													<div align="center">
														{{ $roleCount }}
													</div>
												</td>
											</tr>
										@endforeach
									</table>
									<!-- END - User Roles -->
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection