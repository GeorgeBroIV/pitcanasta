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
		Active
	</th>

	@if (Route::current()->getName() == 'users.index')
		<th colspan="2" style="font-size: medium; padding-left: 10px; padding-right: 10px">
            <div align="center">
	            Views
            </div>
		</th>
	@endif
</tr>
