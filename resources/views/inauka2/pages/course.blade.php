@extends('layouts.front')

@section('title', $course->seo_title ?? $course->title)

@section('seo_description', $course->seo_description)

@section('content')

    <section class="about inner padding-lg course-single">
        <div class="container py-3 color-graphite">
            <a href="{{ route('home') }}">Strona główna</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                    <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                          transform="translate(191 252)" fill="none"/>
                    <path id="Path_4140" data-name="Path 4140"
                          d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                          transform="translate(206.672 262)" fill="currentColor"/>
                </g>
            </svg>
            <a href="{{ route('courses') }}">Kursy</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                    <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                          transform="translate(191 252)" fill="none"/>
                    <path id="Path_4140" data-name="Path 4140"
                          d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                          transform="translate(206.672 262)" fill="currentColor"/>
                </g>
            </svg>

            <a href="#">{{ $course->title }}</a>

        </div>

        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-12 col-md-8 p-1">
                    <div class="bg-white rounded p-2 pt-3 px-4">
                        <div class="bg-white-faded d-flex py-1 px-3">
                            <a href="#about" class="p-2 px-3 course-nav">Czego się dowiesz?</a>
                            <a href="#author" class="p-2 px-3 course-nav">O autorze</a>
                            <a href="#toc" class="p-2 px-3 course-nav">Spis treści</a>
                            <a href="#faq" class="p-2 px-3 course-nav">FAQ</a>
                        </div>


                        <h2 class="h2-headline mt-3">
                            {{ $course->title }}
                        </h2>
                        @if($course->author !== null)
                            <div class="meta font-sora" style="font-size: 16px;">
                                Autor: {{ $course->author->name }}
                                @if($course->author->is_internal)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 40 40">
                                        <g id="Group_951" data-name="Group 951" transform="translate(-1139 -7070)">
                                            <g id="Group_737" data-name="Group 737"
                                               transform="translate(1150.072 7080)">
                                                <path id="Path_4298" data-name="Path 4298"
                                                      d="M60.169,0,54.923,1.773,49.8.037V2.062L54.923,3.8l5.246-1.781Z"
                                                      transform="translate(-46.104)" fill="#ff6842"/>
                                                <path id="Path_4299" data-name="Path 4299"
                                                      d="M11.516,35.43l4.23-1.709.024,3.426.041,6.216L8.786,46.21l-6.667-2.7-.033-4.267-.016-2.2-.024-3.228,4,1.618,2.738,1.106Zm4.222-3.913L8.794,34.324,2.037,31.591,0,30.766l.016,2.22.065,9.7L.1,44.906l2.038.825,3.92,1.585,2.738,1.106,2.73-1.106,4.311-1.742,2.021-.817-.016-2.2L17.775,32.9l-.016-2.2Z"
                                                      transform="translate(0 -28.422)" fill="#ff6842"/>
                                                <path id="Path_4300" data-name="Path 4300"
                                                      d="M63.391,100.374,59.269,104.5l-2.079-2.08L55.906,103.7l3.363,3.363,5.406-5.406Z"
                                                      transform="translate(-50.871 -91.768)" fill="#ff6842"/>
                                            </g>
                                            <rect id="Rectangle_629" data-name="Rectangle 629" width="40" height="40"
                                                  transform="translate(1139 7070)" fill="none"/>
                                        </g>
                                    </svg>
                                @endif
                                <span class="color-gray" style="font-size: 14px;">
                                {{ $course->author->description }}
                            </span>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-10">
                                @php
                                    $lesson = $course->lessons->first();
                                @endphp
                                <cloudflare-video
                                        uid="{{ $lesson->video->cloudflare_uid }}"
                                        :width="702"
                                        height=""
                                ></cloudflare-video>
                            </div>
                            <div class="col-2">
                                <div class="course-detail-box mb-3 d-flex flex-column justify-content-center">
                                    <div class="align-self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                             viewBox="0 0 25 25">
                                            <g id="Group_638" data-name="Group 638" transform="translate(3984 -3680)">
                                                <rect id="Rectangle_401" data-name="Rectangle 401" width="25"
                                                      height="25" transform="translate(-3984 3680)" fill="none"/>
                                                <path id="Path_4162" data-name="Path 4162"
                                                      d="M9.95,11.2,7.8,9.1,6.4,10.5,9.95,14.05,15.6,8.4,14.2,6.95Zm3.6-8.65L15,4.95l2.75.6-.25,2.8,1.85,2.15L17.5,12.6l.25,2.8L15,16.05l-1.4,2.4-2.6-1.1-2.55,1.1L7,16.05l-2.75-.6L4.5,12.6,2.65,10.5,4.5,8.349l-.25-2.8L7,4.95l1.4-2.4,2.6,1.1ZM14.4,0,11,1.45,7.6,0,5.7,3.2,2.1,4l.35,3.7L0,10.5l2.45,2.8L2.1,17l3.6.8L7.6,21,11,19.55,14.4,21l1.9-3.2,3.6-.8-.35-3.7L22,10.5,19.55,7.7,19.9,4l-3.6-.8Z"
                                                      transform="translate(-3982 3682)" fill="#fd5429"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="caption">Średnia ocen:</div>
                                    <div style="font-size: 24px;">
                                        <span class="color-red">{{ $course->avg_rating }}</span>/5
                                    </div>
                                </div>
                                <div class="course-detail-box mb-3 d-flex flex-column justify-content-center">
                                    <div class="align-self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="36"
                                             viewBox="0 0 36 36">
                                            <defs>
                                                <clipPath id="clip-path">
                                                    <rect id="Rectangle_865" data-name="Rectangle 865" width="33"
                                                          height="27" fill="none"/>
                                                </clipPath>
                                            </defs>
                                            <g id="Group_969" data-name="Group 969" transform="translate(3984 -3680)">
                                                <rect id="Rectangle_401" data-name="Rectangle 401" width="36"
                                                      height="36" transform="translate(-3984 3680)" fill="none"/>
                                                <g id="Group_976" data-name="Group 976"
                                                   transform="translate(-3982 3684.727)">
                                                    <g id="Group_975" data-name="Group 975" clip-path="url(#clip-path)">
                                                        <path id="Path_4617" data-name="Path 4617"
                                                              d="M0,24H33v3H0Zm4.5-1.5a2.894,2.894,0,0,1-2.119-.881A2.894,2.894,0,0,1,1.5,19.5V3A2.894,2.894,0,0,1,2.381.881,2.894,2.894,0,0,1,4.5,0h24a2.889,2.889,0,0,1,2.118.88A2.89,2.89,0,0,1,31.5,3V19.5a3.009,3.009,0,0,1-3,3Zm0-3h24V3H4.5Zm0,0v0Zm17.281-8.25L13.859,6.677v9.147Z"
                                                              transform="translate(0 0)" fill="#5f6368"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="caption">Liczba lekcji:</div>
                                    <div style="font-size: 24px;">
                                        {{ $course->lessons->count() }}
                                    </div>
                                </div>
                                <div class="course-detail-box mb-3 d-flex flex-column justify-content-center">
                                    <div class="align-self-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="36"
                                             viewBox="0 0 36 36">
                                            <defs>
                                                <clipPath id="clip-path">
                                                    <rect id="Rectangle_864" data-name="Rectangle 864" width="30"
                                                          height="30" fill="rgba(22,22,21,0.8)"/>
                                                </clipPath>
                                            </defs>
                                            <g id="Group_970" data-name="Group 970" transform="translate(3984 -3680)">
                                                <rect id="Rectangle_401" data-name="Rectangle 401" width="36"
                                                      height="36" transform="translate(-3984 3680)" fill="none"/>
                                                <g id="Group_974" data-name="Group 974"
                                                   transform="translate(-3981 3683)">
                                                    <g id="Group_973" data-name="Group 973" clip-path="url(#clip-path)">
                                                        <path id="Path_4616" data-name="Path 4616"
                                                              d="M19.95,22.05l2.1-2.1L16.5,14.4V7.5h-3v8.1ZM15,30a14.615,14.615,0,0,1-5.85-1.181A14.971,14.971,0,0,1,1.181,20.85,14.615,14.615,0,0,1,0,15,14.615,14.615,0,0,1,1.181,9.15,14.971,14.971,0,0,1,9.15,1.181,14.615,14.615,0,0,1,15,0a14.615,14.615,0,0,1,5.85,1.181A14.971,14.971,0,0,1,28.819,9.15,14.615,14.615,0,0,1,30,15a14.615,14.615,0,0,1-1.181,5.85,14.971,14.971,0,0,1-7.969,7.969A14.615,14.615,0,0,1,15,30m0-3a11.571,11.571,0,0,0,8.494-3.506A11.571,11.571,0,0,0,27,15a11.571,11.571,0,0,0-3.506-8.494A11.571,11.571,0,0,0,15,3,11.571,11.571,0,0,0,6.506,6.506,11.571,11.571,0,0,0,3,15a11.571,11.571,0,0,0,3.506,8.494A11.571,11.571,0,0,0,15,27"
                                                              fill="rgba(22,22,21,0.8)"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="caption">Czas trwania:</div>
                                    <div style="font-size: 24px;">
                                        {{ $course->duration() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="h5-headline">
                            Opis kursu
                        </h5>
                        {!! $course->description !!}

                        <testimonials-carousel></testimonials-carousel>


                        <div class="rounded border border-2 p-3 d-flex" style="border-color: #FD5529 !important;">
                            <div class="align-self-center">
                                <img src="/images/inauka2/salary.png"/>
                            </div>
                            <div class="align-self-center flex-grow-1 border-right p-1">
                                <div class="subtitle-2" style="color: #FF6841">
                                    Wynagrodzenie:
                                </div>
                                <div class="h3-headline">
                                    5.500 - 12.000 zł
                                </div>
                                <div class="font-sora">
                                    Umiejętność: Power BI - Zaawansowane
                                </div>
                            </div>
                            <div class="align-self-center">
                                <a href="" class="btn btn-white" style="font-size: 16px">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                                        <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                                            <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                                                  transform="translate(191 252)" fill="none"/>
                                            <path id="Path_4140" data-name="Path 4140"
                                                  d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                                                  transform="translate(206.672 262)" fill="currentColor"/>
                                        </g>
                                    </svg>
                                    Zobacz oferty
                                </a>
                            </div>
                        </div>

                        <h3 class="h6-headline mt-3">
                            Czego się dowiesz?
                        </h3>
                        <a name="about"></a>

                        @if($course->hasQuiz())
                            <div class="p-3 rounded color-red d-flex justify-content-center"
                                 style="background-color: #FF68410A">
                                <div class="px-3 align-self-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                        <g id="Group_1026" data-name="Group 1026" transform="translate(-536 -3284)">
                                            <rect id="Rectangle_377" data-name="Rectangle 377" width="32" height="32"
                                                  transform="translate(536 3284)" fill="none"/>
                                            <path id="school_24dp_5F6368_FILL0_wght400_GRAD0_opsz24"
                                                  d="M55.111-815.273l-9.616-5.22v-8.242L40-831.758,55.111-840l15.111,8.242v10.99H67.475v-9.479l-2.747,1.511v8.242Zm0-11.4,9.41-5.083-9.41-5.083-9.41,5.083Zm0,8.277,6.869-3.709v-5.186l-6.869,3.778-6.869-3.778v5.186ZM55.111-826.675ZM55.111-823.584ZM55.111-823.584Z"
                                                  transform="translate(496 4126.272)" fill="#ff6841"/>
                                        </g>
                                    </svg>
                                </div>
                                <div>
                                    Kurs kończy się testem, a po zdaniu otrzymasz imienny certyfikat potwierdzający
                                    nabyte umiejętności.
                                </div>
                            </div>
                        @endif

                        <h3 class="h6-headline mt-3">
                            Dlaczego warto wybrać ten kurs?
                        </h3>

                        <div class="row">
                            <div class="col-4 p-1">
                                <div class="rounded p-3" style="background-color: #8EE55F0A;">
                                    <img src="{{ url('/images/inauka2/courses/green.png') }}"/>
                                    <h6 class="h6-headline mt-3">
                                        We własnym tempie
                                    </h6>
                                    <p>
                                        Ucz się, kiedy chcesz, bez presji. Twój rytm, Twoje tempo.
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 p-1">
                                <div class="rounded p-3" style="background-color: #48CBEA0A;">
                                    <img src="{{ url('/images/inauka2/courses/blue.png') }}"/>
                                    <h6 class="h6-headline mt-3">
                                        Nasze wsparcie
                                    </h6>
                                    <p>
                                        Masz pytania? Pisz śmiało na hello@inauka.pl – pomożemy!
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 p-1">
                                <div class="rounded p-3" style="background-color: #FF68410A;">
                                    <img src="{{ url('/images/inauka2/courses/red.png') }}"/>
                                    <h6 class="h6-headline mt-3">
                                        Ekspercka wiedza
                                    </h6>
                                    <p>
                                        Zyskujesz sprawdzoną wiedzę od ekspertów w swojej dziedzinie.
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($course->author)
                            <h3 class="h6-headline my-3">
                                O autorze
                            </h3>
                            <a name="author"></a>

                            <div class="d-flex">
                                <div>
                                    <img src="{{ $course->author->image }}" class="rouded">
                                </div>
                                <div class="d-flex flex-column justify-content-between px-3">
                                    <div>
                                        <h6 class="h6-headline">{{ $course->author->name }}</h6>
                                        <p class="subtitle-1 color-gray">{{ $course->author->description }}</p>
                                    </div>
                                    <div>
                                        <div class="my-2 p-1 px-3 color-red bg-white-faded">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                                                 viewBox="0 0 36 36">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect id="Rectangle_865" data-name="Rectangle 865" width="33"
                                                              height="27" fill="none"/>
                                                    </clipPath>
                                                </defs>
                                                <g id="Group_969" data-name="Group 969"
                                                   transform="translate(3984 -3680)">
                                                    <rect id="Rectangle_401" data-name="Rectangle 401" width="36"
                                                          height="36" transform="translate(-3984 3680)" fill="none"/>
                                                    <g id="Group_976" data-name="Group 976"
                                                       transform="translate(-3982 3684.727)">
                                                        <g id="Group_975" data-name="Group 975"
                                                           clip-path="url(#clip-path)">
                                                            <path id="Path_4617" data-name="Path 4617"
                                                                  d="M0,24H33v3H0Zm4.5-1.5a2.894,2.894,0,0,1-2.119-.881A2.894,2.894,0,0,1,1.5,19.5V3A2.894,2.894,0,0,1,2.381.881,2.894,2.894,0,0,1,4.5,0h24a2.889,2.889,0,0,1,2.118.88A2.89,2.89,0,0,1,31.5,3V19.5a3.009,3.009,0,0,1-3,3Zm0-3h24V3H4.5Zm0,0v0Zm17.281-8.25L13.859,6.677v9.147Z"
                                                                  transform="translate(0 0)" fill="currentColor"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <span class="color-gray body-2">Opublikowane kursy: {{ $course->author->courses()->count() }}</span>
                                        </div>
                                        @if($course->author->is_internal)
                                            <div class="my-2 px-2 py-1 color-red" style="background-color: #FF68410A;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                     viewBox="0 0 30 30">
                                                    <g id="Group_951" data-name="Group 951"
                                                       transform="translate(-1139 -7070)">
                                                        <g id="Group_737" data-name="Group 737"
                                                           transform="translate(1150.072 7080)">
                                                            <path id="Path_4298" data-name="Path 4298"
                                                                  d="M60.169,0,54.923,1.773,49.8.037V2.062L54.923,3.8l5.246-1.781Z"
                                                                  transform="translate(-46.104)" fill="currentColor"/>
                                                            <path id="Path_4299" data-name="Path 4299"
                                                                  d="M11.516,35.43l4.23-1.709.024,3.426.041,6.216L8.786,46.21l-6.667-2.7-.033-4.267-.016-2.2-.024-3.228,4,1.618,2.738,1.106Zm4.222-3.913L8.794,34.324,2.037,31.591,0,30.766l.016,2.22.065,9.7L.1,44.906l2.038.825,3.92,1.585,2.738,1.106,2.73-1.106,4.311-1.742,2.021-.817-.016-2.2L17.775,32.9l-.016-2.2Z"
                                                                  transform="translate(0 -28.422)" fill="currentColor"/>
                                                            <path id="Path_4300" data-name="Path 4300"
                                                                  d="M63.391,100.374,59.269,104.5l-2.079-2.08L55.906,103.7l3.363,3.363,5.406-5.406Z"
                                                                  transform="translate(-50.871 -91.768)"
                                                                  fill="currentColor"/>
                                                        </g>
                                                        <rect id="Rectangle_629" data-name="Rectangle 629" width="40"
                                                              height="40" transform="translate(1139 7070)" fill="none"/>
                                                    </g>
                                                </svg>
                                                <span class="color-gray body-2">Trener iNauka.pl</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="py-1" style="max-width: 50%">
                                    <div class="border-left body-1 color-gray">
                                        {!! nl2br($course->author->bio) !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <h3 class="h6-headline mt-3">
                            Spis treści
                        </h3>
                        <a name="toc"></a>

                        <table class="table">
                            <tbody>
                            @foreach($course->lessons as $id => $lesson)
                                <tr>
                                    <th scope="col" style="width: 10%">
                                        <span class="lesson">Lekcja {{ $id + 1 }}</span>
                                    </th>
                                    <td>{{ $lesson->title }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <h3 class="h6-headline mt-3">
                            Najczęściej zadawane pytania
                        </h3>
                        <a name="faq"></a>


                    </div>
                </div>

                <div class="col-12 col-md-4 align-self-stretch">
                    <div class="sticky-top">
                        <div class="border border-gray rounded bg-white my-2 text-center px-3 pb-2 pt-3">
                            <div class="tags d-flex justify-content-center w-100">
                                @foreach($course->visibleTags as $tag)
                                    @include('pages.course._tag', compact('tag'))
                                @endforeach
                            </div>
                            <h3 class="subtitle-2 mt-3">Kup teraz i zgarnij losowy ebook gratis</h3>
                            <course-countdown
                                    :timestamp="{{ \Carbon\Carbon::now()->subHours(2)->timestamp }}"></course-countdown>

                            <div class="row mt-3" style="max-width: 385px; margin: 0 auto;">
                                <div class="col-6 blue-box body-2 p-1">
                                    <div class="bg-light-blue rounded p-1">
                                        Zaoszczędź dzięki promocji
                                    </div>
                                </div>
                                <div class="col-6 blue-box body-2 p-1">
                                    <div class="bg-light-blue rounded p-1">
                                        Polska firma + faktura VAT
                                    </div>
                                </div>
                                <div class="col-6 blue-box body-2 p-1">
                                    <div class="bg-light-blue rounded p-1">
                                        30 dni gwarancji zwrotu
                                    </div>
                                </div>
                                <div class="col-6 blue-box body-2 p-1">
                                    <div class="bg-light-blue rounded p-1">
                                        Wsparcie na każdym kroku
                                    </div>
                                </div>
                                <div class="col-6 blue-box body-2 p-1">
                                    <div class="bg-light-blue rounded p-1">
                                        350 osób już korzysta
                                    </div>
                                </div>
                                <div class="col-6 blue-box body-2 p-1">
                                    <div class="bg-light-blue rounded p-1">
                                        Dożywotni dostęp
                                    </div>
                                </div>
                            </div>

                            <h3 class="h4-headline mt-3">
                                {{ $course->title }}
                            </h3>
                            <hr style="width: 80%; margin: 0 auto;"/>

                            @if($course->isDiscounted())
                                <div class="text-center p-2">
                                    <div class="bg-azure inline mr-2 p-1 px-2 body-2 text-white"
                                         style="font-weight: 700">
                                        {{ $course->discountPercentage() }}
                                    </div>
                                    <div class="inline p-2 h5-headline color-gray"
                                         style="text-decoration: line-through; font-weight: 400">
                                        {{ $course->price_full }}
                                    </div>
                                </div>
                            @endif
                            <a href="{{ $course->payment_link }}"
                               class="btn btn-coral w-100 py-3 h5-headline"
                               style="font-weight: 400; font-size: 24px;"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                                    <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                                        <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                                              transform="translate(191 252)" fill="none"/>
                                        <path id="Path_4140" data-name="Path 4140"
                                              d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                                              transform="translate(206.672 262)" fill="currentColor"/>
                                    </g>
                                </svg>

                                Kup kurs teraz za {{ $course->price }} zł
                            </a>
                            <div class="caption py-2" style="text-align: left">
                                Najniższa cena z ostatnich 30 dni: 59.00 zł
                            </div>

                            <div class="body-1 p-2" style="text-align: left; font-size: 14px;">
                                Bezpieczne płatności
                            </div>
                            <div class="body-1 p-2" style="text-align: left; font-size: 14px;">
                                Kup teraz i otrzymaj błyskawiczny dostęp
                            </div>
                            <div class="body-1 p-2" style="text-align: left; font-size: 14px;">
                                Transparentna Platforma: Maratony Excela, Zaufani trenerzy
                            </div>
                            <div class="body-1 p-2" style="text-align: left; font-size: 14px;">
                                Najlepsza okazja + 30 dniowy zwrot
                            </div>
                        </div>

                        <div class="d-flex border rounded p-3 justify-content-between">
                            <div>
                                <span class="subtitle-2">Miesięczny dostęp</span> <br/>
                                <span class="caption">Wszystkie kursy w abonamencie</span>
                            </div>
                            <div>
                                <a href="" class="btn btn-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                                        <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                                            <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                                                  transform="translate(191 252)" fill="none"/>
                                            <path id="Path_4140" data-name="Path 4140"
                                                  d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                                                  transform="translate(206.672 262)" fill="currentColor"/>
                                        </g>
                                    </svg>

                                    Kup za {{ \App\Domains\Payments\Helpers\PricesHelper::subscription() }} zł
                                </a>
                            </div>
                        </div>

                        <div class="d-flex border rounded p-3 justify-content-between mt-2">
                            <div>
                                <span class="subtitle-2">Roczny dostęp</span> <br/>
                                <span class="caption">Pełny dostęp na 365 dni</span>
                            </div>
                            <div>
                                <a href="" class="btn btn-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 40 40">
                                        <g id="Group_585" data-name="Group 585" transform="translate(-191 -252)">
                                            <rect id="Rectangle_366" data-name="Rectangle 366" width="40" height="40"
                                                  transform="translate(191 252)" fill="none"/>
                                            <path id="Path_4140" data-name="Path 4140"
                                                  d="M4.6,0,0,.017,4.041,10.11.085,20,4.7,19.983,8.656,10.11Z"
                                                  transform="translate(206.672 262)" fill="currentColor"/>
                                        </g>
                                    </svg>

                                    Dostęp na rok [bez karty]
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
