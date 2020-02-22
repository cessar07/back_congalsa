@extends('admin.layout')
@section('title' , 'Congalsa - Detalle de noticia')
@section('title_page' , 'Detalle de noticia')
@section('body')

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> 
        	<img class="card-img" src="{{ asset('/files/entries/'.$e->cover) }}" height="auto" alt="Card image">
            <div class=" card-inverse text-white social-profile d-flex justify-content-center">
                <div class="align-self-center" style="padding-top: 10px">
                    <h4 class="card-title">{{ $e->title }}</h4>
                    {{-- <h6 class="card-subtitle">@jamesandre</h6>
                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p> --}}
                </div>
            </div>
            <div class="card-body">
                <h4>
                    <b>Categoría:</b> <small>{{ $e->getCategory()->title }}</small>
                </h4>
                <hr>
                <h4>
                    <b>Estatus:</b>
                    <small>
                        @if($e->status == 1)
                            Publicada
                        @elseif($e->status == 0)
                            Inactiva
                        @else
                            Publicar el dia {{ $e->getDate() }}
                        @endif
                    </small>
                </h4>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
    	<div class="card">
            <div class="card-body">
            	<h4>
            		<b>Título:</b> <small>{{ $e->title }}</small>
            	</h4>
            	<hr>
            	<p>
            		<b>Contenido:</b> <?php echo $e->description; ?>
            	</p>
            	<hr>
            </div>
        </div>
    </div>
</div>
@stop