<tr style="border-bottom: 1px solid black">
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		User Name
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		First Name
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Last Name
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Display Name
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		E-mail
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Verified
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Verified
	</th>

	<!-- START - Roles -->
	@if (Route::current()->getName() != 'users.index')
		<th align="center" style="font-size: medium; padding-left: 10px; padding-right: 10px">
			Active
		</th>
		<th align="center" style="font-size: medium; padding-left: 10px; padding-right: 10px">
			Visible
		</th>
		@foreach($roles as $role)
			<th align="center" colspan="{ { count($roles) }}"style="font-size: medium; padding-left: 5px; padding-right: 5px">
                {{ $role->Description }}
			</th>
        @endforeach
	@endif
	<!-- END - Roles -->

	@if (Route::current()->getName() != 'users.edit')
		<th align="center" style="font-size: medium; padding-left: 10px; padding-right: 10px">
            Action
		</th>
	@endif
</tr>
