<?php
class FavoritesController extends BaseController {
	public function __construct(){
		parent::__construct();
		$this->beforeFilter('csrf', array('on' => 'post'));
		
	}

	public function postAdd(){

		$fav = new Favorite;
		$fav->user_id = Input::get('user_id');
		$fav->product_id = Input::get('product_id');
		$fav->save();

		return Redirect::to('/')->with('message','Added to Favorites');

	}

	public function postRem(){
		$fav =  Favorite::where('user_id',"=", Input::get('user_id'))->where('product_id',"=",Input::get('product_id'));

		if($fav){
		$fav = $fav->first();
		$fav->delete();
		
			return Redirect::to('/')->with('message','Removed from Favorites');
		}else{
			die("no encontrado");
		}

	}

}	