@extends('layouts.main')


@section('content')
		<script type="text/javascript">
		$(document).on('click','.addbtn', function(e){
			
			var id = $(this).attr('id');
			alert(id);
			$.ajax({
                    type: "POST",
                    url : "addCart",
                    data : { id_prod : id},

                    success : function(data){
                        console.log(data);
                    }
                },"json");
			e.preventDefault();
		});
		function funId()

		{
			
			alert(id);
		}
		</script>
		<h2>New Products</h2>
		<hr>
		<div id="products">
			@foreach($products as $product)

				<div class="product">
					<a href="/store/view/{{ $product->id }}">
					{{ HTML::image($product->image, $product->title, array('class'=>'feature', 'width'=>'240','height'=>'127'))}}
					</a>

					<h3><a href="/store/view/{{ $product->id }}">{{ $product->title}}</a></h3>
					<p>{{ $product->description }}</p>

					<h5>
						Availability:
						<span class="{{ Availability::displayClass($product->availability) }}">
							{{ Availability::display($product->availability) }}
							
						</span>
							
					</h5>
					<p>
						<a href="#">
							<span class="price">$ {{ $product->price }}</span>
							{{Form::open(array('url'=>'store/addtocart'))}}
							{{Form::hidden('quantity', 1)}}
							{{Form::hidden('id', $product->id)}}
							<button type="submit">{{$product->price}}--add to cart</button>
							{{Form::close()}}
						
							<br>	
							<form id="form-add" method="post">
								<input type="hidden" id="id_prod" value="{{$product->id}}">
								<button id="{{$product->id}}" class="addbtn">AGREGAR</button>
								
								
							</form>
						
						</a>
						<br>
						@if(Auth::check())
							{{ Fav::display(Auth::user()->id, $product->id)}}
						@endif	
					</p>
					
				</div>
			@endforeach
			
		</div>
@stop