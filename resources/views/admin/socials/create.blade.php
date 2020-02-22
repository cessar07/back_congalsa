@extends('admin.layout')
@section('title' , 'Congalsa - Agregar mejora')
@section('title_page' , 'Agregar mejora')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la mejora</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/socials') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="form-group">
	                		<label for="service">Servicio</label>
	                		<input type="text" name="service" id="service" class="form-control">
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="mymce">Tipo de servicio</label>
			                		<textarea name="type" id="mymce" cols="30" rows="10" class="form-control"></textarea>
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="mymce2">Condiciones</label>
			                		<textarea name="conditions" id="mymce2" cols="30" rows="10" class="form-control"></textarea>
			                	</div>
	                		</div>
	                		<div class="col-lg-8">
	                			<div class="form-group">
			                		<label for="company">Empresa</label>
			                		<input type="text" name="company" id="company" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="phone">Teléfono</label>
			                		<input type="text" name="phone" id="phone" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-10">
	                			<div class="form-group">
			                		<label for="address">Dirección</label>
			                		<input type="text" name="address" id="address" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-2">
	                			<label for="vigor">En vigor</label>
	                			<select name="vigor" id="vigor" class="form-control">
	                				<option value="">Seleccione</option>
	                				<option value="1">Si</option>
	                				<option value="0">No</option>
	                			</select>
	                		</div>
	                		<div class="col-lg-12">
	                			<div class="form-group">
		                			<label for="cover">Foto de portada</label>
		                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*" />
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

		        if ($("#mymce2").length > 0) {
		            tinymce.init({
		                selector: "textarea#mymce2",
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
			});
		</script>
	@endsection
@stop