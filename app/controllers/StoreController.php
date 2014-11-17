<?php

use Eder\Repositories\ProductsRepo;


$cart = new Cart(new Session, new Cookie);

class StoreController extends BaseController {

	protected $ProductsRepo;

	public function __construct(ProductsRepo $ProductsRepo){
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postAddtocart','getCart','getRemoveitem')));
	}

	public function postAdd(){
		return Redirect::to('/')->with('message', 'adding favorite');
	}

	public function getIndex(){
		
		return View::make('store.index')
			->with('products', Product::take(4)->orderBy('created_at', 'DESC')->get());
	}

	public function getView($id){
		return View::make('store.view')->with('product', Product::find($id));
	}

	public function getCategory($cat_id){
		return View::make('store.category')
			->with('products', Product::where('category_id','=',$cat_id)->paginate(6))
			->with('category', Category::find($cat_id));
	}


	public function postAddtocart()
	{
		$product = Product::find(Input::get('id'));
		$quantity = Input::get('quantity');

		Cart::insert(array(
				'id'=>$product->id,
				'name' => $product->title,
				'price' => $product->price,
				'quantity' => $quantity,
				'image' => $product->image
			));

		return Redirect::to('store/cart');
	}

	public function getCart()
	{
		return View::make('store.cart')->with('products', Cart::contents());
	}

	public function getRemoveitem($identifier)
	{
		$item = Cart::item($identifier);
		$item->remove();
		return Redirect::to('store/cart');
	}

	public function getSearch(){
		//$keyword = Input::get('keyword');
		$input = Input::get('keyword');

$exp = explode(' ', $input);

/*$s = '';
$c = 1;
foreach ($exp AS $e)
{
    $s .= "+$e*";

    if ($c + 1 == count($exp))
        $s .= ' ';

    $c++;
}*/
$query = DB::table('products');

    foreach($exp as $term)
    {
        $query->where('title', 'LIKE', '%'. $term .'%');
    }

    $product = $query->get();



//$query = "MATCH (title) AGAINST ('$s' IN BOOLEAN MODE)";
// $query looks like 
// MATCH (first_name, last_name, email) AGAINST ('+jar* +eitni*' IN BOOLEAN MODE)

//$product = Product::whereRaw($query)->get();



		//$product = Product::whereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)",array($keyword))->get();
		//Product::where('title','LIKE', '%'.$keyword.'%')->get()

		return View::make('store.search')
			->with('products', $product )
			->with('keyword', $input);
			//where('title','LIKE', '%'.$keyword.'%')->get())

			

	}
}