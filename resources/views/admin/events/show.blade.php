@extends('admin.layout')
@section('title' , 'Congalsa - Detalle de evento')
@section('title_page' , 'Detalle de evento')
@section('body')

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> 
        	<img class="card-img" src="{{ asset('/files/events/'.$e->cover) }}" height="auto" alt="Card image">
            <div class=" card-inverse text-white social-profile d-flex justify-content-center">
                <div class="align-self-center" style="padding-top: 10px">
                    <h4 class="card-title">{{ $e->title }}</h4>
                    {{-- <h6 class="card-subtitle">@jamesandre</h6>
                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p> --}}
                </div>
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
            		<b>Descripción:</b> <?php echo $e->description; ?>
            	</p>
            	<hr>
                <h4>
                    <b>Fecha:</b> {{ $e->getDate() }}
                </h4>
                <hr>
                <h4>
                    <b>Dirección:</b> {{ $e->address }}
                </h4>
                <hr>
                <h4>
                    <b>Limite de usuarios:</b> {{ $e->limit_users == 0 ? 'Sin limite de usuarios' : $e->limit_users.' usuarios' }}
                </h4>
                <hr>
                @if($e->limit_users != 0)
                    <h4>
                        <b>Usuarios confirmados:</b> {{ $e->getCount() }} 
                    </h4>
                @endif
            </div>
        </div>
    </div>
</div>
@stop