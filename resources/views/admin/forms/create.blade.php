@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Formularz</li>
@endpush

@section('pagename', 'Formularz')
@section('pagesubname', 'Dodaj')

@section('content')
    <div class="container">
        <form action="{{ url('/admin/forms') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Formularz</label>
                <select name="type" class="form-control">
                    <option>--</option>
                    @foreach($forms as $form => $details)
                        <option value="{{$form}}">{{ $details['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kurs</label>
                <select name="course_id" class="form-control">
                    <option>--</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-ivba">Dodaj formularz do kursu</button>
        </form>
    </div>
@endsection
