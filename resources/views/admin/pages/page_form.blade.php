<div class="row">			
{{ csrf_field() }}
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              	<h3 class="box-title">Treść</h3>
                
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  	<label for="titlePL">Tytuł</label>
                  	<input name="title" type="text" class="form-control" id="titlePL" placeholder="wpisz..." required="required" value="{{ $page->title ?? "" }}">
                </div>
                <div class="form-group">
                  	<label>Opis</label>
                  	<textarea name="content" class="tinymce" rows="3" placeholder="wpisz ...">{!! $page->content ?? "" !!}</textarea>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input name="slug" type="text" class="form-control" placeholder="Wpisz ..." value="{{ $page->slug ?? "" }}">
                </div>
            </div>

            <div class="box-footer">

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Zapisz</button>
                </div>
            </div>
      	</div>
	</div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        tinymce.init({
          selector: '.tinymce',
          height: 500,
          file_browser_callback: function(field_name, url, type, win){
                console.log(field_name);
                window.media_src_input = "#"+field_name;
                $("#medialibrary").fadeIn(100);
                loadImages();
          },    
          plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
          // imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
          ]
        });
    });
</script>
@endpush