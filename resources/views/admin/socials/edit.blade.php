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
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/socials/'.$s->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	{{ method_field('PUT') }}
	                	<div class="form-group">
	                		<label for="service">Servicio</label>
	                		<input type="text" name="service" id="service" class="form-control" value="{{ $s->service }}">
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="mymce">Tipo de servicio</label>
			                		<textarea name="type" id="mymce" cols="30" rows="10" class="form-control">{{ $s->type }}</textarea>
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="mymce2">Condiciones</label>
			                		<textarea name="conditions" id="mymce2" cols="30" rows="10" class="form-control">{{ $s->conditions }}</textarea>
			                	</div>
	                		</div>
	                		<div class="col-lg-8">
	                			<div class="form-group">
			                		<label for="company">Empresa</label>
			                		<input type="text" name="company" id="company" class="form-control" value="{{ $s->company }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="phone">Teléfono</label>
			                		<input type="text" name="phone" id="phone" class="form-control" value="{{ $s->phone }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-10">
	                			<div class="form-group">
			                		<label for="address">Dirección</label>
			                		<input type="text" name="address" id="address" class="form-control" value="{{ $s->address }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-2">
	                			<label for="vigor">En vigor</label>
	                			<select name="vigor" id="vigor" class="form-control">
	                				<option value="">Seleccione</option>
	                				<option value="1" {{ $s->vigor == 1 ? 'selected' : '' }}>Si</option>
	                				<option value="0" {{ $s->vigor == 0 ? 'selected' : '' }}>No</option>
	                			</select>
	                		</div>
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
			});
		</script>
	@endsection
@stop