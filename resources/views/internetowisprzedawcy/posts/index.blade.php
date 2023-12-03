@php
    use Carbon\Carbon;
    use Illuminate\Support\Arr;
@endphp
@extends('layouts.logged')

@section('title', 'Aktualności')

@section('seo_description', 'Aktualności')

@section('content')
    <div class="pb-5">
        <section class="about p-1 p-sm-3 rounded-50 padding-lg bg-white posts">
            <div class="container inner">
                <div class="row underline-blue  mb-3">
                    <div class="col-12 left-block mt-3">
                        <h3>Aktualności</h3>
                    </div>
                </div>

                <div class="row">
                    @foreach($posts as $post)
                        <div class="bg-gray-light py-2 p-0 p-sm-3 d-flex col-md-12 flex-column flex-md-row">
                            <div>
                                <img src="{{ Arr::get($post, '_embedded.wp:featuredmedia.0.media_details.sizes.thumbnail.source_url') }}"
                                     class="mr-3 rounded rounded-20">
                            </div>
                            <div class="flex-fill">
                                <div class="d-flex justify-content-between">
                                    <h6>{{ Arr::get($post, 'title.rendered') }}</h6>
                                    <div><i>{{ Carbon::parse(Arr::get($post, 'date'))->diffForHumans() }}</i></div>
                                </div>
                                <div>{!! Arr::get($post, 'excerpt.rendered') !!}</div>
                                <a href="{{ route('posts.show', ['slug' => Arr::get($post, 'slug')]) }}"
                                   class="btn btn-sm btn-ivba mt-2">
                                    Zobacz <i class="fa fa-caret-right"></i>
                                </a>
                                @if($post['displayed_at'])
                                    <span class="ml-5">Wyświetlono {{ Arr::get($post, 'displayed_at') }}</span>
                                @else
                                    <span class="ml-5 color-blue">Niewyświetlony materiał</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
