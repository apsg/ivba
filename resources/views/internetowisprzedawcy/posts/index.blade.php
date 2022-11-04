@extends('layouts.logged')

@section('title', 'Aktualności')

@section('seo_description', 'Aktualności')

@section('content')
    <!-- Start Course Description -->
    <div class="pb-5">
        <section class="about p-3 rounded-50 padding-lg bg-white  ">
            <div class="container inner">
                <div class="row underline-blue  mb-3">
                    <div class="col-12 left-block mt-3">
                        <h3>Aktualności</h3>
                    </div>
                </div>

                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-12 my-3">
                            <div class="bg-gray-light p-3">
                                <div class="d-flex justify-content-between">
                                    <h6>{{ $post->title }}</h6>
                                    <div><i>{{ $post->published_at->diffForHumans() }}</i></div>
                                </div>
                                <div>{{ $post->excerpt }}</div>
                                <a href="{{ route('posts.show', $post->slug) }}"
                                   class="btn btn-sm btn-ivba mt-2">
                                    Zobacz <i class="fa fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $posts->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
