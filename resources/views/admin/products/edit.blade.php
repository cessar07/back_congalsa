@extends('admin.layout')
@section('title' , 'Congalsa - Editar producto')
@section('title_page' , 'Editar producto')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos del producto</h5>
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
	                <form action="{{ url('/admin/products/'.$p->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ method_field('PUT') }}
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-9">
			                	<div class="form-group">
			                		<label for="title">Título del producto</label>
			                		<input type="text" name="title" id="title" class="form-control" value="{{ $p->title }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
			                	<div class="form-group">
			                		<label for="points">Puntos requeridos</label>
			                		<input type="number" name="points" id="points" class="form-control" min="1" value="{{ $p->points }}">
			                	</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="mymce">Descripción</label>
	                		<textarea name="description" id="mymce" cols="30" rows="10" class="form-control">{{ $p->description }}</textarea>
	                	</div>
	                	<div class="form-group">
                			<label for="cover">Foto de portada</label>
                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*" data-default-file="{{ $p->cover }}" />
                		</div>
	                	<div class="form-group">
	                		<button class="btn btn-success">Actualizar</button>
	                	</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			$(document).ready(function() {
		        $('.dropify').dropify({
					messages: {
		                default: 'Click aqui o arrastra un archivo',
		                remove: 'Remover',
		                error: 'Error, archivo no soportado',
		                replace:'Click aqui o arrastra un archivo para reemplazar'
		            }
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
		                toolbar: "insertfile undo redo  | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
		                image_uploadtab:true,
                        convert_urls:false,
                        paste_data_images:true,
                        images_upload_url:'{{ url('/api/uploadFileMedia') }}',
                        image_advtab:true,
                        image_prepend_url:'{{ asset('/files/media') }}/',
		            });
		        }
			});
		</script>
	@endsection
@stop