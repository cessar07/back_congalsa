@extends('admin.layout')
@section('title' , 'Congalsa - Detalle de receta')
@section('title_page' , 'Detalle de receta')
@section('body')

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> 
        	<img class="card-img" src="{{ asset('/files/recipes/'.$r->cover) }}" height="auto" alt="Card image">
            <div class=" card-inverse text-white social-profile d-flex justify-content-center">
                <div class="align-self-center" style="padding-top: 10px">
                    <h4 class="card-title">{{ $r->title }}</h4>
                    {{-- <h6 class="card-subtitle">@jamesandre</h6>
                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p> --}}
                </div>
            </div>
            <div class="card-body">
                <h4>
                    <b>Categoría:</b> <small>{{ $r->getCategory()->title }}</small>
                </h4>
                <hr>
                <h4>
                    <b>Dificultad:</b>
                    <small>
                        @if($r->difficulty == 1)
                            Facil
                        @elseif($r->difficulty == 2)
                            Medio
                        @else
                            Difícil
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
            		<b>Título:</b> <small>{{ $r->title }}</small>
            	</h4>
            	<hr>
            	<h4>
            		<b>Tiempo de preparación:</b> <?php echo $r->time; ?>
            	</h4>
            	<hr>
                <h4>
                    <b>Número de personas:</b> {{ $r->persons }} Persona(s)
                </h4>
                <hr>
                <h4>
                    <b>Ingredientes:</b> <br><br>
                    <ul>
                        @foreach($r->getIng as $i)
                            <li>{{ $i->item }}</li>
                        @endforeach
                    </ul>
                </h4>
                <hr>
                <h4>
                    <b>Preparación:</b>
                </h4>
                <p>
                    <?php echo $r->preparation; ?>
                </p>
            </div>
        </div>
    </div>
</div>
@stop