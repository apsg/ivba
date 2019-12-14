<li class="col-sm-4">
	<div class="overly">
	  <div class="cnt-block">
	    <a href="{{ $lesson->link() }}"><h3>{{$lesson->title}}</h3>
	    <p>{{ $lesson->excerpt }}</p></a>
	  </div>
	  <a href="{{ $lesson->link() }}" class="more"><i class="fa fa-caret-right" aria-hidden="true"></i></a> </div>
	<figure><img src="{{ $lesson->image->thumb(360, 240) }}" class="img-responsive" alt=""></figure>
</li>