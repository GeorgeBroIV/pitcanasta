<div>
	@if($model == 'Profile')
		@include('components.profile')
	@elseif($model == 'Role')
		@include('components.role')
	@elseif($model == 'Message')
		<br>
		<div class="col-md-auto">
			Message Area Coming Soon!
		</div>
	@else
		Hi No Model
	@endif
</div>