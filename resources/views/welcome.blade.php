@extends('layouts.front')

@section('content')
<div class="row">
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-8 col-md-8 col-xs-12 ">
        <h3>Warto uczyć się z nami bo</h3>
        <ul class="features-list">
            <li class="wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="material-icons-devices"><a href="#">Od A do Z</a></h4>

                <p>Nie spotkałeś się z VBA? U nas krok po kroku wprowadzimy Cię w VBA. Znasz
                VBA? Z nami utrwalisz swoją wiedzę i dowiesz się jak można rozwiązać typowe problemy w z VBA</p>
            </li>
            <li class="wow fadeInUp" data-wow-delay="0.3s">
                <h4 class="material-icons-cloud_queue"><a href="#">Nie bujamy w obłokach, uczymy</a></h4>

                <p>Znamy przepis na to aby nauczyć Cię języka VBA. Nie musisz być infomratykiem. Ważne, żebyś znał dobrze Excela i miał głowę otwartą. W zeszłym roku przeszkoliliśmy ponad 1000 osób z VBA</p>
            </li>
            <li class="wow fadeInUp" data-wow-delay="0.5s">
                <h4 class="material-icons-headset_mic"><a href="#">Konferencje on-line</a></h4>

                <p>Wyróżnia nas nie tylko to, że filmy są nagrane przez wieloletnich praktyków. Ale raz na tydzień organizujemy interaktywną konferencję on-line w której możesz uczestniczyć, zadawać pytania oraz pomożemy rozwiązać Twoje problemy.</p>
            </li>
        </ul>
    </div>
</div>
</div>
</section>
<section class="well2">
<div class="container">
<div class="row off">
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-4 col-md-4 col-xs-6 ">
        <h3>Losowe lekcje</h3>
    </div>
</div>
<div class="row">
    @foreach($lessons as $lesson)
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-4 col-md-4 col-xs-6 lesson">
        <a href="{{ $lesson->link() }}" 
           class="thumb ">
           <img src="{{ $lesson->image->thumb(293, 165) }}" alt="">
           <div class="play-overlay text-center v-align">
                <div><i class="fa fa-play-circle fa-4x"></i></div>
           </div>
       </a>
        <h4><a href="{{ $lesson->link() }}">{{ $lesson->title }}</a></h4>

        {{-- <div class="introduction">{!! $lesson->introduction !!}</div> --}}
    </div>
    @endforeach
    {{-- <div class="col-sm-4 col-md-4 col-xs-6">
        <a href="//player.vimeo.com/video/37582125?wmode=transparent" data-wow-duration="1s"
           class="thumb fancybox.iframe"><img src="images/page-1_img02.jpg" alt=""><span
                class="thumb_overlay"></span></a>
        <h4><a href="#">Video name 2</a></h4>

        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod.</p>
    </div> --}}

</div>
</div>
</section>


<section class="testimonial padding-lg">
  <div class="container">
    <div class="wrapper">
      <h2>Co o nas mówią?</h2>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

          <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <p>Szkolenia iExcel pozwoliły mi na prowadzenie szeregu usprawnień w firmie. Pomimo ciągłej pracy na excelu, moje analizy są teraz zdecydowanie bardziej profesjonalne. Nie ma w Polsce drugiej takiej firmy, która w tak przyswajalny sposób potrafi przekazać wiedzę. Osobiście – bardzo polecam! Dzięki i widzimy się na kolejnej konferencji</p>
                    <span>Łukasz Kutyłowski, <span>Warszawa</span></span>
                    <br />
                    <img src="images/Łukasz-Kutyłowskibig-100x100.png" class="img-circle" alt=""/>
                </div>
                <div class="item">
                    <p>Środowa konferencja była pierwszą i na pewno nie ostatnią. Zdecydowanie polecam. Super atmosfera a wiedza przekazywana w bardzo przystępny sposób!</p>
                    <span>Damian Klekot, <span>Warszawa</span></span>
                    <br />
                    <img src="images/damian_klekot-100x100.png" class="img-circle" alt="" />
                </div>

                <div class="item">
                    <p>Było przecudnie, szkoda, że nauczycieli w szkołach nie ma z takim podejściem i talentem w przekazywaniu wiedzy :)…no i te kawały</p>
                    <span>Dawid Kowalski, <span>Śrem</span></span>
                    <br />
                    <img src="images/dawid_kowalski-100x100.png" class="img-circle" alt="" />
                </div>
            </div>

        </div>

    </div>
  </div>
</section>

{{--<section class="well">--}}
{{--<div class="container">--}}
{{--<div class="row ">--}}
    {{--<div class=" col-sm-offset-2 col-md-offset-2 col-sm-7  col-md-7 col-xs-12 ">--}}
        {{--<h3> Koszt nauki z nami</h3>--}}

        {{--@foreach($access_options as $option)--}}

        {{--<div class="box">--}}
            {{--<div class="box_aside wow fadeInLeft" data-wow-delay="0.1s">--}}
                {{--{{ abs($option->price) }} zł--}}
            {{--</div>--}}
            {{--<div class="box_cnt__no-flow wow fadeInRight" data-wow-delay="0.2s">--}}
                {{--<h4><a href="{{ $option->buyLink() }}">{{ $option->name }}</a></h4>--}}
                {{--<p>{{ $option->description }}</p>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}
        {{----}}
    {{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</section>--}}

<section class="well2 bg-primary">
<div class="container">
<div class="row">
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-8  col-md-8 col-xs-12 ">
        <h3>Skontakuj się z nami</h3>

        <form method="post" action="{{ url('contact_form') }}" class="mailform">
            {{ csrf_field() }}
            <input type="hidden" name="form-type" value="contact">
            <fieldset>
                <label data-add-placeholder="true">
                    <input type="text" name="name" placeholder="Imię:"
                           data-constraints="@LettersOnly @NotEmpty">
                </label>

                <label data-add-placeholder="true">
                    <input type="text" name="email" placeholder="E-mail:"
                           data-constraints="@Email @NotEmpty">
                </label>

                <label data-add-placeholder="true">
                     <textarea name="message" placeholder="Wiadomość:"
                               data-constraints="@NotEmpty"></textarea>
                </label>

                <div class="mfControls center">
                    <button type="submit" class="btn-ivba">Wyślij</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection