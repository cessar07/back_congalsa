@extends('admin.layout')
@section('title' , 'Congalsa - Detalle de producto')
@section('title_page' , 'Detalle de producto')
@section('body')

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> 
        	<img class="card-img" src="{{ asset('/files/test/'.$t->cover) }}" height="auto" alt="Card image">
            <div class=" card-inverse text-white social-profile d-flex justify-content-center">
                <div class="align-self-center" style="padding-top: 10px">
                    <h4 class="card-title">{{ $t->title }}</h4>
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
            		<b>Título:</b> <small>{{ $t->title }}</small>
            	</h4>
            	<hr>
            	<p>
            		<b>Descripción:</b> <?php echo $t->description; ?>
            	</p>
            	<hr>
                <h4>
                    <b>Rating:</b> {{ $t->rating ? $t->getRating() : 0 }} Estrella(s)
                </h4>
            </div>
        </div>
    </div>
</div>
@stop