@extends('layouts.front')

@section('content')


<!-- Start Banner Carousel -->
<div class="banner-outer">
  <div class="banner-slider">
    <div class="slide1">
      <div class="container">
        <div class="content animated fadeInRight">
          <div class="fl-right">
            <h1 class="animated fadeInRight">To jest najlepsze miejsce na naukę <span class="animated fadeInRight">Excel-a</span> </h1>
            <p class="animated fadeInRight">Skorzystaj z ponad 200 lekcji i ucz się kiedy chcesz</p>
            <a href="{{ url('about') }}" class="btn animated fadeInRight">Zobacz jak to działa <span class="icon-more-icon"></span></a> </div>
        </div>
      </div>
    </div>
    <div class="slide2">
      <div class="container"> 
        <div class="content animated fadeInRight">
            <div class="fl-right">
            <h1 class="animated fadeInRight">Poznaj nasze kategorie<span class="animated fadeInRight">Excel-a</span> </h1>
            <p class="animated fadeInRight">Tabele przestawne, funkcje, formuły tablicowe, makra.</p>
            <a href="{{ url('courses') }}" class="btn animated fadeInRight">Zobacz jak to działa <span class="icon-more-icon"></span></a> </div>
        </div>
      </div>
    </div>
    <div class="slide3">
      <div class="container">
        <div class="content animated fadeInLeft">
          <h1 class="animated fadeInLeft">6000 użytkowników</h1>
          <p class="animated fadeInLeft">Dołącz do grona osób, które nauczyły się Excela z nami i odniosły sukces</p>
          <a href="/register" class="btn animated fadeInLeft">Zarejestruj się <span class="icon-more-icon"></span></a> </div>
      </div>
    </div>
  </div>
</div>
<!-- End Banner Carousel --> 

<!-- Start Cources Section -->
<section class="our-cources padding-lg">
  <div class="container">
    <h2> <span>Najpopularniejsze kursy</span> Czego chcesz się dzisiaj nauczyć?</h2>
    <ul class="course-list owl-carousel">

        @foreach($courses as $course)
            <li class="equal-hight">
            @include('partials.course_thumb')
            </li>
        @endforeach

    </ul>
  </div>
</section>

<!-- End Our Importance Section --> 
<section class="how-study padding-lg">
    <div class="container">
        <h2>Jak to działa?</h2>
        <p style="text-align: center">
        <iframe src="https://player.vimeo.com/video/232335257?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </p>
    </div>
</section>



<!-- Start Why Choose Section -->

<section class="why-choose padding-lg">
  <div class="container">
    <h2><span>Liczby mówią same</span>dlaczego warto nas wybrać</h2>
    <ul class="our-strength">
      <li>
        <div class="icon"><span class="icon-certification-icon"> </span></div>
        <span class="counter">36</span>
        <div class="title">Kursów</div>
      </li>
      <li>
        <div class="icon"><span class="icon-student-icon"></span></div>
        <span class="counter">7000</span><span>+</span>
        <div class="title">uczestników</div>
      </li>
      <li>
        <div class="icon"><span class="icon-book-icon"></span></div>
        <div class="couter-outer"><span class="counter">200</span><span>+</span></div>
        <div class="title">Lekcji</div>
      </li>
      <li>
        <div class="icon"><span class="fa fa-star-o"></span></div>
        <div class="couter-outer"><span class="counter">30</span><span> dni</span></div>
        <div class="title">Gwarancji</div>
      </li>
    </ul>
  </div>
</section>

<!-- End Why Choose Section --> 

<!-- Start New & Events Section -->

<section class="news-events padding-lg">
  <div class="container">
    <h2><span>Jest wiele sposobów na naukę</span>Nasz blog</h2>
    <ul class="row cs-style-3">

        @foreach( $blog_items as $item)
          <li class="col-sm-4">
            <div class="inner">
              <figure> <img src="images/new-event-img1.jpg" class="img-responsive">
                <figcaption>
                  <div class="cnt-block"> <a target="_blank" href="{{ $item->link }}" class="plus-icon">+</a>
                    <h3>{{ $item->title }}</h3>
                    <div class="bottom-block clearfix">
                      <div class="date">
                        <div class="icon"><span class="icon-calander-icon"></span></div>
                        <span>{{ \Carbon\Carbon::parse($item->pubDate)->format('Y-m-d H:i') }}</span></div>
                    </div>
                  </div>
                </figcaption>
              </figure>
            </div>
          </li>
        @endforeach
    </ul>
    <div class="know-more-wrapper"> <a href="http://blog.iexcel.pl" class="know-more">Zobacz więcej wpisów <span class="icon-more-icon"></span></a> </div>
  </div>
</section>

<!-- End New & Events Section --> 

<section class="how-study padding-lg">
  <div class="container">
    <h2> <span>Losowe lekcje </span> Czego chcesz się dziś nauczyć?</h2>
    <ul class="row">
        @foreach($lessons as $lesson)
            @include('partials.lesson_thumb')
        @endforeach
    </ul>
  </div>
</section>


<!-- Start Testimonial -->

<section class="testimonial padding-lg">
  <div class="container">
    <div class="wrapper">
      <h2>Co o nas mówią?</h2>
      <ul class="testimonial-slide">
        <li>
          <p>Szkolenia iExcel pozwoliły mi na prowadzenie szeregu usprawnień w firmie. Pomimo ciągłej pracy na excelu, moje analizy są teraz zdecydowanie bardziej profesjonalne. Nie ma w Polsce drugiej takiej firmy, która w tak przyswajalny sposób potrafi przekazać wiedzę. Osobiście – bardzo polecam! Dzięki i widzimy się na kolejnej konferencji</p>
          <span>Łukasz Kutyłowski, <span>Warszawa</span></span> </li>
        <li>
          <p>Środowa konferencja była pierwszą i na pewno nie ostatnią. Zdecydowanie polecam. Super atmosfera a wiedza przekazywana w bardzo przystępny sposób!</p>
          <span>Damian Klekot, <span>Warszawa</span></span> </li>
        <li>
          <p>Było przecudnie, szkoda, że nauczycieli w szkołach nie ma z takim podejściem i talentem w przekazywaniu wiedzy :)…no i te kawały</p>
          <span>Dawid Kowalski, <span>Śrem</span></span> </li>
      </ul>
      <div id="bx-pager"> 
        <a data-slide-index="0" href="">
            <img src="images/Łukasz-Kutyłowskibig-100x100.png" class="img-circle" alt=""/></a> 
        <a data-slide-index="1" href="">
            <img src="images/damian_klekot-100x100.png" class="img-circle" alt="" /></a> 
        <a data-slide-index="2" href="">
            <img src="images/dawid_kowalski-100x100.png" class="img-circle" alt="" /></a> 
        </div>
    </div>
  </div>
</section>

<!-- End Testimonial --> 


@endsection