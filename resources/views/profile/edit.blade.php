@extends('_layouts.app')

@section('content')
	@isVerified
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="card">
					<div class="card-header" style="font-size: medium">
						Edit your Profile&nbsp; '{{ $profile->name }}'
					</div>
					<div class="col-12">
						@if ($errors->any())
							<br>
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
					</div>
					<div class="card-body">
						<form action="{{ route('profiles.update', $profile->id) }}" method="post" role="form"
						      enctype="multipart/form-data">
							@method('PUT')
							@csrf
							<!-- START - Hidden Form to transmit $profile->id -->
								<input id="id" name="id" type="hidden" value="{{ $profile->id }}">
							<!-- END - Hidden Form -->
							<!-- START - Name -->
							<div class="form-group row">
								<label for="name" class="col-md-2 col-form-label text-md-right">
									Name
								</label>
								<div class="col-md-auto">
									<input id="name" name="name" type="text" class="form-control"
									       value="{{ old('name', $profile->name) }}" disabled>
								</div>
							</div>
							<!-- END - Name -->
							<!-- START - Avatar -->
							<div class="form-group row">
								@if ($profile->avatar)
									<div class="col-md-2 text-md-right">
										<img src="{{ asset('storage/'.$profile->avatar) }}" style="width: 40px; height:
										40px; border-radius: 50%">
									</div>
									<span class="form-text col-auto">
                                        <label for="avatar" style="cursor: pointer" class="btn-sm
                                        btn-secondary">
	                                        Change
                                        </label>
                                        <input id="avatar" type="file" class="form-control" name="avatar" style="visibility: hidden; opacity: 0; position: absolute; z-index: -1">
										&nbsp;&nbsp;
										or
										&nbsp;&nbsp;
                                        <label for="avatarDelete">
	                                        Delete
                                        </label>
										&nbsp;
										<input id="avatarDelete" name="avatarDelete" type="checkbox">
                                    </span>
								@else
									<label for="avatar" class="col-md-2 col-form-label text-md-right">
										Avatar
									</label>
									<div class="col-md-auto">
										<input id="avatar" type="file" class="form-control" name="avatar">
									</div>
								@endif
							</div>
							<!-- END - Avatar -->
							<!-- START - Visible -->
							<div class="form-group row">
								<label for="visible" class="col-md-2 col-form-label text-md-right">
									Visible
								</label>
								<div class="col-md-auto">
									<select id="visible" name="visible" class="form-control-sm form-text">
										@if(isset($profile->visible) && $profile->visible)
											<option value="1"
											        {{ old('active') == 1 ? 'selected' : '' }} selected>
												Yes
											</option>
											<option value="0"
											        {{ old('active') == 0 ? 'selected' : '' }}>
												No
											</option>
										@else
											<option value="1"
											        {{ old('active') == 1 ? 'selected' : '' }}>
												Yes
											</option>
											<option value="0"
											        {{ old('active') == 0 ? 'selected' : '' }} selected>
												No
											</option>
										@endif
									</select>
								</div>
							</div>
							<!-- END - Visible -->
							<!-- START - Notes -->
							<div class="form-group row">
								<label for="notes" class="col-md-2 col-form-label text-md-right">
									Notes
								</label>
								<div class="col-md-8">
									<input id="notes" name="notes" type="text" class="form-control"
									       value="{{ old('notes', $profile->notes) }}" autofocus>
								</div>
							</div>
							<!-- END - Notes -->
							<!-- START - Form Buttons -->
							<div align="center" style="padding-top: 20px">
		                            <span style="padding-left: 5px; padding-right: 5px">
			                            <button type="submit" class="btn-sm btn-primary" style="cursor: pointer">
				                            Save Changes
			                            </button>
		                            </span>
								<span style="padding-left: 5px; padding-right: 5px">
		                            <a href="{{ route('profiles.edit', $profile->id) }}" class="btn-sm btn-secondary">
			                            Reset Values
		                            </a>
	                            </span>
								<span style="padding-left: 5px; padding-right: 5px">
		                            <a href="{{ route('profiles.index') }}" class="btn-sm btn-dark">
			                            Cancel and Exit
		                            </a>
	                            </span>
							</div>
							<!-- END - Form Buttons -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endisVerified
@endsection