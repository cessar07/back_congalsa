@extends('admin.layout')
@section('title' , 'Congalsa - Editar evento')
@section('title_page' , 'Editar evento')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos del evento</h5>
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
	                <form action="{{ url('/admin/events/'.$e->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	{{ method_field('PUT') }}
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control" value="{{ $e->title }}">
	                	</div>
	                	<div class="form-group">
	                		<label for="mymce">Descripción</label>
	                		<textarea name="description" id="mymce" cols="30" rows="10" class="form-control">{{ $e->description }}</textarea>
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="date_from">Fecha de inicio del evento</label>
			                		<input type="text" name="date_from" id="date_from" class="form-control mydatepicker" placeholder="dd/mm/yyyy" value="{{ $e->getDateFrom() }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="time">Hora del evento</label>
			                		<input type="text" name="time" id="time" class="form-control clockpicker" value="{{ $e->time }}">
			                	</div>
	                		</div>
	                		{{-- <div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="limit">Limite de usuarios</label>
	                				<input type="number" id="limit" name="limit" class="form-control" value="{{ $e->limit_users }}">
	                				<div style="height: 5px"></div>
	                				<label>
	                					<input type="checkbox" onclick="verifyLimit($(this))" @if($e->limit_users == 0) checked @endif> Sin limite de usuarios
	                				</label>
	                			</div>
	                		</div> --}}
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="difficulty">Dificultad</label>
	                				<select name="difficulty" id="difficulty" class="form-control">
	                					<option value="">Seleccione dificultad</option>
	                					<option value="1" {{ $e->difficulty == 1 ? 'selected' : '' }}>Baja</option>
	                					<option value="2" {{ $e->difficulty == 2 ? 'selected' : '' }}>Media</option>
	                					<option value="3" {{ $e->difficulty == 3 ? 'selected' : '' }}>Alta</option>
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="time_total">Tiempo</label>
	                				<input type="text" name="time_total" class="form-control" id="time_total" value="{{ $e->time_total }}">
	                			</div>
	                		</div>
	                		<div class="col-lg-12">
	                			<div class="form-group">
	                				<label for="adrress">Dirección</label>
	                				<input type="text" name="address" class="form-control" id="address" value="{{ $e->address }}">
	                			</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
                			<label for="cover">Foto de portada</label>
                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*" data-default-file="{{ asset('/files/events/'.$e->cover) }}" />
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

				$('.clockpicker').clockpicker({
					placement: 'bottom',
			        align: 'left',
			        autoclose: true,
			        'default': 'now',
			        donetext:'Aceptar'
				});
			});
		</script>
	@endsection
@stop