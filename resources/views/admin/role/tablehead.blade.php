<tr style="border-bottom: 1px solid black">
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Role Description
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Active
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		Protected
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px; max-width: 600px">
		Notes
	</th>
	@if (Route::current()->getName() != 'roles.edit')
		<th colspan="2" style="font-size: medium; text-align: center">
            Actions
		</th>
	@endif
</tr>