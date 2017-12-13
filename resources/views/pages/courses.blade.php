@extends('layouts.front')

@section('content')


<!-- Start About Section -->
<section class="about inner padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="video-block">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/MEjwwe1jgFQ" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-md-7 left-block">
        <h2>Kategorie kursów</h2>
    <p>Z racji tego, że lekcji na naszej platformie jest ponad 200 zostały one podzielone na kategorie. Sposób, który polecam to jest nauka zagadnieniami. Czyli np. interesujesz się tabelami przestawnymi – wybierz ten dział.</p>
    <p>Na platformie możesz także wybrać poziomy. Np. średnio zaawansowany. Musisz mieć na uwadze, że ta sama lekcja może się znaleźć w kursie tabele przestawne jak i średnio zaawansowane.</p>
    <p>Dość gadania zabierzmy się do nauki </p>
    
    </div>
    </div>
  </div>
</section>
<!-- End About Section --> 

<!-- Start Cources Section -->
<section class="our-cources sub padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h2> <span>Kategorie kursów</span> Czego się chcesz dzisiaj nauczyć?</h2>
      </div>
    </div>
    <ul class="row course-list inner">

      @foreach($courses as $course)
        <li class="col-xs-6 col-sm-4 col-md-4 ">
        @include('partials.course_thumb')
        </li>
      @endforeach

    </ul>
    <div class="row">
      <div class="col-sm-12">
        <nav aria-label="Page navigation" class="text-center">
          {{ $courses->links() }}
          {{-- <ul class="pagination">
            <li> <a href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</span> </a> </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li> <a href="#" aria-label="Next"> <span aria-hidden="true">Next <i class="fa fa-angle-right" aria-hidden="true"></i></span> </a> </li>
          </ul> --}}
        </nav>
      </div>
    </div>
  </div>

  
</section>
<!-- End Cources Section --> 


@endsection