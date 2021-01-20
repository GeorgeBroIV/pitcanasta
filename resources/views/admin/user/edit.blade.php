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
                            Edit {{ $user->username }}'s Main Profile Settings
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                @method('edit')
                                @csrf
                                <table>
                                @include('admin.user.tablehead')
                                    <tr>
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
	                                    <td style="padding-left: 10px; padding-right: 10px" align="center">
		                                    @if($user->hasVerifiedEmail())
			                                    Yes
		                                    @else
			                                    No
		                                    @endif
	                                    </td>
	                                    <td align="center" style="padding: 10px">
                                            @if($user->active)
		                                        <input type="checkbox" id="" name="" value="" checked>
                                            @else
		                                        <input type="checkbox" id="" name="" value="">
                                            @endif
                                        </td>
	                                    <td align="center" style="padding: 10px">
	                                        @if($user->visible)
		                                        <input type="checkbox" id="" name="" value="" checked>
	                                        @else
		                                        <input type="checkbox" id="" name="" value="">
	                                        @endif
                                        </td>
                                        @for($i = 0; $i < count($roles); $i++)
		                                    <td align="center" style="padding: 10px">
			                                    @if($user->hasVerifiedEmail())
				                                    @if(in_array($roles[$i]->name, $userRoles))
				                                        @if($roles[$i]->active)
					                                        <input type="checkbox" id="" name="" value="" checked>
				                                        @else
					                                        <input type="checkbox" id="" name="" value="" disabled>
				                                        @endif
			                                        @else
				                                        @if($roles[$i]->active)
					                                        <input type="checkbox" id="" name="" value="">
				                                        @else
					                                        <input type="checkbox" id="" name="" value="" disabled>
				                                        @endif
			                                        @endif
			                                    @else
			                                        -
												@endif
	                                        </td>
                                        @endfor
                                    </tr>
	                            </table>
		                        <!-- Submit or Cancel -->
		                            <div align="center" style="padding-top: 20px">
			                            <span hidden style="padding-left: 5px; padding-right: 5px">
				                            <button type="submit" class="btn-sm btn-primary" style="cursor: pointer">
					                            Save Changes
				                            </button>
			                            </span>
			                            <span style="padding-left: 5px; padding-right: 5px">
				                            <a href="{{ route('users.index') }}" class="btn-sm btn-secondary">
					                            Cancel
				                            </a>
			                            </span>
		                            </div>
	                            <!-- END Submit or Cancel -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisAdmin
@endsection