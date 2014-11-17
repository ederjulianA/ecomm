@extends('layouts.main')

@section('content')
	<div id="shopping-cart">

			<form action="https://www.paypal.com/cgi-bin/websrc" method="post">
				<table class="table">
					
					<tr>
						<th>#</th>
						<th>Product name</th>
						<th>Unit Price</th>
						<th>Quantity</th>
						<th>Subtotal</th>
					</tr>

					@foreach($products as $product)
					<tr>
						<td>{{$product->id}}</td>
						<td>{{HTML::image($product->image, $product->name, array('width'=>'65', 'height'=>'37'))}}
						{{$product->name}}
						</td>
						<td>{{$product->price}}</td>
						<td>{{$product->quantity}}</td>
						<td>{{$product->total()}}--<a href="/store/removeitem/{{$product->identifier}}"> Remove</a></td>
					</tr>

					@endforeach
					<tr>
						<td colspan="5">
						Subtotal : ${{Cart::total()}}<br/>
						<span> TOTAL : ${{Cart::total()}}</span><br>

						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="bussines" value="ederalvarez2091057@gmail.com">
						<input type="hidden" name="item_name" value="eCommerce Store Purchase">
						<input type="hidden" name="amount" value="{{Cart::total()}}">
						<input type="hidden" name="first_name" value="{{Auth::user()->firstname}}">
						<input type="hidden" name="last_name" value="{{Auth::user()->lastname}}">
						<input type="hidden" name="email" value="{{Auth::user()->email}}">

						<a href="#">CONTINUE SHOPPING</a><br>
						<input type="submit" value="CHECKOUT WITH PAYPAL">
							
						</td>
						
						
					</tr>
				</table>
				
			</form>
		
	</div>
@stop