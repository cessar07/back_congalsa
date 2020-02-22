@extends('admin.layout')
@section('title' , 'Congalsa - Agregar pregunta')
@section('title_page' , 'Agregar pregunta')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la pregunta</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/questions/') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-12">
			                	<div class="form-group">
			                		<label for="title">Título</label>
			                		<input type="text" name="title" id="title" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="position">Posición</label>
	                				<select name="position" id="position" class="form-control">
	                					<option value="">Seleccione posición</option>
	                					@for($i = 1; $i <= App\Question::count()+1; $i++)
	                						<option value="{{ $i }}">{{ $i }}</option>
	                					@endfor
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="points">Puntuación</label>
	                				<input type="number" class="form-control" name="points" min="1">
	                			</div>
	                		</div>
	                	</div>
	                	<div class="row" id="ingHere">
	                		<div class="col-lg-12">
		                		<label>Opciones <button type="button" class="btn btn-primary btn-sm addIng">+</button></label>
	                		</div>
	                	</div>
	                	<div style="height: 10px"></div>
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
			CountOptions = 0;
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
						name:'options[]',
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
					var r3 = $('<div/>' , {
						class:'col-lg-12'
					});
					var label = $('<label/>');
					var radio = $('<input/>' , {
						type:'radio',
						name:'correct',
						value:CountOptions,
					});

					div.append(r);
					form1.append(input);
					r1.append(form1);
					r.append(r1);
					r2.append(button);
					r.append(r2);
					div.append(r);
					label.append(radio);
					label.append('Marcar como opción correcta');
					r3.append(label);
					div.append(r3);

					$('#ingHere').append(div);
					CountOptions = parseInt(CountOptions) + 1;
				});
			});
		</script>
	@endsection
@stop