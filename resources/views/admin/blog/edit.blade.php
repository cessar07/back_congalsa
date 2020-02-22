@extends('admin.layout')
@section('title' , 'Congalsa - Editar noticia')
@section('title_page' , 'Editar noticia')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la noticia</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/news/'.$e->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }} 
	                	{{ method_field('PUT') }}
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control" value="{{ $e->title }}">
	                	</div>
	                	<div class="form-group">
	                		<label for="mymce">Contenido</label>
	                		<textarea name="content" id="mymce" cols="30" rows="10" class="form-control">{{ $e->description }}</textarea>
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="category">Categpría de la noticia</label>
			                		<select name="category" id="category" class="form-control">
			                			<option value="">Seleccione una categoría</option>
			                			@foreach($cat as $c)
			                				<option value="{{ $c->id }}" @if($e->category_id == $c->id) selected @endif>{{ $c->title }}</option>
			                			@endforeach
			                		</select>
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="status">Estatus</label>
			                		<select name="status" id="status" class="form-control">
			                			<option value="">Seleccione un estatus</option>
			                			<option value="0"@if($e->status == 0) selected @endif>No publicar</option>
			                			<option value="1"@if($e->status == 1) selected @endif>Publicada</option>
			                			<option value="2"@if($e->status == 2) selected @endif>Publicar el dia</option>
			                		</select>
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
	                				<label for="date_publish">Fecha de publicación</label>
	                				<input type="text" name="date_publish" id="date_publish" class="form-control mydatepicker" placeholder="dd/mm/yyyy" value="{{ $e->getDate() }}" @if($e->status != 2) disabled @endif>
	                			</div>
	                		</div>
	                		<div class="col-lg-12">
	                			<div class="form-group">
		                			<label for="cover">Foto de portada</label>
		                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*" data-default-file="{{ asset('/files/entries/'.$e->cover) }}" />
		                		</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<button class="btn btn-success">Guardar</button>
	                	</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			$(document).ready(function() {
				$('.mydatepicker').datepicker({
					todayHighlight:true,
					format:'d/m/yyyy'
				});

				if ($("#mymce").length > 0) {
		            tinymce.init({
		                selector: "textarea#mymce",
		                theme: "modern",
		                height: 300,
		                plugins: [
		                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		                    "save table contextmenu directionality emoticons template paste textcolor"
		                ],
		                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
		                image_uploadtab:true,
                        convert_urls:false,
                        paste_data_images:true,
                        images_upload_url:'{{ url('/api/uploadFileMedia') }}',
                        image_advtab:true,
                        image_prepend_url:'{{ asset('/files/media') }}/',
		            });
		        }

		        $('.dropify').dropify({
					messages: {
		                default: 'Click aqui o arrastra un archivo',
		                remove: 'Remover',
		                error: 'Error, archivo no soportado',
		                replace:'Click aqui o arrastra un archivo para reemplazar'
		            }
				});

				$('#status').on('change' , function(){
					var v = $(this).val();
					if (v == 2) {
						$('#date_publish').removeAttr('disabled');
					}else{
						$('#date_publish').val('');
						$('#date_publish').attr('disabled', 'disabled');
					}
				});
			});
		</script>
	@endsection
@stop