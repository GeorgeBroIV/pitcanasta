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
	                        Web Application Users
	                    </div>
	                    <div class="card-body">
	                        <form action="" method="post">
	                            @method('edit')
	                            @csrf
	                            <table>
	                                @include('admin.user.tablehead')
	                                @foreach($users as $user)
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
	                                        <td align="center">
		                                        <a class="btn-sm btn-secondary" href="{{ route('users.edit', $user->id) }}">
			                                        Edit</a>
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
