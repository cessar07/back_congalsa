@extends('admin.layout')
@section('title' , 'Congalsa Back - Bonus')
@section('title_page' , 'Bonus')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-5 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">{{ isset($bo) ? 'Editar bonus' : 'Agregar bonus' }}</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ isset($bo) ? url('/admin/bonus/'.$bo->id) : url('/admin/bonus') }}" method="POST" autocomplete="off">
	                	{{ csrf_field() }}
	                	@if(isset($bo))
	                		{{ method_field('PUT') }}
	                	@endif
	                	<div class="form-group">
	                		<label for="activity">Actividad</label>
	                		<input type="text" name="activity" id="activity" class="form-control" value="{{ isset($bo) ? $bo->activity : '' }}">
	                	</div>
	                	<div class="form-group">
	                		<label for="points">Puntos</label>
	                		<input type="number" name="points" class="form-control" value="{{ isset($bo) ? $bo->points : '' }}">
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">{{ isset($bo) ? 'Actualizar' : 'Guardar' }}</button>
	                	</div>
	                </form>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	    <div class="col-lg-7 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Bonus registrados</h5>
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
									<th>Puntos</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($b as $c)
									<tr>
										<td>
											{{ $c->activity }}
										</td>
										<td>
											{{ $c->points }}
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/bonus/'.$c->id.'/edit') }}" class="btn btn-sm btn-warning">Editar</a>
												<a href="#delete_{{ $c->id }}" data-toggle="modal" class="btn btn-sm btn-danger">Eliminar</a>
											</div>
											<div class="modal fade" id="delete_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	Seguro de eliminar este bonus?
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	<h4>
										                		<b>{{ $c->activity }}</b>
										                	</h4>
										                	<div class="btn-group">
										                		<a href="{{ url('/admin/bonus/updateStatus/'.$c->id) }}" class="btn btn-danger">
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