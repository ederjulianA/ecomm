<?php

class Availability {
	public static function display($availability){
		if($availability == 0){
			echo "Out of Stock";
		}else if($availability == 1){
			echo "In Stock";
		}
	}


	public static function displayClass($availability){
		if($availability == 0){
			echo "label label-danger";
		}else if($availability == 1){
			echo "label label-success";
		}
	}
}