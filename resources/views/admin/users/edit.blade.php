@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Edytuj użytkownika</li>
@endpush

@section('pagename', 'Edytuj')
@section('pagesubname', 'Użytkownika')

@section('content')
    <section class="content container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('/admin/user/'.$user->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="form-group">
                        <label>Nazwa</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}"
                               required="required">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') ?? $user->email }}"
                               required="required">
                    </div>
                    <button class="btn btn-success">Zapisz</button>
                    <a href="{{ url('admin/user') }}" class="btn btn-default">Anuluj/wróć do spisu</a>
                </form>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header text-bold">
                        Szczegóły użytkownika
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Pełen dostęp: </strong>
                            @if($user->full_access_expires !== null)
                                {{ $user->full_access_expires }} ({{ $user->full_access_expires->diffForHumans() }})
                            @endif
                        </p>
                        <p>
                            <strong>Dostęp subskrypcyjny: </strong>
                            @if($user->hasActiveSubscription())
                                {{ $user->subscription->valid_until }}
                                ({{$user->subscription->valid_until->diffForHumans()}})
                                @if($user->subscription->isActive())
                                    <span class="text-success"><i class="fa fa-check"></i> SUBSKRYPCJA AKTYWNA</span>
                                @else
                                    <span class="text-danger">
                                        <i class="fa fa-times"></i> SUBSKRYPCJA NIEAKTYWNA
                                    </span>
                                @endif
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class=" col-md-4">
                <div class="card">
                    <div class="card-header text-bold">
                        Przyznaj pełen dostęp
                    </div>
                    <div class="card-body">
                        <form action="{{  route('admin.users.full_access', compact('user')) }}" method="post">
                            @csrf
                            <label class="label">Czas trwania w miesiącach:
                                <input class="form-control" name="duration" required min="1" type="number">
                            </label>
                            <button class="btn btn-ivba confirm">Przyznaj pełen dostęp</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class=" col-md-4">
                <div class="card">
                    <div class="card-header text-bold">
                        Przyznaj dostęp - subskrypcję
                    </div>
                    <div class="card-body">
                        <form action="{{  route('admin.users.subscription_access', compact('user')) }}" method="post">
                            @csrf
                            <label class="label">Czas trwania w miesiącach:
                                <input class="form-control" name="duration" required min="1" type="number">
                            </label>
                            <button class="btn btn-ivba confirm"
                                    @if($user->hasFullaccess()) disabled="disabled" @endif
                            >Przyznaj dostęp
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class=" col-md-4">
                <div class="card">
                    <div class="card-header text-bold">
                        Inne akcje
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.users.send_password', compact('user')) }}" class="btn btn-info">
                            <i class="fa fa-envelope-o"></i> Wyślij losowe hasło
                        </a><br/>
                        @if ($user->subscription !== null && $user->subscription->is_active)
                            <a href="{{ $user->subscription->cancelLink() }}" class="btn btn-secondary confirm">
                                <i class="fa fa-times"></i> Anuluj subskrypcję
                            </a><br/>
                        @endif
                        @if($user->hasFullAccess())
                            <a href="{{ route('admin.users.cancel_full_access', compact('user')) }}"
                               class="btn btn-danger confirm">
                                <i class="fa fa-times"></i> Anuluj natychmiast pełen dostęp
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection	