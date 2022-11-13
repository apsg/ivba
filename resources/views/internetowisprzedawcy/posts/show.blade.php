@extends('layouts.logged')

@section('title', 'Aktualności | ' . $post->title)

@section('seo_description', 'Aktualności | '. $post->title)

@section('content')
    <!-- Start Course Description -->
    <div class="pb-5">
        <section class="about p-3 rounded-50 padding-lg bg-white  ">
            <div class="container inner">
                <a href="{{ route('posts.index') }}" class="color-gray">
                    <i class="fa fa-caret-left"></i> Wróć do aktualności
                </a>

                <div class="row underline-blue  mb-3">
                    <div class="col-12 left-block mt-3">
                        <h3>{{ $post->title }}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 my-3">
                        {!! $post->body !!}
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
