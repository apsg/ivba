@extends('layouts.learn')

@section('title')
    Internetowi Sprzedawcy |
    @if( !empty($course) )
        {{ $course->title }}
        @if($lesson->title)
            | {{ $lesson->title }}
        @endif
    @else
        {{ $lesson->title }}
    @endif
@endsection

@section('navbar')
    @if($canViewLesson)
        @if(!empty($course) && $course->hasLogbook())
            <button
                    type="button"
                    class="btn btn-secondary"
                    data-toggle="modal"
                    data-target=".bd-example-modal-lg">
                Dodaj wpis w dzienniku aktywności
            </button>
        @endif
    @endif
@endsection

@section('sidebar')

    @include('learn.sidebar')

@endsection

@section('content')
    <ul class="nav nav-tabs pl-5 lesson-learn-mode mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">Ostatnia lekcja</a>
        </li>
        @if(!empty($lesson->items()))
            <li class="nav-item" role="presentation">
                <a class="nav-link mark-after" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Dodatki</a>
            </li>
        @endif
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('learn.partials.lessoncontent')
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('learn.partials.addons')
        </div>
    </div>

@endsection

@push('modals')
    @if(!empty($course))
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="newLogbookEntryModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg bg-white">
                <div class="modal-content">
                    <new-logbook-entry course="{{ $course->slug ?? '-' }}"></new-logbook-entry>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    @endif

    <button type="button" class="question-button text-center" data-toggle="modal" data-target="#askQuestionModal">
        @include('icons.question')
    </button>

    <!-- Modal -->
    <div class="modal fade" id="askQuestionModal" tabindex="-1" role="dialog"
         aria-labelledby="askQuestionModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <question-form
                    :course="{{json_encode($course)}}"
                    :lesson="{{json_encode($lesson)}}"
                    icon="/images/internetowisprzedawcy/logo.png"
            ></question-form>
        </div>
    </div>
@endpush
