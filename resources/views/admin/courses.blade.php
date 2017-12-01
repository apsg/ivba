@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Kursy</li>
@endpush

@section('pagename', 'Kursy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Aktualnie dodane kursy</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					@forelse($courses as $course)
						<ul>
							<a href="{{ url('/admin/courses/'.$course->slug) }}">{{ $course->title }}</a>
						</ul>
					@empty
						<p>Brak Kursów. Dodaj jakiś.</p>
						<button class="addmedia">open</button>
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