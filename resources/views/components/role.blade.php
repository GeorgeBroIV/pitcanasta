<tr>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		<div>
			Role
		</div>
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		<div align="center">
			Active
		</div>
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		<div>
			Notes
		</div>
	</th>
	<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
		<div align="center">
			Assigned
		</div>
	</th>
</tr>
@foreach($roles as $role)
	@if($role->active)
		<tr>
	@else
		<tr style="background-color: lightgrey">
	@endif
			<td style="padding-left: 10px; padding-right: 10px">
				<div>
					{{ $role->description }}
				</div>
			</td>
			<td style="padding-left: 10px; padding-right: 10px">
				<div align="center">
					@if($role->active)
						Yes
					@else
						No
					@endif
				</div>
			</td>
			<td style="padding-left: 10px; padding-right: 10px; max-width: 550px">
				<div align="left">
					{{ $role->notes }}
				</div>
			</td>
			<td style="padding-left: 10px; padding-right: 10px">
				<div align="center">
					<select id="{{ 'role.' . $role->id }}" name="{{ 'role.' . $role->id }}" class="form-control-sm form-text">
						@if(in_array($role->name, $userRoles))
							<option value="1"
							        {{ old('role.' . $role->id) == 1 ? 'selected' : '' }} selected>
								Yes
							</option>
							<option value="0"
									{{ old('role.' . $role->id) == 0 ? '' : 'selected' }}>
								No
							</option>
						@else
							<option value="1"
									{{ old('role.' . $role->id) == 1 ? 'selected' : '' }}>
								Yes
							</option>
							<option value="0"
							        {{ old('role.' . $role->id) == 0 ? '' : 'selected' }} selected>
								No
							</option>
						@endif
					</select>
				</div>
			</td>
		</tr>
		@endforeach