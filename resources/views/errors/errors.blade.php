<div class="flash-message flash-message-padding">
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
	  @if(Session::has('alert-' . $msg))
	  <p class="alert alert-{{ $msg }}">{!! Session::get('alert-' . $msg) !!} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
	  @endif
	@endforeach
</div>

@if($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $key => $error )
				<li id="field_{{ $errors->keys()[$key] }}" class="has-error">{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif