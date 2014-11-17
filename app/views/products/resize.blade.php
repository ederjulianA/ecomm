@extends('layouts.main')

@section('content')
	<H1>TESTING THE IMAGE RESIZE</H1>
	<style type="text/css">
	.contenedor{
		border: 1px solid #f90;
	}
	 .contenedor div.pro1 {
	 	border: 2px solid red;
	 	margin: 5px;
	 	display: inline-block;
	 	vertical-align: top;
	 	width: 30%;
	 }
	 .img-pro1{
	 	border: 2px solid #998;
	 	height: 300px;
	 	max-width: 300px;
	 	width: auto;
	 	margin: 0 auto;
	 }
	 .img-pro1 img {
	 	width: 100%;
	 	height: auto;
	 }
	</style>

	<form method="post" action="{{URL::route('resizePost')}}" enctype="multipart/form-data">
		<input type="file" name="imagen">

		<input type="submit" value="guardar">
		
	</form>
	<div class="contenedor">

	

	@foreach($empresa as $emp)
		<div class="pro1">
			<div class="img-pro1">
				{{HTML::image($emp->img, 'imagen', array('class'=>''))}}
				
			</div>

			<div class="desc-pro">
				<h1>Titulo del Producto</h1>
				
			</div>
		
		</div>
		
			
		
		

	@endforeach

	</div>

	
@stop