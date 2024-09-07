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
                <div class="col-12 col-md-8">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque venenatis vitae risus eu
                    sollicitudin. Aliquam tincidunt lacus ex, sit amet rutrum leo egestas eu. Praesent euismod magna
                    dolor, eu sollicitudin arcu iaculis sed. Sed lobortis placerat odio eu facilisis. Proin ac odio nec
                    erat venenatis condimentum. Etiam elementum magna nibh, ac faucibus lectus venenatis a. Donec auctor
                    quam sit amet luctus pretium. Vestibulum eleifend felis eget ligula porttitor, sit amet placerat
                    metus congue. Duis ultricies tristique gravida. Fusce sodales nulla eu urna egestas, ut posuere erat
                    imperdiet. Suspendisse suscipit, diam sed consectetur ultrices, tortor odio sagittis orci, eu semper
                    dui turpis et tortor. Suspendisse eu imperdiet nisi. In hac habitasse platea dictumst. Nulla eu
                    sollicitudin libero, ac maximus lacus. Nam mollis nulla tortor, ac fermentum dui vulputate vitae. Ut
                    dictum sagittis justo, at efficitur mauris.

                    Phasellus faucibus libero odio, eu varius enim elementum ut. Donec euismod augue sit amet justo
                    tempus, at tincidunt arcu posuere. Nam at porta tellus. Cras eu sem eget ligula molestie placerat.
                    Curabitur ac tempor lacus, sit amet eleifend elit. Sed diam eros, mattis vitae sollicitudin ac,
                    vulputate ac risus. Nam vitae libero lorem. Curabitur ut justo elementum, cursus leo vitae,
                    consequat nisi. Nullam ac massa erat. Class aptent taciti sociosqu ad litora torquent per conubia
                    nostra, per inceptos himenaeos. Vivamus non blandit arcu. Praesent lacinia gravida lacus, nec dictum
                    neque fermentum sit amet. Duis iaculis malesuada felis. Ut augue nulla, placerat vel purus a,
                    scelerisque tempor neque. Donec et tortor quis velit egestas pharetra. Sed nunc eros, hendrerit ut
                    nisl vestibulum, tincidunt tincidunt diam.

                    In eu vehicula augue, a dapibus neque. Vestibulum felis mi, scelerisque vel purus ac, hendrerit
                    pellentesque neque. Phasellus finibus gravida elementum. Pellentesque tortor ipsum, viverra a massa
                    ut, maximus pellentesque risus. Fusce commodo nunc nec urna mattis, non condimentum turpis
                    sollicitudin. Phasellus dignissim risus sapien, in sagittis lacus finibus vel. Etiam sed dictum
                    nisl, maximus pretium lectus. Morbi ac convallis nisl. Nullam non consequat mauris, quis pulvinar
                    tellus. Pellentesque vel tincidunt lacus. Integer vel lacus dictum urna imperdiet pharetra nec sit
                    amet nibh. Proin interdum quam a ante aliquet, vel hendrerit augue tincidunt. Donec a iaculis nibh.

                    Sed non varius mauris, eget placerat massa. Suspendisse dictum et leo et dignissim. Nam blandit nisi
                    in erat pharetra hendrerit. Curabitur non enim in diam lacinia convallis eget id ipsum. Pellentesque
                    feugiat consequat eleifend. Pellentesque in est elit. Donec nec iaculis libero. Nam accumsan ut est
                    nec placerat. Morbi eu lacus vitae ipsum accumsan maximus ut quis mauris. Mauris ullamcorper ante
                    erat, id molestie nisi tincidunt ut. Orci varius natoque penatibus et magnis dis parturient montes,
                    nascetur ridiculus mus. Sed id cursus metus, at suscipit quam. Cras a neque dui.

                    Sed pellentesque dictum nisl in eleifend. Pellentesque maximus dignissim eros a imperdiet. Duis
                    porttitor eros id magna consectetur condimentum. Etiam in tincidunt massa, non convallis leo.
                    Suspendisse felis massa, tincidunt ut purus vitae, eleifend dapibus mi. Phasellus in nibh nec lacus
                    blandit facilisis volutpat ut tortor. Sed ut diam neque. Maecenas eget erat ultrices, porttitor diam
                    et, bibendum erat. Curabitur est mi, consequat et tincidunt vel, rutrum vitae nulla. Donec dictum
                    leo vitae purus fermentum cursus. Duis nibh lacus, pellentesque sit amet tristique vitae, malesuada
                    vitae est. Pellentesque gravida dui ut diam porttitor, ut viverra dui luctus. In pellentesque
                    finibus pulvinar.

                    Vivamus euismod congue consectetur. Sed quis interdum odio. Class aptent taciti sociosqu ad litora
                    torquent per conubia nostra, per inceptos himenaeos. Ut quis mauris purus. Fusce tincidunt, mauris
                    ac lobortis blandit, lectus odio congue ligula, et pulvinar orci enim nec orci. Suspendisse sodales
                    pharetra libero, non interdum velit euismod nec. Proin lobortis diam vel dapibus luctus. In tempus
                    suscipit metus, nec gravida mauris commodo ac.

                    Nam imperdiet ante vel quam volutpat, sed vulputate turpis consequat. Maecenas nec interdum nunc.
                    Sed sodales ex non dolor gravida ultrices. Nunc malesuada mauris id odio imperdiet, quis volutpat
                    tellus auctor. Nullam ornare dignissim nulla, eget ultricies turpis ultricies ut. Donec pretium a
                    libero in varius. Nunc vestibulum lacinia nunc, a tempus nisi feugiat a. Morbi non accumsan tortor.
                    Vivamus tempus at leo vitae sollicitudin. Pellentesque vitae suscipit turpis. Proin et odio
                    vestibulum, congue justo in, tristique nisi. Suspendisse pulvinar molestie velit, id aliquet felis
                    semper in. Suspendisse et libero vel metus mattis congue. Morbi eu laoreet nunc.

                    Etiam et eros tortor. Sed nec aliquam nunc, sed vehicula nisl. Proin hendrerit urna nulla, eu dictum
                    eros iaculis vitae. Quisque et lorem eget nisi condimentum dictum. Sed vel turpis eu arcu lacinia
                    posuere et nec odio. Cras nibh velit, euismod at semper eget, varius et nisl. In diam nisl, accumsan
                    nec dignissim nec, sollicitudin eu arcu. Pellentesque habitant morbi tristique senectus et netus et
                    malesuada fames ac turpis egestas. Fusce dignissim fermentum ipsum, non rhoncus sem. Nulla facilisi.
                    Ut imperdiet massa libero, sed elementum felis maximus tincidunt. Maecenas quis nunc eu tellus
                    posuere consectetur quis non dui. Donec ultricies vestibulum dolor sed malesuada. Nullam auctor
                    venenatis nisi bibendum egestas. Nullam congue eget nisi eget ultrices.

                    Etiam vel venenatis nibh, eu dictum turpis. Cras in consequat sem. Mauris eu posuere risus. Maecenas
                    ullamcorper, nibh sed ultricies lobortis, ex elit viverra arcu, id pellentesque nibh purus nec
                    ipsum. Suspendisse quis lacus in felis aliquam varius sed vel ligula. Suspendisse molestie, risus id
                    congue dignissim, leo enim hendrerit nibh, id accumsan velit odio vitae odio. Aliquam sodales nibh a
                    tortor gravida molestie. Nulla ultricies volutpat lectus, vitae finibus erat dictum ut. Lorem ipsum
                    dolor sit amet, consectetur adipiscing elit.

                    Pellentesque sollicitudin ipsum metus, congue vulputate mi efficitur sed. Duis rhoncus ut purus vel
                    rutrum. Vivamus porta urna lacus, non eleifend nisi efficitur non. Quisque volutpat nisl vitae urna
                    ultricies, ac posuere ante interdum. Integer ullamcorper purus nec neque cursus, ac placerat neque
                    ultricies. Sed in leo eu ex fringilla dictum. Aenean at lobortis sem, vel molestie risus. Integer
                    interdum blandit felis. Curabitur imperdiet sollicitudin elit eu venenatis. Ut cursus nisi libero.
                    Quisque enim tellus, pellentesque eget tellus non, blandit facilisis velit. Nulla facilisi.
                    Curabitur faucibus, nibh sodales mollis finibus, libero neque maximus erat, at hendrerit odio sapien
                    a ligula. Proin efficitur odio dui. Nam ac finibus eros.

                    Phasellus aliquam justo vel nibh molestie mollis. Vivamus sagittis risus non arcu dignissim egestas.
                    Pellentesque efficitur gravida diam quis venenatis. Morbi tempor est non eros luctus, et egestas
                    nunc vestibulum. Sed vel pulvinar dui, vel hendrerit ex. Quisque non rutrum ligula. Proin dictum at
                    diam vel aliquet. Aenean placerat eros tortor. Nam auctor, velit at molestie dapibus, neque tellus
                    viverra risus, ut eleifend ante ante eu nulla. Duis mollis elit id mi imperdiet, et luctus ligula
                    viverra. Donec tempus malesuada dignissim. Sed imperdiet tortor vel eros laoreet rutrum. Donec
                    accumsan suscipit rutrum. Vivamus molestie dolor a maximus aliquet. Quisque fringilla blandit nunc
                    pellentesque porta. Vestibulum fringilla placerat ipsum ut viverra.

                    Quisque et nulla massa. Duis nisi leo, vulputate ut luctus non, egestas sit amet risus. Quisque
                    metus mauris, volutpat maximus eros nec, pharetra malesuada mi. Nullam sem risus, dictum id rutrum
                    eget, sagittis at odio. Nulla facilisi. Vivamus placerat tincidunt mi id gravida. Duis non arcu est.
                    Curabitur lectus urna, elementum suscipit pellentesque at, posuere et nulla. In tristique, tortor ac
                    ullamcorper finibus, ex leo interdum orci, sit amet semper mauris dui maximus leo. Cras eu metus eu
                    tortor ornare semper ut sit amet lacus. Vestibulum laoreet sodales ex nec vulputate. Praesent
                    consequat interdum congue.

                    Nam posuere interdum lorem vitae hendrerit. Aenean at massa ut mauris gravida tempus sit amet a
                    mauris. Aliquam lacinia tempor orci, ac tempor quam. In hendrerit eleifend auctor. Morbi rhoncus
                    quam nisl, vel eleifend massa pretium vitae. Mauris a quam fringilla, sagittis diam sit amet,
                    vehicula sem. Quisque at magna eu quam porta congue vel quis tellus.

                    Quisque vel eros vitae libero bibendum euismod. Phasellus et neque mauris. Nam dignissim magna sem,
                    eu tempor tortor imperdiet ut. Ut blandit sem est, nec ultricies elit maximus id. Nunc sed leo
                    tincidunt, lobortis libero sed, mattis elit. In vehicula pellentesque tortor, sed aliquet lectus
                    cursus sit amet. Pellentesque id tincidunt dui. Class aptent taciti sociosqu ad litora torquent per
                    conubia nostra, per inceptos himenaeos.

                    Aenean auctor imperdiet ante, ac fermentum lectus sodales at. Cras eu vulputate leo. Phasellus non
                    rutrum felis. Nam eleifend leo sed iaculis posuere. Phasellus a nulla sit amet mauris accumsan
                    pretium quis in odio. Duis felis enim, bibendum ac ullamcorper id, placerat ut mauris. Pellentesque
                    id dignissim nisi. Curabitur gravida vulputate tortor, nec aliquam lacus dapibus in. Donec mauris
                    velit, hendrerit et lorem sed, suscipit accumsan purus.


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
                                    :timestamp="{{ \Carbon\Carbon::now()->addHours(2)->timestamp }}"></course-countdown>

                            <div class="row mt-3" style="width: 385px; margin: 0 auto;">
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
                                <span class="subtitle-2">Miesięczny dostęp</span> <br />
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
                                <span class="subtitle-2">Roczny dostęp</span> <br />
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
