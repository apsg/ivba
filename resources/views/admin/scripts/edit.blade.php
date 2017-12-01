@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Eedytuj skrypt</li>
@endpush

@section('pagename', 'Skrypt')
@section('pagesubname', 'Edytuj')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edytuj</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('admin/scripts/'.$script->id) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('patch') }}
						<input type="text" name="title" required="required" class="form-control" placeholder="Tytuł" value="{{ old('title') ?? $script->title }}">
						<textarea class="form-control" name="script" required="required" placeholder="treść skryptu wraz z tagiem &lt;script&gt;">{{ old('script') ?? $script->script }}</textarea>
						<button class="form-control btn btn-primary"><i class="fa fa-save"></i> Dodaj</button>
					</form>
						
				</div>
			</div>
		</div>

	</div>
</section>
@endsection

