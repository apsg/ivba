<a href="{{ $proof->url }}">
<div class="proof">
	<div class="proof-icon">
		<i class="fa fa-check"></i>
	</div>
	<div class="proof-body">
		<div class="proof-title">
			<strong>{{ $proof->name }}</strong> 
			@if(!empty($proof->city)) ({{ $proof->city }}) @endif
		</div>	
		<div class="proof-text">{{ $proof->body }}</div>
		<div class="proof-meta">{{ $proof->created_at->diffForHumans() }}</div>
	</div>
</div>
</a>