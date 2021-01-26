@extends('_layouts.app')

@section('content')
	@isVerified
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="card">
					<div class="card-header" style="font-size: medium">
						Create a new Profile
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
						<form action="{{ route('profiles.store') }}" method="post" role="form"
						      enctype="multipart/form-data">
						@csrf
						<!-- START - Name -->
							<div class="form-group row">
								<label for="name" class="col-md-2 col-form-label text-md-right">
									Name
								</label>
								<div class="col-md-auto">
									<input id="name" name="name" type="text" class="form-control"
									       value="{{ old('name', '') }}" autofocus>
								</div>
							</div>
							<!-- END - Name -->
							<!-- START - Avatar -->
							<div class="form-group row">
								<label for="avatar" class="col-md-2 col-form-label text-md-right">
									Avatar
								</label>
								<div class="col-md-auto">
									<input id="avatar" type="file" class="form-control" name="avatar">
								</div>
							</div>
							<!-- END - Avatar -->
							<!-- START - Description -->
							<div class="form-group row">
								<label for="description" class="col-md-2 col-form-label text-md-right">
									Description
								</label>
								<div class="col-md-auto">
									<input id="description" name="description" type="text" class="form-control"
									       value="{{ old('description', '') }}">
								</div>
							</div>
							<!-- END - Description -->
							<!-- START - Visible -->
							<div class="form-group row">
								<label for="visible" class="col-md-2 col-form-label text-md-right">
									Visible
								</label>
								<div class="col-md-auto">
									<select id="visible" name="visible" class="form-control-sm form-text">
										<option value="1" selected>Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<!-- END - Visible -->
							<!-- START - Notes -->
							<div class="form-group row">
								<label for="notes" class="col-md-2 col-form-label text-md-right">
									Notes
								</label>
								<div class="col-md-10">
									<input id="notes" name="notes" type="text" class="form-control" value="{{ old
									('notes', '') }}">
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
		                            <a href="{{ route('profiles.create') }}" class="btn-sm btn-secondary">
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