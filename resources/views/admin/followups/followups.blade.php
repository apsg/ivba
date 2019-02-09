@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Followupy</li>
@endpush

@section('pagename', 'Followupy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
    <section class="content">
        <div class="row">

            @foreach(\App\Helpers\FollowupsHelper::FOLLOWUPS as $name => $description)

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $description }}</h3>
                            <div class="box-tools pull-right">
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Tytuł</th>
                                    <th>Czas opóźnienia</th>
                                    <th>Opcje</th>
                                </tr>
                                </thead>
                                @forelse($followups[$name] ?? [] as $followup)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/admin/followups/'.$followup->id) }}">{{ $followup->title }}</a>
                                        </td>
                                        <td>
                                            {{ $followup->interval }}
                                        </td>
                                        <td>
                                            <a class="btn btn-default" href="{{ $followup->editLink() }}"><i
                                                        class="fa fa-edit"></i> Edytuj</a>
                                            <a class="btn btn-warning" href="{{ $followup->deleteLink() }}"><i
                                                        class="fa fa-trash"
                                                        onclick="return confirm('Na pewno chcesz usunąć?');"></i>
                                                Usuń</a>
                                            <a class="btn btn-info" href="{{ $followup->testLink() }}"><i
                                                        class="fa fa-envelope"></i> Wyślij test</a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Brak followupów. Dodaj jakiś.</p>
                                @endforelse
                            </table>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a class="btn btn-primary" href="{{ url('/admin/followups/new') }}?selected={{ $name }}">
                                <i class="fa fa-plus"></i> Dodaj followup do tej kategorii
                            </a>
                        </div><!-- box-footer -->
                    </div><!-- /.box -->
                </div>
            @endforeach

        </div>

    </section>
@endsection