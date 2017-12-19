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
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-4 col-md-4 col-xs-6 ">
        <a href="{{ $lesson->link() }}" 
           class="thumb "><img src="{{ $lesson->image->thumb(293, 165) }}" alt=""></a>
        <h4><a href="{{ $lesson->link() }}">{{ $lesson->title }}</a></h4>

        <div>{!! $lesson->introduction !!}</div>
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
<section class="well bg-primary">
<div class="container">
<div class="row ">
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-8 col-md-8 col-xs-12 ">
        <h3 class="wow fadeInUp" data-wow-delay="0.2s"> A great way to describe your video</h3>

        <p class="wow fadeInUp" data-wow-delay="0.4s">Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
            voluptate velit esse cillum dolore eu fugiat nulla pariatur.Lorem ipsum dolor sit amet conse
            ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
    </div>
</div>
</div>
</section>
<section class="well">
<div class="container">
<div class="row ">
    <div class=" col-sm-offset-2 col-md-offset-2 col-sm-7  col-md-7 col-xs-12 ">
        <h3> Koszt nauki z nami</h3>

        @foreach($access_options as $option)

        <div class="box">
            <div class="box_aside wow fadeInLeft" data-wow-delay="0.1s">
                {{ abs($option->price) }} zł
            </div>
            <div class="box_cnt__no-flow wow fadeInRight" data-wow-delay="0.2s">
                <h4><a href="{{ $option->buyLink() }}">{{ $option->name }}</a></h4>
                <p>{{ $option->description }}</p>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
</div>
</section>

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