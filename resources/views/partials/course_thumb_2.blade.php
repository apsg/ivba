<li class="col-sm-4">
	<div class="overly">
	  <div class="cnt-block">
	    <h3>{{$course->title}}</h3>
	    <p>{{ $course->excerpt }}</p>
	  </div>
	  <a href="{{ $course->link() }}" class="more"><i class="fa fa-caret-right" aria-hidden="true"></i></a> </div>
	<figure><img src="{{ $course->image->thumb(360, 240) }}" class="img-responsive" alt=""></figure>
</li>