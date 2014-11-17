@extends('layouts.main')

@section('content')
	<div id="product-image">
		{{ HTML::image($product->image, $product->title) }}
		
	</div><!--  end div product-image-->

	<div id="product-details">

			<h1>{{ $product->title }}</h1>
			<p> {{$product->description}} </p>

			<hr/>
			{{Form::open(array('url'=>'store/addtocart'))}}
							{{Form::label('quantity', 'Qty')}}
							{{Form::text('quantity', 1,array('maxlength'=>2))}}
							
							{{Form::hidden('id', $product->id)}}
							<button type="submit">{{$product->price}}--add to cart</button>
							{{Form::close()}}
			
	</div><!-- END PRODUCT DETAILS-->
	<div id="product-info">
		<p class="price"> {{ $product->price }}</p>
			<p>
						Availability:
						<span class="{{ Availability::displayClass($product->availability) }}">
							{{ Availability::display($product->availability) }}
							
						</span>
			</p>
			<p>Product Code: <span>{{ $product->id }}</span></p>
	</div><!-- END  DIV PRODUCT-INFO-->
		
@stop