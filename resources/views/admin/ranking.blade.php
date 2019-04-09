@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Ranking</li>
@endpush

@section('pagename', 'Ranking')
@section('pagesubname')
    @if($type == 'all')
        wszechczasów
    @else
        miesięczny
    @endif
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Punkty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ranking as $item)
                        <tr>
                            <th scope="row">{{ $item->position }}</th>
                            <td>{{ $item->user->email }}</td>
                            <td>
                                {{ $item->user->name }}
                            </td>
                            <td>{{ $item->points }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush