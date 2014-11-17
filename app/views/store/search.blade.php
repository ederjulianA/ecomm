@extends('layouts.main')

@section('search-keywords')
	<section id="search-keywords">
		<h1>Search Results for <span> {{ $keyword}} </span> </h1>
		
	</section>
@stop

@section('content')
	<div id="search-results">

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
							}
					</h5>
					<p>
						<a href="#">
							<span class="price">$ {{ $product->price }}</span>
							{{Form::open(array('url'=>'store/addtocart'))}}
							{{Form::hidden('quantity', 1)}}
							{{Form::hidden('id', $product->id)}}
							<button type="submit">{{$product->price}}--add to cart</button>
							{{Form::close()}}
						</a>
						@if(Auth::check())
							{{ Fav::display(Auth::user()->id, $product->id)}}
						@endif	
					</p>
					
				</div>
			@endforeach
	</div><!-- end search results -->
@stop