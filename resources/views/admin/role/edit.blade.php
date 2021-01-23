@extends('_layouts.app')

@section('content')
    @isAdmin
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
	                <div style="font-size: x-large; padding-bottom: 10px; text-align: center">
		                Website Administration Subsite
	                </div>
                    <div class="card">
	                    <div class="card-header" style="font-size: medium">
                            Edit '{{ $role->description }}' User Role
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
                            <form action="{{ route('roles.update', $role->id) }}" method="post">
	                            @method('PUT')
                                @csrf
	                            <!-- START - Hidden Form to transmit $role->id -->
	                            <input id="id" name="id" type="hidden" value="{{ $role->id }}">
		                        <!-- END - Hidden Form -->
	                            <!-- START - Name -->
	                            <div class="form-group row">
		                            <label for="name" class="col-md-2 col-form-label text-md-right">
			                            Name
		                            </label>
		                            <div class="col-md-auto">
			                            <input id="name" name="name" type="text" class="form-control"
			                                   value="{{ old('name', $role->name) }}" autofocus>
		                            </div>
	                            </div>
	                            <!-- END - Name -->
	                            <!-- START - Description -->
	                            <div class="form-group row">
		                            <label for="description" class="col-md-2 col-form-label text-md-right">
			                            Description
		                            </label>
		                            <div class="col-md-auto">
			                            <input id="description" name="description" type="text" class="form-control"
			                                   value="{{ old('description', $role->description) }}">
		                            </div>
	                            </div>
	                            <!-- END - Description -->
	                            <!-- START - Active -->
	                            <div class="form-group row">
		                            <label for="active" class="col-md-2 col-form-label text-md-right">
			                            Active
		                            </label>
		                            <div class="col-md-auto">
			                            <select id="active" name="active" class="form-control-sm form-text">
				                            @if(isset($role->active) && $role->active)
					                            <option value="1" selected>Yes</option>
					                            <option value="0">No</option>
				                            @else
					                            <option value="1">Yes</option>
					                            <option value="0" selected>No</option>
				                            @endif
			                            </select>
		                            </div>
	                            </div>
	                            <!-- END - Active -->
	                            <!-- START - Protected -->
	                            <div class="form-group row">
		                            @isDeveloper
			                            <label for="protected" class="col-md-2 col-form-label text-md-right">
				                            Protected
			                            </label>
			                            <div class="col-md-auto">
				                            <select id="protected" name="protected" class="form-control-sm form-text">
					                            @if(isset($role->protected) && $role->protected)
						                            <option value="1" selected>Yes</option>
						                            <option value="0">No</option>
					                            @else
						                            <option value="1">Yes</option>
						                            <option value="0" selected>No</option>
					                            @endif
				                            </select>
			                            </div>
		                            @else
			                            <label for="protected" class="col-md-2 col-form-label text-md-right">
				                            Protected
			                            </label>
				                            <div class="form-text">
					                            @if(isset($role->protected) && $role->protected)
						                            Yes
					                            @else
													No
					                            @endif
				                            </div>
									@endisDeveloper
	                            </div>
	                            <!-- END - Protected -->
	                            <!-- START - Notes -->
	                            <div class="form-group row">
		                            <label for="notes" class="col-md-2 col-form-label text-md-right">
			                            Notes
		                            </label>
		                            <div class="col-md-10">
			                            <input id="notes" name="notes" type="text" class="form-control"
			                                   value="{{ old('notes', $role->notes) }}">
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
			                            <a href="{{ route('roles.edit', $role->id) }}" class="btn-sm btn-secondary">
				                            Reset Values
			                            </a>
		                            </span>
		                            <span style="padding-left: 5px; padding-right: 5px">
			                            <a href="{{ route('roles.index') }}" class="btn-sm btn-dark">
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
    @endisAdmin
@endsection