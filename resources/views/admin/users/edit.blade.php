@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Edytuj użytkownika</li>
@endpush

@section('pagename', 'Edytuj')
@section('pagesubname', 'Użytkownika')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('/admin/user/'.$user->id) }}" method="post">
				{{ csrf_field() }}
				{{ method_field('patch') }}
				<div class="form-group">
					<label>Nazwa</label>
					<input class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}" required="required">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="email" name="email" value="{{ old('email') ?? $user->email }}" required="required">
				</div>
				<button class="btn btn-success">Zapisz</button>
				<a href="{{ url('admin/user') }}" class="btn btn-default">Anuluj/wróć do spisu</a>
			</form>
				
		</div>
	</div>
</section>
@endsection	