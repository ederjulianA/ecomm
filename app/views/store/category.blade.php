@extends('layouts.main')


@section('content')
		
		<h2> {{$category->name}} </h2>
		<hr/>
		<aside id="categories-menu">
			<h3>CATEGORIES</h3>
			<ul>
			 @foreach($catnav as $cat)
              <li>{{ HTML::link('/store/category/'.$cat->id, $cat->name) }}</li>
            @endforeach
				
			</ul>
		</aside><!-- end categories menu -->

		<div id="listings">
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
							{{Form::open(array('url'=>'store/postAddcart'))}}
							{{Form::hidden('quantity', 1)}}
							{{Form::hidden('id', $product->id)}}
							<button type="submit">{{$product->price}}--add to cart</button>
							{{Form::close()}}
							@if(Auth::check())
								{{ Fav::display(Auth::user()->id, $product->id)}}
							@endif	
						</a>
					</p>
					
				</div>
			@endforeach
			
		</div><!-- END LISTINGS -->
@stop

@section('pagination')
	<section id="pagination">
		{{ $products->links()}}
		
	</section>
		}
@stop