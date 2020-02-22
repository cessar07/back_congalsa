@extends('admin.layout')
@section('title' , 'Congalsa - Editar receta')
@section('title_page' , 'Editar receta')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la receta</h5>
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
	                <form action="{{ url('/admin/recipes/'.$r->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	{{ method_field('PUT') }}
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control" value="{{ $r->title }}">
	                	</div>
	                	<div class="row" id="ingHere">
	                		<div class="col-lg-12">
		                		<label>Ingredientes <button type="button" class="btn btn-primary btn-sm addIng">+</button></label>
	                		</div>
	                		@foreach($r->getIng as $in)
	                			<div class="col-lg-4">
	                				<div class="row">
	                					<div class="col-lg-10">
	                						<div class="form-group">
	                							<input type="text" name="ingrdient[]" class="form-control" value="{{ $in->item }}">
	                						</div>
	                					</div>
	                					<div class="col-lg-2">
	                						<button type="button" class="btn btn-danger btn-block" onclick="deleteItem($(this))" style="height: 37.5px">X</button>
	                					</div>
	                				</div>
	                			</div>
	                		@endforeach
	                	</div>
	                	<div style="height: 10px"></div>
	                	<div class="row">
	                		<div class="col-lg-4">
	                			<div class="form-group">
	                				<label for="category">Categoría</label>
	                				<select name="category" class="form-control" id="category">
	                					<option value="">Seleccione categoría</option>
	                					@foreach($cat as $c)
	                						<option value="{{ $c->id }}" @if($r->category_id == $c->id) selected @endif>{{ $c->title }}</option>
	                					@endforeach
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="time">Tiempo de preparación</label>
	                				<input type="text" name="time" class="form-control" value="{{ $r->time }}">
	                			</div>
	                		</div>
	                		<div class="col-lg-2">
	                			<div class="form-group">
	                				<label for="difficulty">Dificultad</label>
	                				<select name="difficulty" id="difficulty" class="form-control">
	                					<option value="1" {{ $r->difficulty == 1 ? 'selected' : '' }}>Facil</option>
	                					<option value="2" {{ $r->difficulty == 2 ? 'selected' : '' }}>Medio</option>
	                					<option value="3" {{ $r->difficulty == 3 ? 'selected' : '' }}>Difícil</option>
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-3">
                				<label for="persons">Número de personas</label>
                				<input type="number" name="persons" id="persons" class="form-control" min="1" value="{{ $r->persons }}">
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<label for="mymce">Preparación</label>
	                		<textarea name="preparation" id="mymce" cols="30" rows="10" class="form-control">{{ $r->preparation }}</textarea>
	                	</div>
	                	<div class="form-group">
                			<label for="cover">Foto de portada</label>
                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*" data-default-file="{{ asset('/files/recipes/'.$r->cover) }}" />
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

			function deleteItem(b){
				// alert('Hola');
				var d = b.parent().parent().parent();
				d.remove();
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

				$('.addIng').on('click' , function(){
					var div = $('<div></div>' , {
						class:'col-lg-4'
					});
					var r = $('<div></div>' , {
						class:'row'
					});
					var r1 = $('<div></div>' , {
						class:'col-lg-10'
					});
					var form1 = $('<div></div>' , {
						class:'form-group'
					});
					var input = $('<input/>' , {
						type:'text',
						name:'ingrdient[]',
						class:'form-control'
					});
					var r2 = $('<div></div>' , {
						class:'col-lg-2'
					});
					var button = $('<button></button>' , {
						class:'btn btn-danger btn-block',
						type:'button',
						onClick:'deleteItem($(this))'
					}).css('height', '37.5px').text('X');

					div.append(r);
					form1.append(input);
					r1.append(form1);
					r.append(r1);
					r2.append(button);
					r.append(r2);
					div.append(r);

					$('#ingHere').append(div);
				});
			});
		</script>
	@endsection
@stop