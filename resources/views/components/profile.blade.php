
<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
	<div>
		Name
	</div>
</th>
<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
	<div align="center">
		Avatar
	</div>
</th>
<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
	<div align="center">
		Rating
	</div>
</th>
<th style="font-size: medium; padding-left: 10px; padding-right: 10px">
	<div align="center">
		Visible
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

@foreach($profiles as $profile)
	@if($profile->active)
		<tr>
	@else
		<tr style="background-color: lightgrey">
	@endif
		<td style="padding-left: 10px; padding-right: 10px">
			<div>
				{{ $profile->name }}
			</div>
		</td>
		<td style="padding-left: 10px; padding-right: 10px">
			@if(isset($profile->avatar))
				<div align="center">
					<img src="{{ asset('storage/'.$profile->avatar) }}" style="width: 40px; height: 40px; border-radius: 50%">
				</div>
			@else
				<div align="center">
					Not Set
				</div>
			@endif
		</td>
		<td style="padding-left: 10px; padding-right: 10px">
			<div align="center">
				@if(isset($profile->rating))
					{{ $profile->rating }}
				@else
					Provisional
				@endif
			</div>
		</td>
		<td style="padding-left: 10px; padding-right: 10px">
			<div align="center">
				@if($profile->visible)
					Yes
				@else
					No
				@endif
			</div>
		</td>
		<td style="padding-left: 10px; padding-right: 10px">
			<div align="center">
				<select id="active" name="active" class="form-control-sm form-text">
					@if($profile->active)
						<option value="1"
						        {{ old('active') == 1 ? 'selected' : '' }} selected>
							Yes
						</option>
						<option value="0"
								{{ old('active') == 0 ? '' : 'selected' }}>
							No
						</option>
					@else
						<option value="1"
								{{ old('active') == 1 ? 'selected' : '' }}>
							Yes
						</option>
						<option value="0"
						        {{ old('active') == 0 ? '' : 'selected' }} selected>
							No
						</option>
					@endif
				</select>
			</div>
		</td>
		<td style="padding-left: 10px; padding-right: 10px">
			<div>
				{{ $profile->notes }}
			</div>
		</td>
	</tr>
@endforeach