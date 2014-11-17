<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function getResize()
	{
		$empresa = Resize::all();
		return View::make('products.resize')->with('empresa',$empresa);
	}

	public function postResize()
	{

		$empresa = new Resize;
		$imagen = Input::file('imagen');
		$codigoIMG = str_random(13);

		$filename = date('Y-m-d-H')."-".$codigoIMG."-"."logo.jpg";
		//$resize = new ResizeImage($imagen);
		//$resize->resizeTo(170, 170);
		//$resize->resizeTo(170, 100, 'exact');
		//$resize->saveImage(public_path().'/img/products/'.$filename, "170", true);
		//Image::make($imagen->getRealPath())->resize(170, null, function ($constraint) {$constraint->aspectRatio();})->save(public_path().'/img/products/'.$filename);
		//$nr = new Fav;
		//$nr->resize_image($imagen, 250, 250);
		//Image::make($imagen->getRealPath())->save(public_path().'/img/products/'.$filename);
		//Image::make($imagen->getRealPath())->resize(300, 300, true, false)->save(public_path().'/img/products/'.$filename);
		Image::make($imagen->getRealPath())->resizeCanvas(300, 300, null, true, '#fff')->save(public_path().'/img/products/'.$filename);
		//Image::make($imagen->getRealPath())->fit(170, 100)->save(public_path().'/img/products/'.$filename);
				$empresa->img = 'img/products/'.$filename;
				$empresa->save();

				return Redirect::to('/resize');
	}

}