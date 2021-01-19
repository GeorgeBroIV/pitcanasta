<tr style="border-bottom: 1px solid black">
	<th style="padding-left: 10px; padding-right: 10px">
		User Name
	</th>
	<th style="padding-left: 10px; padding-right: 10px">
		First Name
	</th>
	<th style="padding-left: 10px; padding-right: 10px">
		Last Name
	</th>
	<th style="padding-left: 10px; padding-right: 10px">
		Display Name
	</th>
	<th style="padding-left: 10px; padding-right: 10px">
		E-mail
	</th>
	<th style="padding-left: 10px; padding-right: 10px">
		Verified
	</th>
	@if (Route::current()->getName() != 'users.index')
		<th align="center" style="padding-left: 10px; padding-right: 10px">
			Active
		</th>
		<th align="center" style="padding-left: 10px; padding-right: 10px">
			Visible
		</th>
		@foreach($roles as $role)
			<th align="center" colspan="{ { count($roles) }}"style="padding-left: 5px; padding-right: 5px">
                {{ $role->Description }}
			</th>
        @endforeach
	@endif
	
	@if (Route::current()->getName() != 'users.edit')<th align="center" style="padding-left: 10px; padding-right: 10px">
        Action
	@endif
    </th>
</tr>
