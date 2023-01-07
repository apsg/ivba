@php use Illuminate\Support\Arr; @endphp
@extends('layouts.logged')

@section('title', 'Aktualności | ' . Arr::get($post, 'title.rendered'))

@section('seo_description', 'Aktualności | '. Arr::get($post, 'title.rendered'))

@section('content')
    <!-- Start Course Description -->
    <div class="pb-5">
        <section class="about p-3 rounded-50 padding-lg bg-white  ">
            <div class="container inner">
                <a href="{{ route('posts.index') }}" class="color-gray">
                    <i class="fa fa-caret-left"></i> Wróć do aktualności
                </a>

                <div class="text-center">
                    <img src="{{ Arr::get($post, '_embedded.wp:featuredmedia.0.media_details.sizes.large.source_url') }}"
                         class="">
                </div>

                <div class="row underline-blue  mb-3">
                    <div class="col-12 left-block mt-3">
                        <h3>{{ Arr::get($post, 'title.rendered') }}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 my-3">
                        {!! Arr::get($post, 'content.rendered') !!}
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
