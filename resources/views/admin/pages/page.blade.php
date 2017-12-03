@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/pages') }}">Strony</a></li>
    <li class="active">Strona #{{ $page->id }}</li>
@endpush

@section('pagename', 'Strona')
@section('pagesubname', $page->title)

@include('admin.partials.medialibrary')
@include('admin.partials.videolibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Edycja</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
		</div>

        <div class="box-body">
			<form action="{{ url('admin/pages/'.$page->slug) }}" method="post">
				{{ method_field('patch') }}
				@include('admin.pages.page_form')
			</form>
		</div>
	</div>

</section>
@endsection

@push('scripts')
<script type="text/javascript">

</script>
@endpush
