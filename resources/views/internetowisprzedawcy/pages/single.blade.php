@extends('layouts.front2')

@section('title', $page->title)

@section('content')
    <section class="page content">
        <div class="container">
            <h1>{{ $page->title }}</h1>
            {!! $page->content !!}
        </div>
    </section>
@endsection