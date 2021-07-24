@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Analityka sprzedaży</li>
@endpush

@section('pagename', 'Analityka sprzedaży')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 pb-3">
                <analytics start="{{ $start->timestamp }}" end="{{ $end->timestamp }}"></analytics>
            </div>
            <div class="col-6 pb-3">
                <div class="card mt-2">
                    <div class="card-header font-weight-bold">
                        Aktualnie wybrany zakres: {{ $start->format('Y-m-d') }} - {{ $end->format('Y-m-d') }}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <table id="analyticsTable">
                    <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Liczba</th>
                        <th>Suma</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{ $row['key'] }}</td>
                            <td>{{ $row['count'] }}</td>
                            <td>{{ $row['sum'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $("#analyticsTable").DataTable();
        });
    </script>
@endpush
