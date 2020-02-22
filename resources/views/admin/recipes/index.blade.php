@extends('admin.layout')
@section('title' , 'Congalsa - Lista de recetas')
@section('title_page' , 'Lista de recetas')
@section('body')
	
	<div class="row">
		<div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Recetas registradas</h5>
	                <a href="{{ url('/admin/recipes/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Agregar receta</a>
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
									<th>Categoría</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($r as $c)
									<tr>
										<td>
											{{ $c->title }}
										</td>
										<td>
											{{ $c->getCategory()->title }}
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/recipes/'.$c->id.'/edit') }}" class="btn btn-sm btn-warning">Editar</a>
												<a href="{{ url('/admin/recipes/'.$c->id) }}" class="btn btn-info btn-sm">Ver detalles</a>
												<a href="{{ url('/admin/recipes/delete/'.$c->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
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