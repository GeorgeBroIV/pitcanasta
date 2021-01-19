@extends('_layouts.app')

@section('content')
    @hasRole('Admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-auto">
	            <div style="font-size: x-large; padding-bottom: 10px" align="center">
		            Website Administration Subsite
	            </div>
                <div class="card">
                    <div class="card-header">
                        Web Application Users
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @method('edit')
                            @csrf
                            <table>
                                @include('admin.user.tablehead')
                                @foreach($users as $user)
                                    <tr>
	                                    <td style="padding-left: 10px; padding-right: 10px">
		                                    {{ $user->username }}
	                                    </td>
                                        <td style="padding-left: 10px; padding-right: 10px">
                                            {{ $user->firstname }}
                                        </td>
                                        <td style="padding-left: 10px; padding-right: 10px">
                                            {{ $user->lastname }}
                                        </td>
	                                    <td style="padding-left: 10px; padding-right: 10px">
		                                    {{ $user->displayname }}
	                                    </td>
                                        <td style="padding-left: 10px; padding-right: 10px">
                                            {{ $user->email }}
                                        </td>
	                                    <td style="padding-left: 10px; padding-right: 10px" align="center">
		                                    @if($user->hasVerifiedEmail())
			                                    Yes
			                                @else
				                                No
			                                @endif
	                                    </td>
                                        <td align="center">
	                                        <a class="btn btn-link" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endhasRole
@endsection
