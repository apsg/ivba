@extends('layouts.front')

@section('title', $course->seo_title ?? $course->title)

@section('seo_description', $course->seo_description)

@section('content')
<!-- Start Course Description -->
<section class="about inner padding-lg">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-md-push-5 left-block">
        <h2>{{ $course->title }}</h2>
        
        {!! $course->description !!}

        
      </div>
      <div class="col-md-5 col-md-pull-7">
        <div class="enquire-wrapper">
            <figure class="hidden-xs hidden-sm">
            @if($course->video()->exists())
                {!! $course->video->embed(450, 300) !!}
            @else
                <img src="{{ $course->image->url }}" class="img-responsive" alt="">
            @endif
            </figure>
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="course-detail clearfix">
          <div class="duration clearfix">
            <div class="icon"><span class="icon-duration-icon"></span></div>
            <div class="detail"> <span>Czas trwania</span> {{ $course->duration() }} </div>
          </div>
          <div class="duration eligible clearfix">
            <div class="icon"><span class="icon-certification-icon"></span></div>
            <div class="detail"> <span>Trudność:</span> {{ $course->difficulty() }}</div>
          </div>
          <div class="duration eligible clearfix">
            <div class="icon"><span class="icon-eligibility-icon"></span></div>
            <div class="detail"> <span>Liczba lekcji:</span> {{ $course->lessons()->count() }}</div>
          </div>
          
            @if( Gate::allows('access-course', $course))
                <a href="{{ url('/learn/course/'.$course->slug) }}" class="btn btn-primary">Rozpocznij kurs <span class="icon-more-icon"></span></a> 
            @else
                Nie masz jeszcze dostępu do tego kursu. Poczekaj aż uzyskasz dostęp w ramach swojego abonamentu lub wykup pełen dostęp. <br />
                <a href="{{ url('/buy_access') }}" class="btn btn-primary">Kup dostęp <span class="icon-more-icon"></span></a> 
            @endif

      </div>
    </div>
  </div>
</section>
<!-- End Course Description --> 

<!-- Start Course Details Tab -->
<section class="details-tab">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
          <ul class="nav nav-tabs course-tab" id="myTabs" role="tablist">
            <li role="presentation" class="active"> <a href="#curriculam" id="curriculam-tab" role="tab" data-toggle="tab" aria-controls="curriculam" aria-expanded="true"> <span class="icon-curriculam-icon"></span>
              <div class="block">SPIS</div>
              TREŚCI </a> </li>
            <li role="presentation" class=""> <a href="#schedule" role="tab" id="schedule-tab" data-toggle="tab" aria-controls="schedule" aria-expanded="false"> <span class="fa fa-star"></span>
              <div class="block">Opinie</div></a> </li>
            <li role="presentation" class=""> <a href="#comments" role="tab" id="comments-tab" data-toggle="tab" aria-controls="comments" aria-expanded="false"> <span class="icon-chat-icon"></span>
              <div class="block">Komentarze</div>
              </a> </li>
            <li role="presentation" class=""> <a href="#teachers" role="tab" id="teachers-tab" data-toggle="tab" aria-controls="teachers" aria-expanded="false"> <span class="icon-parents-icon"></span>
              <div class="block">Nauczyciele</div>
              </a> </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" role="tabpanel" id="curriculam" aria-labelledby="curriculam-tab">
              <div class="table-responsive">
                <table class="table course-table table-bordered">
                  <thead>
                    <tr>
                      <th>Lekcje</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($course->lessons as $lesson)
                        <tr>
                            <td><div class="table-col1">
                                <div class="lecture-txt">Lekcja <span>{{ $lesson->pivot->position+1 }}</span> 
                                <a target="_blank" href="{{ $lesson->link() }}" class="preview">Podgląd</a></div>
                          {{ $lesson->title }} </div>
                          
                          </td>
                        </tr>                        
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="schedule" aria-labelledby="schedule-tab">
              <div class="table-responsive">
                <table class="table course-table table-bordered">
                  <thead>
                    <tr>
                      <th>Oceny</th>
                    </tr>
                  </thead>
                  <tbody>
                        <tr>
                            <td>
                                <h4>Średnia ocena dla tego kursu:</h4>
                                <span class="rating">{{ $course->avg_rating }}</span> (ocen: {{ $course->ratings_count }})
                            </td>
                        </tr>
                    <tr>
                      <td><div class="">
                            @include('partials.rating')
                      </div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="comments" aria-labelledby="comments-tab">
                    <div class="table-responsive">
                        <table class="table course-table table-bordered"><thead><th>Komentarze</th></thead><tbody><tr><td class="table-col1">
                            <div id="disqus_thread"></div>
                        </td></tr></tbody></table>
                    </div>
            </div>
            <div class="tab-pane fade" role="tabpanel" id="teachers" aria-labelledby="teachers-tab">
                <div class="col-md-4" style="text-align: center;">
                    <img src="{{ url('images/mati2.png') }}" alt="" >
                </div>
                <div class="col-md-8">
                    <h3>Mateusz Grabowski</h3>
                    <p>Wykładowca i trener informatyki. ﻿﻿10 lat doświadczenia w prowadzeniu szkoleń dla biznesu. Twórca największego portalu do nauki Excela - www.iExcel.pl . Autor kanału na youtube w całości poświęconego Excelowi. </p>

                    <p><strong>Od Mateusza:</strong><br />
                    Mam nadzieję, że uda Ci się wydospodarować czas i spotkamy się na szkoleniu. Pamiętaj, z nauką Excela jest jak z podróżą: Podróż tysiąca mil zaczyna się od pierwszego kroku. </p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Course Details Tab --> 

@endsection