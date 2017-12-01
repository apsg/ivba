@if($errors->count() > 0)
	
	<section>
		<div class="box box-danger">
	        <div class="box-header with-border">
	          <h3 class="box-title">Wystąpiły błędy przy zapisywaniu:</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	        	<ul>
	          	@foreach($errors->all() as $error)
	          		<li>{{$error}}</li>
          		@endforeach
	          	</ul>	
	        </div><!-- /.box-body -->
	    </div>

	</section>

@endif