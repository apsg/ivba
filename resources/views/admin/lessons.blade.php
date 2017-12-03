@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Lekcje</li>
@endpush

@section('pagename', 'Lekcje')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Aktualnie dodane lekcje</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					@forelse($lessons as $lesson)
						<ul>
							<a href="{{ url('/admin/lesson/'.$lesson->slug) }}">{{ $lesson->title }}</a>
						</ul>
					@empty
						<p>Brak lekcji. Dodaj jakieś.</p>
					@endforelse
				</div><!-- /.box-body -->
				<div class="box-footer">
					The footer of the box
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
@endsection