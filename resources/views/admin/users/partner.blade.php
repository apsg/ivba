@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Partnerzy</li>
@endpush

@section('pagename', 'Program partnerski')
@section('pagesubname', 'Statystyki')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" id="table">
                    <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Imię</th>
                        <th scope="col">Rejestracji w miesiącu</th>
                        <th scope="col">Rejestracji w roku</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($partners as $item)
                        <tr>
                            <td>{{ $item->email }}</td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->refs_month }}</td>
                            <td>{{ $item->refs_year }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="application/javascript">
        $(document).ready(function () {
            $("#table").dataTable({
                'order': [[2, 'desc']],
            });
        });
    </script>
@endpush