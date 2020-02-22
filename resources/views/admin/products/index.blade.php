@extends('admin.layout')
@section('title' , 'Congalsa - Lista de productoos')
@section('title_page' , 'Lista de productoos')
@section('body')
	
	<div class="row">
		<div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Productos registradas</h5>
	                <a href="{{ url('/admin/products/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Agregar producto</a>
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
									<th>Título</th>
									<th>Descripción</th>
									<th>Puntos requeridos</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($p as $c)
									<tr>
										<td>
											{{ $c->title }}
										</td>
										<td>
											<?php echo $c->description; ?>
										</td>
										<td>
											{{ $c->points ? $c->points : 0 }} Punto
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/products/'.$c->id.'/edit') }}" class="btn btn-sm btn-warning">
													Editar
												</a>
												<a href="#update_{{ $c->id }}" class="btn btn-sm btn-danger" data-toggle="modal">
													Eliminar
												</a>
											</div>
											<div class="modal fade" id="update_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	Seguro de eliminar este producto?
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	<h4>
										                		<b>{{ $c->title }}</b>
										                	</h4>
										                	<div class="btn-group">
										                		<a href="{{ url('/admin/products/updateStatus/'.$c->id) }}" class="btn btn-danger">
										                			Eliminar
										                		</a>
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