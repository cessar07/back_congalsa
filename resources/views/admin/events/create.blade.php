@extends('admin.layout')
@section('title' , 'Congalsa - Agregar evento')
@section('title_page' , 'Agregar evento')
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
	                <form action="{{ url('/admin/events/') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control">
	                	</div>
	                	<div class="form-group">
	                		<label for="mymce">Descripción</label>
	                		<textarea name="description" id="mymce" cols="30" rows="10" class="form-control"></textarea>
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="date_from">Fecha del evento</label>
			                		<input type="text" name="date_from" id="date_from" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="time">Hora del evento</label>
			                		<input type="text" name="time" id="time" class="form-control clockpicker">
			                	</div>
	                		</div>
	                		{{-- <div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="limit">Limite de usuarios</label>
	                				<input type="number" id="limit" name="limit" class="form-control">
	                				<div style="height: 5px"></div>
	                				<label>
	                					<input type="checkbox" onclick="verifyLimit($(this))"> Sin limite de usuarios
	                				</label>
	                			</div>
	                		</div> --}}
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="difficulty">Dificultad</label>
	                				<select name="difficulty" id="difficulty" class="form-control">
	                					<option value="">Seleccione dificultad</option>
	                					<option value="1">Baja</option>
	                					<option value="2">Media</option>
	                					<option value="3">Alta</option>
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="time_total">Tiempo</label>
	                				<input type="text" name="time_total" class="form-control" id="time_total">
	                			</div>
	                		</div>
	                		<div class="col-lg-12">
	                			<div class="form-group">
	                				<label for="adrress">Dirección</label>
	                				<input type="text" name="address" class="form-control" id="address">
	                			</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
                			<label for="cover">Foto de portada</label>
                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*" />
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
			function verifyLimit(i){
				if (i.is(':checked')) {
					$('#limit').val(0);
					$('#limit').attr('readonly', true);
				}else{
					$('#limit').removeAttr('readonly');
				}
			}

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