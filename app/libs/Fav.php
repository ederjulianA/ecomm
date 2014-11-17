<?php 
class Fav {
	public static function display($user_id, $product_id) {
		$fav =  Favorite::where('user_id',"=", $user_id)->where('product_id',"=",$product_id)->get();
		if($fav->count()){
			echo Form::open(array('action' => 'FavoritesController@postRem'));
			echo Form::hidden('user_id', Auth::user()->id);
			echo Form::hidden('product_id', $product_id);
			echo Form::submit('REM-FAV', array('class'=>'btn btn-danger'));
			echo Form::close();
		}else{
			echo Form::open(array('action' => 'FavoritesController@postAdd'));
			echo Form::hidden('user_id', Auth::user()->id);
			echo Form::hidden('product_id', $product_id);
			echo Form::submit('Add-FAV', array('class'=>'btn btn-primary'));
			echo Form::close();
		}



	
			/*{{ Form::open(array('action' => 'FavoritesController@postAdd')) }}
							
							{{ Form::hidden('user_id', Auth::user()->id)}}
							{{ Form::hidden('product_id', $product->id)}}
							{{ Form::submit('Add-FAV')}}
							{{ Form::close()}}*/
		}


		function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
	}
