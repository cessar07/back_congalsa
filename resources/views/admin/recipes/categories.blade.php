@extends('admin.layout')
@section('title' , 'Congalsa Back - Recetas categorías')
@section('title_page' , 'Recetas - Categorías')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-5 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">{{ isset($ca) ? 'Editar receta' : 'Agregar receta' }}</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ isset($ca) ? url('/admin/recipes/categories/'.$ca->id) : url('/admin/recipes/categories') }}" method="POST" autocomplete="off">
	                	{{ csrf_field() }}
	                	@if(isset($ca))
	                		{{ method_field('PUT') }}
	                	@endif
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control" value="{{ isset($ca) ? $ca->title : '' }}">
	                	</div>
	                	<div class="form-group">
	                		<label for="description">Descripción</label>
	                		<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ isset($ca) ? $ca->description : '' }}</textarea>
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">{{ isset($ca) ? 'Actualizar' : 'Guardar' }}</button>
	                	</div>
	                </form>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	    <div class="col-lg-7 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Categprías registradas</h5>
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
								@foreach($cat as $c)
									<tr>
										<td>
											{{ $c->title }}
										</td>
										<td>
											{{ $c->status == 1 ? 'Activa' : 'Inactiva' }}
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/recipes/categories/'.$c->id.'/edit') }}" class="btn btn-sm btn-warning">Editar</a>
												<a href="{{ url('/admin/recipes/categories/updateStatus/'.$c->id) }}" class="btn btn-sm {{ $c->status == 1 ? 'btn-danger' : 'btn-success' }}">Cambiar a {{ $c->status == 1 ? 'Inactiva' : 'Activa' }}</a>
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
		</script>
	@endsection
@stop