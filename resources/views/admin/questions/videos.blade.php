@extends('admin.layout')
@section('title' , 'Congalsa Back - Videos de preguntas')
@section('title_page' , 'Preguntas - Videos')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-5 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">{{ isset($vi) ? 'Editar video' : 'Agregar video' }}</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                {{-- <form action="{{ isset($vi) ? url('/admin/videos-question/'.$vi->id) : url('/admin/videos-question') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	@if(isset($vi))
	                		{{ method_field('PUT') }}
	                	@endif
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control" value="{{ isset($vi) ? $vi->title : '' }}">
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">{{ isset($vi) ? 'Actualizar' : 'Guardar' }}</button>
	                	</div>
	                </form> --}}
	                <form action="{{ url('/api/uploadGallery') }}" class="dropzone" id="newDrop"></form>
	                <br>
	                <a href="{{ url('/admin/videos-question') }}" class="btn btn-success">Guardar</a>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	    <div class="col-lg-7 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Videos registrados</h5>
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <div class="table-responsive m-t-40">
		            	<table id="myTable" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Estatus</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($v as $c)
									<tr>
										<td>
											{{ $c->title }}
										</td>
										<td>
											{{ $c->status == 1 ? 'Activo' : 'Inactivo' }}
										</td>
										<td>
											<div class="btn-group">
												<a href="#video_{{ $c->id }}" data-toggle="modal" class="btn-sm btn btn-info">Ver video</a>
												<a href="#delete_{{ $c->id }}" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>
											</div>
											<div class="modal fade" id="video_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	{{ $c->title }}
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	<video src="{{ asset('/files/videos/'.$c->file) }}" width="60%" controls=""></video>
										                </div>
										            </div>
										        </div>
										    </div>
										    <div class="modal fade" id="delete_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	¿Seguro de eliminar este video?
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	<h4>
										                		<b>{{ $c->title }}</b>
										                	</h4>
										                	<div class="btn-group">
										                		<a href="{{ url('/admin/videos-question/delete/'.$c->id) }}" class="btn btn-danger">Eliminar</a>
										                		<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button> 
										                	</div>
										                </div>
										            </div>
										        </div>
										    </div>
										</td>
									</tr>
								@endforeach
							</tbody>
		            	</table>
		            </div>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			Dropzone.autoDiscover = false;
			$(document).ready(function() {
				$('#myTable').DataTable({
			        "language": {
			            "lengthMenu": "Mostrando _MENU_ registros por página",
			            "zeroRecords": "Sin datos encontrados",
			            "info": "Mostrando _PAGE_ de _PAGES_",
			            "infoEmpty": "Sin datos para mostrar",
			            "infoFiltered": "(filtrado de _MAX_ registros totales)",
			            'search':'Buscar:',
				        paginate: {
			                'first':      "Primero",
			                'previous':   "Anterior",
			                'next':       "Siguiente",
			                'last':       "Ultima"
			            }
			        }
			    });

			    var cT  = 'Cancelar';
			 	var cCt = 'Seguro de cancelar la subida?';
			 	var rT  = 'Remover';
			 	var lT  = 'El limite de imagenes es 15';
			 	var dT  = 'Click aqui o arrastra un archivo';
			 	var eS  = 'Error al subir el archivo';
			 	var mT  = 'El peso máximo en archivos es de 80mb';

			 	var allGallery =[];

				var myDropzone = new Dropzone("#newDrop" , {
			 		addRemoveLinks:false,
			 		maxFiles:15,
			 		maxFilesize:80,
			 		acceptedFiles:'image/*',
			 		dictCancelUpload:cT,
			 		dictCancelUploadConfirmation:cCt,
			 		dictRemoveFile:rT,
			 		dictMaxFilesExceeded:lT,
			 		dictDefaultMessage:dT,
			 		dictResponseError:eS,
			 		dictMaxFilesExceeded:mT
			 	}); 

			 	myDropzone.on("sending", function(file, xhr, formData) {
				  	formData.append("token_image", file.upload.uuid);
				  	// alert('Hola');
				});
			});
		</script>
	@endsection
@stop