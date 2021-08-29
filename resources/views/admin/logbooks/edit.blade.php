@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Logbook #{{ $logbook->id }}</li>
    <li class="active">{{ $logbook->title }}</li>
@endpush

@section('pagename', 'Logbook')
@section('pagesubname', 'Edytuj')

@section('content')
    <div class="container">
        <form action="{{ url('/admin/logbooks/' . $logbook->id) }}" method="post">
            @csrf
            @method('put')
            @include('admin.logbooks.partial_form')

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>Wybierz kursy dla tego logbooka</label>

                    <model-selector
                            :initial="{{ isset($logbook) ? $logbook->courses->pluck('id') : '[]' }}"
                            :url="'{{ route('admin.courses.index') }}'"
                            :label="['id', 'title']"
                            name="course_id"
                    ></model-selector>
                </div>
            </div>

            <button class="btn btn-ivba">Zapisz</button>
        </form>
    </div>
@endsection
