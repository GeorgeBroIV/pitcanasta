@extends('_layouts.app')

@section('title', 'Admin - Accounts')

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
	                        Web Application Accounts
	                    </div>
	                    <div class="card-body">
	                        <form action="{{ route('users.update', $users[0]->id) }}" method="get">
	                            @method('put')
	                            @csrf
	                            <table>
	                                @include('admin.user.tablehead')
	                                @foreach($users as $user)
			                            @if($user->active)
				                            <tr style="border-bottom: 1px solid lightgray">
			                            @else
				                            <tr style="background-color: lightgrey; border-bottom: 1px solid darkgrey">
			                            @endif
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
			                                    @if($user->active)
				                                    Yes
			                                    @else
				                                    No
			                                    @endif
		                                    </td>
	                                        <td align="center" style="padding-left: 5px; padding-right: 5px">
		                                        <a class="btn-sm btn-primary" href="{{ route('users.show', $user->id)
		                                        }}">
			                                        Roles
		                                        </a>
	                                        </td>
				                            <td align="center" style="padding-left: 5px; padding-right: 5px">
					                            <a class="btn-sm btn-primary" href="{{ route('users.show', $user->id)
					                            }}">
						                            Profiles
					                            </a>
				                            </td>
				                            <td align="center" style="padding-left: 5px; padding-right: 5px">
					                            <a class="btn-sm btn-primary" href="{{ route('users.show', $user->id)
				                            }}">
						                            Messages
					                            </a>
				                            </td>
	                                    </tr>
	                                @endforeach
	                            </table>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
    @endisAdmin
@endsection
