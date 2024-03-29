@extends('admin.layout')
@section('title' , 'Congalsa - Editar usuario')
@section('title_page' , 'Editar usuario')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos del usuario</h5>
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
	                <form action="{{ url('/admin/users/'.$u->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	{{ method_field('PUT') }}
	                	<div class="row">
	                		<div class="col-lg-6">
			                	<div class="form-group">
			                		<label for="name">Nombre y apellido</label>
			                		<input type="text" name="name" id="name" class="form-control" value="{{ $u->name }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="email">Email</label>
	                				<input type="email" name="email" id="email" class="form-control" value="{{ $u->email }}">
	                			</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
                			<label for="cover">Foto de portada</label>
                			<input type="file" id="input-file-now" class="dropify" name="cover" accept="image/*"  data-default-file="{{ asset('/files/users/'.$u->avatar) }}" />
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